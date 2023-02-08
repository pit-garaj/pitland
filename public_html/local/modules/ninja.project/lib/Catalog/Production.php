<?php


namespace Ninja\Project\Catalog;


use Ninja\Helper\Arr;
use Ninja\Helper\CacheManager;
use Ninja\Helper\Catalog;
use ALS\Helper\El;
use Ninja\Helper\Help;
use Ninja\Helper\Sect;
use Ninja\Helper\TypographLight;
use ALS\Project\Catalog\FeaturesTableProcessed\FeaturesTableProcessed;
use ALS\Project\Helper\Documents;
use ALS\Project\Helper\Photos;
use ALS\Project\Helper\Typograph;
use ALS\Project\Sync1C\SyncProducts;
use ALS\Project\User;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\LoaderException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Exception;


class Production {
    public const IBLOCK_CODE = 'CATALOG_PRODUCTION';
    public const IBLOCK_OFFERS_CODE = 'CATALOG_OFFERS';
    public const IBLOCK_SECTION_ANIMATIONS = 'CATALOG_SECTION_ANIMATIONS';


    public static function getSections(array $customParams = []): array {
        $isAdmin = User::isAdmin();

        $iblockId = Help::getIblockIdByCode(self::IBLOCK_CODE);
        $defaultParams = [
            'IBLOCK_ID'    => $iblockId,
            'FILTER'       => ['ACTIVE' => 'Y'],
            'SELECT'       => [
                'ID:int>id',
                'CODE:string>code',
                'SORT:int>sort',
                'NAME:string>name',
                'DESCRIPTION:string>description',
                'DEPTH_LEVEL:int>dl',
                'LEFT_MARGIN:int>lm',
                'RIGHT_MARGIN:int>rm',
                'ELEMENT_CNT:int>cnt',
                'UF_ANIMATION:int?>animation',
                'UF_BANNERS:int[]?>banners',
            ],
            'bIncCnt'      => true,
            '__SKIP_CACHE' => $isAdmin,
        ];

        $params = array_merge_recursive($defaultParams, $customParams ?: []);

        $sections = CacheManager::getIblockSectionsFromCache($params, static function (&$items) use ($iblockId) {
            foreach ($items as $k => $item) {
                $items[$k]['seo'] = Sect::getSeo($iblockId, $item);

                // Если анимация не установлена для раздела, получаем из ближайшего родительского раздела
                if (empty($item['animation'])) {
                    $parent = null;

                    for ($dl = $item['dl']; $dl > 1; $dl--) {
                        $parent = Help::getParentNestedSet($items, $parent ?? $item);

                        if (!empty($parent['animation'])) {
                            $items[$k]['animation'] = $parent['animation'];
                            break;
                        }
                    }
                }

                // Пропустим пустые разделы
                if ($item['cnt'] < 1) {
                    unset($items[$k]);
                }
            }

            $animations = self::getAnimations();

            foreach ($items as $k => $item) {
                if ($item['animation']) {
                    $items[$k]['animation'] = $animations[$item['animation']];
                }
            }
        });

        return array_values($sections);
    }


