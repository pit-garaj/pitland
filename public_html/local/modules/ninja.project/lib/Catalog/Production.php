<?php


namespace Ninja\Project\Catalog;


use Ninja\Helper\Arr;
use Ninja\Helper\Cache\CacheSettings;
use Ninja\Helper\CacheManager;
use Ninja\Helper\Catalog;
use Ninja\Helper\Dbg;
use Ninja\Helper\Help;
use Ninja\Helper\Iblock\Element;
use Ninja\Helper\Sect;
use Ninja\Project\Helper\Typograph;
use Ninja\Project\User;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\LoaderException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Exception;


class Production {
    public const IBLOCK_CODE = 'CATALOG_PRODUCTION';
    public const IBLOCK_OFFERS_CODE = 'CATALOG_OFFERS';
    public const IBLOCK_SECTION_ANIMATIONS = 'CATALOG_SECTION_ANIMATIONS';
    public const CACHE_TIME = 3600;
    public const CACHE_DIR = '/CART_PRODUCTION';




    /**
     * Функция возвращает массив всех товаров с офферами в кратком виде
     * @param array $customParams — Массив параметров кастомной выборки
     * @param array $offersCustomParams
     * @param bool $isMaxQuantity
     * @return array
     */
    public static function getItems(array $customParams = [], array $offersCustomParams = [], bool $isMaxQuantity = false): array {
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
            ],
        ];

        $params = array_merge_recursive($defaultParams, $customParams);

        // Параметры для офферов
        if (!empty($offersCustomParams)) {
            $params['offersCustomParams'] = $offersCustomParams;
        }

        $callback = static function () use ($params, $isMaxQuantity) {

            $items = Element::getList($params);
            $allOffers = self::getOffers($params['offersCustomParams'] ?? [], $isMaxQuantity);

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
                    $quantity = self::getQuantity($item, $params['__QUANTITY'] ?? []);

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

            return $items;
        };

        $cacheSettings = (new CacheSettings(self::CACHE_DIR, $params, $callback))
            ->setUseTags()
            ->setTtl(self::CACHE_TIME);

        $items = \Ninja\Helper\Cache\CacheManager::getDataCache($cacheSettings);

        $items = Arr::sortArrByFields($items, [
            'sort'   => SORT_ASC,
            'canBuy' => SORT_DESC,
            'price'  => SORT_ASC,
        ]);

        // El::applyAssoc($items, $params['ASSOC']);

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

        $callback = static function () use ($params, $isMaxQuantity) {
            $result = [];

            $items = Element::getList($params);

            foreach ($items as $k => $item) {
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

            return $result;
        };

        $cacheSettings = (new CacheSettings(self::CACHE_DIR, $params, $callback))
            ->setUseTags()
            ->setTtl(self::CACHE_TIME);

        $offers = \Ninja\Helper\Cache\CacheManager::getDataCache($cacheSettings);

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

}