    /**
     * Функция возвращает массив всех товаров с офферами в кратком виде
     * @param array $customParams — Массив параметров кастомной выборки
     * @param array $offersCustomParams
     * @param bool $isMaxQuantity
     * @return array
     */
    public static function getItems(array $customParams = [], array $offersCustomParams = [], bool $isMaxQuantity = false): array {
        $isAdmin = User::isAdmin();

        $defaultParams = [
            'IBLOCK_CODE'  => self::IBLOCK_CODE,
            'FILTER'       => [
                'ACTIVE' => 'Y',
                '!CODE'  => false,
            ],
            'SELECT'       => [
                'ID:int>id',
                'SORT:int>sort',
                'CODE:string>code',
                'NAME:string>name',
                'IBLOCK_SECTION_ID:int>sectionId',
                'PREVIEW_PICTURE:Image?>thumb',
                'DETAIL_PICTURE:Image?>detailPicture',

                'PROPERTY_ARTICLE:string?>article',
                'PROPERTY_PHOTOS:Image[]?>photos',
                'PROPERTY_STYLE:int[]?>style',
                'PROPERTY_COLOR:int?>color',
                'PROPERTY_SIZE:string?>size',
                'PROPERTY_LABELS:int[]?>labels',
                'PROPERTY_LABEL_TEXT:string?>labelText',
                'CATALOG_GROUP_1:X', // Необходимо для выборки цен
                'CATALOG_PRICE_1:int>price',
                'CATALOG_AVAILABLE:bool?>canBuy',
            ],
            '__SKIP_CACHE' => $isAdmin,
        ];

        $params = array_merge_recursive($defaultParams, $customParams);

        // Если необходимо получить максимальное количество продуктов разрешенных к покупке
        if ($isMaxQuantity) {
            $params['SELECT'][] = 'QUANTITY_TRACE>quantityTrace';
            $params['SELECT'][] = 'CAN_BUY_ZERO>canBuyZero';
            $params['SELECT'][] = 'CATALOG_QUANTITY:int>quantity';

            $params['__QUANTITY'] = [
                'isQuantityTrace' => Catalog::isQuantityTrace(),
                'isCanBuyZero'    => Catalog::isCanBuyZero()
            ];
        }

        // Параметры для офферов
        if (!empty($offersCustomParams)) {
            $params['offersCustomParams'] = $offersCustomParams;
        }

        $items = CacheManager::getIblockItemsFromCache($params, static function (&$items) use ($params, $isMaxQuantity) {
            $allOffers = self::getOffers($params['offersCustomParams'] ?? [], $isMaxQuantity);

            // Определим картинку превью
            self::setThumb($items);

            foreach ($items as $k => $item) {
                // Соберем торговые предложения в ['offers']
                $offers = $allOffers[$item['id']];

                if (!empty($offers)) {
                    $item['offers'] = $offers;

                    // Если есть офферы доступность выставляет по офферам
                    if (self::isCanBuyOffer($offers)) {
                        $item['canBuy'] = true;
                    } else if (!empty($item['canBuy'])) {
                        unset($item['canBuy']);
                    }
                } else if (empty($item['price'])) {
                    // Продукт без цены запрещен к покупке
                    $item['canBuy'] = false;
                }

                if ($isMaxQuantity) {
                    $quantity = self::getQuantity($item, $params['__QUANTITY']);

                    // Удаляем лишние поля
                    unset($item['quantityTrace'], $item['canBuyZero'], $item['quantity']);

                    if ($quantity !== null) {
                        $item['quantity'] = $quantity;
                    }
                }

                unset($item['photos']);

                // Сохраняем обновленные данные
                $items[$k] = $item;
            }

            self::setDiscountPrices($items);

            // Сортировка предложений
            foreach ($items as $k => $item) {
                if (!empty($item['offers'])) {
                    $items[$k]['offers'] = Arr::sortArrByFields($item['offers'], [
                        'sort'          => SORT_ASC,
                        'canBuy'        => SORT_DESC,
                        'priceDiscount' => SORT_ASC,
                        'price'         => SORT_ASC,
                    ], [
                        'priceDiscount' => 'price',
                    ]);
                }
            }

            Typograph::processItems($items, ['name']);
        });

        $items = Arr::sortArrByFields($items, [
            'sort'   => SORT_ASC,
            'canBuy' => SORT_DESC,
            'price'  => SORT_ASC,
        ]);

        El::applyAssoc($items, $params['ASSOC']);

        return $items;
    }


    /**
     * Возвращает доступное количество. Вернет null если для продукта не ведется учет
     *
     * @param array{quantityTrace: string, canBuyZero: string, quantity: int} $product
     * @param array{isQuantityTrace: bool, isCanBuyZero: bool} $params
     * @return int|null
     */
    private static function getQuantity(array $product, array $params): ?int {
        /*
         * Если отключен количественный учет для товара,
         * если наследуется и глобально отключен количественный учет,
         * если разрешена покупка товара при недостаточном количестве,
         * если наследуется и глобально разрешена покупка при недостаточном количестве
         */
        if ($product['quantityTrace'] === Catalog::QUANTITY_TRACE_OFF
            || ($product['quantityTrace'] === Catalog::QUANTITY_TRACE_INHERIT && !$params['isQuantityTrace'])
            || $product['canBuyZero'] === Catalog::CAN_BUY_ZERO_ON
            || ($product['canBuyZero'] === Catalog::CAN_BUY_ZERO_INHERIT && $params['isCanBuyZero'])
        ) {
            return null;
        }

        return $product['quantity'];
    }


    public static function getItemDetail($id): array {
        $isAdmin = User::isAdmin();

        $iblockId = Help::getIblockIdByCode(self::IBLOCK_CODE);

        if (is_array($id)) {
            $id = self::getProductIds($id);
        }

        $params = [
            'IBLOCK_ID'    => $iblockId,
            'FILTER'       => [
                'ID'     => $id,
                'ACTIVE' => 'Y',
            ],
            'SELECT'       => [
                'ID:int>id',
                'SORT:int>sort',
                'CODE:string>code',
                'NAME:string>name',
                'IBLOCK_SECTION_ID:int>sectionId',
                'PREVIEW_PICTURE:Image?>thumb',
                'DETAIL_PICTURE:Image?>detailPicture',

                'PROPERTY_ARTICLE:string?>article',
                'PROPERTY_BARCODE:string?>barcode',
                'PROPERTY_PRODUCT_CODE:string?>productCode',
                'PROPERTY_STYLE:int[]?>style',
                'PROPERTY_DESCRIPTION:Html?>description',
                'PROPERTY_YOUTUBE:DescriptiveString[]?>youTube',
                'PROPERTY_YOUTUBE_PREVIEW:ImageSrc[]?>youTubePreview',
                'PROPERTY_ADVANTAGES:Image[]?>advantages',
                'PROPERTY_FEATURES_MAIN:Table?>featuresMain',
                'PROPERTY_FEATURES_TEXT:Html?>featuresText',
                'PROPERTY_WARRANTY:int?>warranty',
                'PROPERTY_WARRANTY_REG:int?>warrantyReg',
                'PROPERTY_WARRANTY_REG_NOTE:string?>warrantyRegNote',
                'PROPERTY_LIFETIME:int?>lifetime',
                'PROPERTY_EQUIPMENT?>equipment',
                'PROPERTY_EQUIPMENT_PHOTOS:Image[]?>equipmentPhotos',
                'PROPERTY_KITCHENS:int[]?>kitchens',
                'PROPERTY_DOCS:File[]?>docs',
                'PROPERTY_PHOTOS:Image[]?>photos',
                'PROPERTY_KITCHEN_AREA:int?>kitchenArea',
                'PROPERTY_ACCESSORIES:int[]?>accessories',
                'PROPERTY_FAQ:Table?>faq',
                'PROPERTY_SIZE:string?>size',
                'PROPERTY_LABELS:int[]?>labels',
                'PROPERTY_LABEL_TEXT:string?>labelText',

                'CATALOG_GROUP_1:X', // Необходимо для выборки цен
                'CATALOG_PRICE_1:int>price',
                'CATALOG_AVAILABLE:bool?>canBuy',
            ],
            '__SKIP_CACHE' => $isAdmin,
        ];

        $items = CacheManager::getIblockItemsFromCache($params, static function (&$items) use ($iblockId) {
            $typo = new TypographLight();

            self::typoAdvantages($items);

            // Документы
            Documents::formatDocs($items);

            // Кухни
            self::setKitchens($items);

            // Таблицы характеристик
            self::setFeatures($items);

            $reviewsAll = Reviews::getItems();

            foreach ($items as $k => $item) {
                // Соберем торговые предложения в ['offers']
                $offers = self::getOffersDetail($item['id']);
                if (count($offers) > 0) {
                    $items[$k]['offers'] = $offers;

                    if (self::isCanBuyOffer($offers)) {
                        $items[$k]['canBuy'] = true;
                    } else if (!empty($item['canBuy'])) {
                        unset($items[$k]['canBuy']);
                    }
                } else if (empty($item['price'])) {
                    // Продукт без цены запрещен к покупке
                    unset($items[$k]['canBuy']);
                }

                // Добавим SEO-теги
                $items[$k]['seo'] = El::getSeo($iblockId, $item);

                // FAQ
                if ($item['faq']) {
                    foreach ($item['faq'] as $r => $row) {
                        foreach ($row as $c => $col) {
                            $items[$k]['faq'][$r][$c] = $typo->getResult($col);
                        }
                    }
                }

                // Отзывы
                $reviews = [];
                foreach ($reviewsAll as $review) {
                    if (!in_array($item['id'], $review['products'], true)) {
                        continue;
                    }
                    $reviews[] = $review;
                }

                if (!empty($reviews)) {
                    $items[$k]['reviews'] = array_slice($reviews, 0, 6);
                }
            }

            // Определим картинку превью
            self::setThumb($items);

            self::setDiscountPrices($items);
        });

        if (is_numeric($id) && $items[0]) {
            return $items[0];
        }

        if (is_array($id)) {
            return $items;
        }

        return [];
    }


    /**
     * Функция возвращает краткую информацию о торговом предложении
     * @param int $id — ID торгового предложения
     * @return array
     */
    public static function getOffer(int $id): array {
        $offersByProdId = self::getOffers(['FILTER' => ['ID' => $id]]);

        foreach ($offersByProdId as $offers) {
            foreach ($offers as $offer) {
                if ($offer['id'] === $id) {
                    return $offer;
                }
            }
        }

        return [];
    }


    /**
     * Функция возвращает массив всех торговых предложений в кратком формате
     * @param array $customParams — Массив параметров кастомной выборки
     * @param bool $isMaxQuantity
     * @return array
     * @uses Production::getItems
     */
    public static function getOffers(array $customParams = [], bool $isMaxQuantity = false): array {
        $params = array_merge_recursive(self::getOfferQueryParams(), $customParams ?: []);

        // Если необходимо получить максимальное количество продуктов разрешенных к покупке
        if ($isMaxQuantity) {
            $params['SELECT'][] = 'QUANTITY_TRACE>quantityTrace';
            $params['SELECT'][] = 'CAN_BUY_ZERO>canBuyZero';
            $params['SELECT'][] = 'CATALOG_QUANTITY:int>quantity';

            $params['__QUANTITY'] = [
                'isQuantityTrace' => Catalog::isQuantityTrace(),
                'isCanBuyZero'    => Catalog::isCanBuyZero()
            ];
        }


        // Обработка данных из инфоблока
        $offers = CacheManager::getIblockItemsFromCache($params, static function (&$items) use ($params, $isMaxQuantity) {
            foreach ($items as $k => $item) {
                // Определим картинку превью
                if (!$item['thumb'] && $item['photos']) {
                    $item['thumb'] = self::getThumb($item['photos'][0]);
                }
                unset($item['photos']);

                // Офферы без цены запрещены к покупке
                if (empty($item['price'])) {
                    $item['canBuy'] = false;
                }

                if ($isMaxQuantity) {
                    $quantity = self::getQuantity($item, $params['__QUANTITY']);

                    // Удаляем лишние поля
                    unset($item['quantityTrace'], $item['canBuyZero'], $item['quantity']);

                    if ($quantity !== null) {
                        $item['quantity'] = $quantity;
                    }
                }

                $items[$k] = $item;
            }

            Typograph::processItems($items, ['name']);
        });


        // Собираем торговые предложения по ID товара, к которому они относятся
        if (!$params['__IGNORE_CML2LINK']) {
            $result = [];

            foreach ($offers as $k => $item) {
                $cml2link = $item['cml2link'];

                if (!$result[$cml2link]) {
                    $result[$cml2link] = [];
                }

                unset($item['cml2link']);
                $result[$cml2link][] = $item;
            }

            $offers = $result;
        }


        return $offers;
    }


    /**
     * Функция преобразует в массиве ID товаров или торговых предложений
     * айдишники торговых предложений в ID их товаров
     * @param array $ids — ID товаров или торговых предложений
     * @return array — ID товаров
     */
    public static function getProductIds(array $ids): array {
        $isAdmin = User::isAdmin();

        $items = CacheManager::getIblockItemsFromCache([
            'IBLOCK_CODE'  => self::IBLOCK_CODE,
            'FILTER'       => ['ACTIVE' => 'Y'],
            'SELECT'       => ['ID:int>id'],
            'ASSOC'        => 'Y',
            '__SKIP_CACHE' => $isAdmin,
        ]);

        $offers = CacheManager::getIblockItemsFromCache([
            'IBLOCK_CODE'  => self::IBLOCK_OFFERS_CODE,
            'FILTER'       => ['ACTIVE' => 'Y'],
            'SELECT'       => ['ID:int>id', 'PROPERTY_CML2_LINK:int>cml2link'],
            'ASSOC'        => 'Y',
            '__SKIP_CACHE' => $isAdmin,
        ]);

        $result = [];

        foreach ($ids as $id) {
            if ($items[$id]) {
                $result[] = $id;

            } else {
                $offer = $offers[$id];
                if (!$offer) {
                    continue;
                }

                $result[] = $offers[$id]['cml2link'];
            }
        }

        return $result;
    }


    /**
     * Функция возвращает массив анимаций разделов каталога
     * @return array [[ID анимации] => [символьный код анимации]]
     */
    public static function getAnimations(): array {
        $params = [
            'IBLOCK_CODE' => self::IBLOCK_SECTION_ANIMATIONS,
            'FILTER'      => ['ACTIVE' => 'Y'],
            'SELECT'      => ['ID:int>id', 'CODE>code'],
            'ASSOC'       => 'Y',
        ];

        $items = CacheManager::getIblockItemsFromCache($params);

        return array_column($items, 'code', 'id');
    }


    /**
     * Возвращает таблицы характеристик продуктов и офферов
     *
     * @return array
     * @throws ArgumentException
     * @throws LoaderException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public static function getFeatures(): array {
        // Параметры выборки продуктов
        $productsParams = [
            'IBLOCK_CODE'  => self::IBLOCK_CODE,
            'FILTER'       => ['ACTIVE' => 'Y'],
            'SELECT'       => ['ID:int>id',],
            'ASSOC'        => 'Y',
            '__SKIP_CACHE' => User::isAdmin(),
        ];

        // Параметры выборки офферов
        $offersParams = [
            'IBLOCK_CODE'  => self::IBLOCK_OFFERS_CODE,
            'FILTER'       => [
                'ACTIVE'              => 'Y',
                '>PROPERTY_CML2_LINK' => 0,
            ],
            'SELECT'       => [
                'ID:int>id',
                'PROPERTY_CML2_LINK:int>cml2link',
            ],
            '__SKIP_CACHE' => User::isAdmin(),
        ];

        return CacheManager::getIblockItemsFromCache($productsParams, static function (&$products) use ($offersParams) {
            self::setFeatures($products);

            $resultProducts = [];

            foreach ($products as $product) {
                // Если таблица есть
                if (!empty($product['featuresTable'])) {
                    $resultProducts[$product['id']] = $product['featuresTable'];
                }
            }

            [$resultProducts, $dictionary] = self::getFeaturesAndDictionary($resultProducts, []);

            $offers = El::getList($offersParams);

            self::setFeatures($offers);

            $resultOffers = [];

            foreach ($offers as $offer) {
                // Проверяем активность продукта
                if (!empty($products[$offer['cml2link']])) {
                    $resultOffers[$offer['id']] = $offer['featuresTable'];
                }
            }

            [$resultOffers, $dictionary] = self::getFeaturesAndDictionary($resultOffers, $dictionary);

            $products = [
                'dictionary' => $dictionary,
                'products'   => $resultProducts,
                'offers'     => $resultOffers,
            ];
        });
    }


    /**
     * Блокирует активацию продукта в техническом разделе
     *
     * @param array $fields
     * @return mixed
     */
    public static function disallowActivatedProductInTechSection(array $fields): ?bool {
        /**
         * @global $APPLICATION
         */
        global $APPLICATION;

        $iblockId = !empty($fields['IBLOCK_ID']) ? (int)$fields['IBLOCK_ID'] : 0;
        $sectionIds = !empty($fields['IBLOCK_SECTION']) ? array_map('intval', $fields['IBLOCK_SECTION']) : [];

        // Устанавливаемая активность
        $active = $fields['ACTIVE'];

        if ($active !== 'Y' || empty($iblockId) || empty($sectionIds)
            || Help::getIblockIdByCode(self::IBLOCK_CODE) !== $iblockId) {
            return null;
        }

        // Получаем предыдущее значение активности
        $previousActive = null;
        if (!empty($fields['ID'])) {
            $el = El::getList([
                'IBLOCK_ID' => $iblockId,
                'FILTER'    => [
                    'ID' => $fields['ID'],
                ],
                'SELECT'    => [
                    'ACTIVE>active',
                ],
            ]);

            $previousActive = $el[0]['active'];
        }

        // Если состояние активности не изменилось
        if ($previousActive === $active) {
            return null;
        }

        // Получаем идентификатор технического раздела
        $sectionTech = Sect::getList([
            'IBLOCK_ID' => $iblockId,
            'FILTER'    => [
                '=CODE' => SyncProducts::SECTION_ADD_CODE,
            ],
            'SELECT'    => [
                'ID:int>id',
            ],
            'NAV'       => ['nTopCount' => 1],
        ]);

        $sectionTechId = $sectionTech[0]['id'] ?? null;

        if (in_array($sectionTechId, $sectionIds, true)) {
            $APPLICATION->ThrowException('Перед активацией продукт необходимо перенести из служебного раздела');

            return false;
        }

        return null;
    }


    /**
     * Функция возвращает подробную информацию о торговых предложениях
     * @param int $productId — ID товара, офферы которого надо вернуть
     * @return array
     * @throws ArgumentException
     * @throws LoaderException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    private static function getOffersDetail(int $productId): array {
        $params = self::getOfferQueryParams();

        $params['FILTER']['=PROPERTY_CML2_LINK'] = $productId;
        $params['SELECT'] = array_merge($params['SELECT'], [
            'PROPERTY_ARTICLE:string?>article',
            'PROPERTY_BARCODE:string?>barcode',
            'PROPERTY_PRODUCT_CODE:string?>productCode',
            'PROPERTY_PHOTOS:Image[]?>photos',
            'PROPERTY_YOUTUBE:DescriptiveString[]?>youTube',
            'PROPERTY_YOUTUBE_PREVIEW:ImageSrc[]?>youTubePreview',
            'PROPERTY_ADVANTAGES:Image[]?>advantages',
            'PROPERTY_FEATURES_MAIN:Table?>featuresMain',
            'PROPERTY_FEATURES_TEXT:Html?>featuresText',
            'PROPERTY_DOCS:File[]?>docs',
            'PROPERTY_KITCHENS:int[]?>kitchens',
            'PROPERTY_WEIGHT_GROSS:int?>weightGross',
        ]);

        $items = CacheManager::getIblockItemsFromCache($params, static function (&$items) {
            $iblockId = Help::getIblockIdByCode(self::IBLOCK_OFFERS_CODE);

            self::typoAdvantages($items);

            // Документы
            Documents::formatDocs($items);

            // Кухни
            self::setKitchens($items);

            // Таблицы характеристик
            self::setFeatures($items);

            foreach ($items as $k => $item) {
                // Определим картинку превью
                if (!$item['thumb'] && $item['photos']) {
                    $item['thumb'] = self::getThumb($item['photos'][0]);
                }

                // Оффер без цены запрещен к покупке
                if (empty($item['price'])) {
                    $items[$k]['canBuy'] = false;
                }

                $seo = El::getSeo($iblockId, $item);
                if ($seo) {
                    $items[$k]['seo'] = $seo;
                }
            }
        });

        // Сортировка предложений
        $items = Arr::sortArrByFields($items, [
            'sort'          => SORT_ASC,
            'canBuy'        => SORT_DESC,
            'priceDiscount' => SORT_ASC,
            'price'         => SORT_ASC,
        ], [
            'priceDiscount' => 'price',
        ]);

        El::applyAssoc($items, $params['ASSOC']);

        return $items;
    }


    /**
     * @return array — Набор минимальных параметров выборки торговых предложений
     */
    private static function getOfferQueryParams(): array {
        return [
            'IBLOCK_CODE'  => self::IBLOCK_OFFERS_CODE,
            'FILTER'       => [
                'ACTIVE'              => 'Y',
                '>PROPERTY_CML2_LINK' => 0,
            ],
            'SELECT'       => [
                'ID:int>id',
                'SORT:int>sort',
                'CODE:string>code',
                'NAME:string>name',
                'PREVIEW_PICTURE:Image?>thumb',

                'PROPERTY_ARTICLE:string?>article',
                'PROPERTY_CML2_LINK:int>cml2link',
                'PROPERTY_COLOR:int?>color',
                'PROPERTY_COLOR_SECOND:int?>colorSecond',
                'PROPERTY_STYLE:int[]?>style',
                'PROPERTY_SIZE:string?>size',
                'PROPERTY_PHOTOS:Image[]?>photos',

                'CATALOG_GROUP_1:X', // Необходимо для выборки цен
                'CATALOG_PRICE_1:int?>price',
                'CATALOG_AVAILABLE:bool?>canBuy',
            ],
            'ORDER' => [
                'SORT'              => 'ASC',
                'CATALOG_AVAILABLE' => 'DESC',
                'CATALOG_PRICE_1'   => 'ASC',
                'ID'                => 'DESC',
            ],
            '__SKIP_CACHE' => true,
        ];
    }


    private static function getThumb(array $image): array {
        $pathInfo = pathinfo($image['src']);

        $thumb = $pathInfo['extension'] !== 'png'
            ? Photos::getThumb($image['id'], [920, 920], 75)
            : $image;

        unset($thumb['id'], $thumb['size'], $thumb['name'], $thumb['alt']);

        return $thumb;
    }


    /**
     * Функция типографит описания преимуществ товаров или торговых предложений
     * @param array $items — Массив товаров или торговых предложений
     */
    public static function typoAdvantages(array &$items): void {
        $typo = new TypographLight();

        foreach ($items as $k => $item) {
            // Типографим описания преимуществ
            foreach ($item['advantages'] as $aKey => $advantage) {
                if (!$advantage['alt']) {
                    continue;
                }
                $items[$k]['advantages'][$aKey]['alt'] = $typo->getResult($advantage['alt']);
            }
        }
    }


    /**
     * Модифицирует продукты и офферы, добавляя цену со скидкой
     * @param array $items — Массив товаров или торговых предложений
     */
    private static function setDiscountPrices(array &$items): void {
        try {
            // Получаем данные из кеша скидок
            $discountItems = ProductionDiscountCache::getList();

            foreach ($items as $keyItem => $item) {
                // Если нет офферов, устанавливаем цену со скидкой для товаров
                if (empty($item['offers'])) {
                    $discountKey = Arr::findInArr($discountItems, 'id', $item['id']);

                    if ($discountKey !== false) {
                        $items[$keyItem]['priceDiscount'] = $discountItems[$discountKey]['discountPrice'];
                    }

                    continue;
                }

                foreach ($item['offers'] as $keyOffer => $offer) {
                    $discountKey = Arr::findInArr($discountItems, 'id', $offer['id']);

                    if ($discountKey !== false) {
                        $items[$keyItem]['offers'][$keyOffer]['priceDiscount'] = $discountItems[$discountKey]['discountPrice'];
                    }
                }
            }
        } catch (Exception $exception) {
        }
    }


    /**
     * Функция добавляет информацию о кухнях к товару или торговому предложению
     * @param array $items — Массив элементов инфоблока со свойством `kitchens`
     */
    private static function setKitchens(array &$items): void {
        $kitchensAll = Kitchens::getItems();

        foreach ($items as $k => $item) {
            // Кухни текущего элемента по привязке «Товар(оффер) —> Кухня»
            $kitchens = [];
            foreach ($items[$k]['kitchens'] as $kitchenId) {
                foreach ($kitchensAll as $kitchen) {
                    if ($kitchen['id'] === $kitchenId) {
                        $kitchens[] = $kitchen;
                    }
                }
            }

            // Общие кухни по привязке «Кухня —> Товар»
            $targetId = $item['cml2link'] ?: $item['id'];

            foreach ($kitchensAll as $kitchen) {
                if (!in_array($targetId, $kitchen['products'], true)) {
                    continue;
                }
                $kitchens[] = $kitchen;
            }

            if (!empty($kitchens)) {
                $items[$k]['kitchens'] = array_slice($kitchens, 0, 24);
            }
        }
    }


    /**
     * Функция определяет картинку превью для товаров из первой фотки товара
     * @param array $items
     */
    private static function setThumb(array &$items): void {
        foreach ($items as $k => $item) {
            // Определим картинку превью
            if (!$item['thumb'] && !empty($items[$k]['photos'])) {
                $items[$k]['thumb'] = self::getThumb($items[$k]['photos'][0]);
            }
        }
    }


    /**
     * Устанавливает таблицы характеристик
     *
     * @param array $items
     * @throws ArgumentException
     * @throws LoaderException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    private static function setFeatures(array &$items): void {
        // Получаем таблицы характеристик
        $tables = FeaturesTableProcessed::getItems();

        foreach ($items as $k => $item) {
            if (!empty($tables[$item['id']])) {
                $items[$k]['featuresTable'] = $tables[$item['id']];
            }
        }
    }


    /**
     * Проверяет возможность покупки хотя бы одного оффера
     *
     * @param array $offers
     * @return bool
     */
    private static function isCanBuyOffer(array $offers): bool {
        foreach ($offers as $offer) {
            if (!empty($offer['canBuy'])) {
                return true;
            }
        }

        return false;
    }


    /**
     * Возвращает данные характеристик с выделенным словарем
     *
     * @param array $items
     * @param array $dictionary
     * @return array
     */
    private static function getFeaturesAndDictionary(array $items, array $dictionary): array {
        foreach ($items as $k => $features) {
            $resultFeature = [];

            foreach ($features as $feature) {
                if (($dictKey = array_search($feature[0], $dictionary, true)) === false) {
                    $dictionary[] = $feature[0];

                    $dictKey = count($dictionary) - 1;
                }

                if (is_numeric($feature[1])) {
                    $feature[1] = (int)$feature[1];
                }

                $resultFeature[$dictKey] = $feature[1];
            }

            $items[$k] = $resultFeature;
        }

        return [$items, $dictionary];
    }

}
