<?php


namespace ALS\Project\Catalog;


use Ninja\Helper\Sale\Buyer;
use Bitrix\Currency\CurrencyManager;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use CSaleBasket;
use Ninja\Helper\Sale\Cart;

class CatalogCart {
    private const RESPONSES = [
        'ERROR_INNER'       => [
            'success' => false,
            'message' => 'error inner',
        ],
        'PRODUCT_NOT_FOUND' => [
            'success' => false,
            'message' => 'Product is not in cart',
        ],
        'ERROR_ADD'         => [
            'success' => false,
            'message' => 'Error adding product',
        ],
        'ERROR_ADDS'        => [
            'success' => false,
            'message' => 'Error adding products',
        ],
    ];


    public static function add(int $id, int $count = 1): array {
        $basket = Cart::getCartByFUser(Buyer::getId());

        if ($basket === null) {
            return self::RESPONSES['ERROR_INNER'];
        }

        // Корректировка количества продуктов к добавлению в корзину
        if ($count > 1) {
            // Получаем данные продуктов и офферов
            $items = Production::getItems(['ASSOC' => 'Y'], [], true);
            $allOffers = Production::getOffers(['ASSOC' => 'Y', '__IGNORE_CML2LINK' => 'Y'], true);

            $productOrOffer = $allOffers[$id] ?? $items[$id];

            $quantityMax = $productOrOffer['quantity'] ?? null;

            // Если к покупке разрешено меньше, чем есть в наличие
            if ($quantityMax !== null && $quantityMax < $count) {
                $count = $quantityMax;
            }
        }

        if ($item = $basket->getExistsItem('catalog', $id)) {
            $item->setField('QUANTITY', $count);
        } else {
            $item = $basket->createItem('catalog', $id);
            $item->setFields([
                'QUANTITY'               => $count,
                'CURRENCY'               => CurrencyManager::getBaseCurrency(),
                'LID'                    => 's1',
                'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
            ]);
        }

        $basket->save();

        if ($item->getId() === 0) {
            return self::RESPONSES['ERROR_ADD'];
        }

        return self::getSuccess();
    }


    /**
     * Добавляет в корзину продукты
     *
     * @param array $ids
     * @return array|null
     */
    public static function adds(array $ids): ?array {
        $basket = \ALS\Helper\Sale\Cart::getCartByFUser(Buyer::getId());

        if ($basket === null) {
            return self::RESPONSES['ERROR_INNER'];
        }

        $count = 1;
        $successIds = [];

        foreach ($ids as $id) {
            if ($item = $basket->getExistsItem('catalog', $id)) {
                $item->setField('QUANTITY', $count);
            } else {
                $item = $basket->createItem('catalog', $id);
                $item->setFields([
                    'QUANTITY'               => $count,
                    'CURRENCY'               => CurrencyManager::getBaseCurrency(),
                    'LID'                    => 's1',
                    'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
                ]);
            }

            $basket->save();

            if ($item->getId()) {
                $successIds[] = $id;
            }
        }

        if ($successIds) {
            $result = self::getSuccess();

            $result['ids'] = $successIds;
        } else {
            $result = self::RESPONSES['ERROR_ADDS'];
        }

        return $result;
    }


    public static function getData(): array {
        // Получаем список товаров в корзине
        $cartItems = self::getUserCartItems();

        // Добавим к записям информацию о товарах
        if (count($cartItems)) {
            $items = Production::getItems(['ASSOC' => 'Y'], [], true);
            $allOffers = Production::getOffers(['ASSOC' => 'Y', '__IGNORE_CML2LINK' => 'Y'], true);

            foreach ($cartItems as $k => $cartItem) {
                $product = $items[$cartItem['productId']] ?? null;
                $cartItems[$k]['productionId'] = $cartItem['productId'];
                $offer = null;

                if ($product === null) {
                    $offer = $allOffers[$cartItem['productId']] ?? null;

                    // Если продукт стал недоступен. Например, при синхронизации с 1С деактивирован
                    if ($offer === null) {
                        self::deleteById($cartItem['productId']);

                        unset($items[$k]);

                        continue;
                    }

                    $product = $items[$offer['cml2link']];

                    $cartItems[$k]['offerId'] = $cartItem['productId'];
                    $cartItems[$k]['productId'] = $product['id'];
                }

                // Устанавливаем количество к покупке + цены
                if ($offer !== null) {
                    $quantityMax = $offer['quantity'] ?? null;

                    $product = self::setPrice($product, $cartItem, $offer['id']);
                } else {
                    $quantityMax = $product['quantity'] ?? null;

                    $product = self::setPrice($product, $cartItem);
                }

                if ($quantityMax !== null) {
                    $cartItems[$k]['quantityMax'] = $quantityMax;
                }

                $cartItems[$k]['item'] = $product;
            }

            $cartItems = array_values($cartItems);
        }

        // Устанавливаем итоговые цены
        $summary = \ALS\Helper\Sale\Cart::getSummary($cartItems ?? []);

        $data = [
            'fullPrice' => $summary['price'],
            'summary'   => $summary['priceDiscount'],
        ];

        // Устанавливаем позиции корзины, удаляя лишние данные
        $data['items'] = array_map(
            static function ($cartItem) {
                unset($cartItem['price'], $cartItem['oldPrice']);

                return $cartItem;
            },
            $cartItems
        );

        // Устанавливаем рекомендации
        $data['recommends'] = $cartItems ? self::getRecommended(array_column($cartItems, 'productionId'), 1) : [];

        // Устанавливаем купоны
        $activeCoupons = \ALS\Helper\Sale\Coupon::getActiveList(['COUPON>code']);
        if (!empty($activeCoupons)) {
            $data['coupons'] = array_column($activeCoupons, 'code');
        }

        return $data;
    }


    public static function deleteById(int $id): array {
        $basket = \ALS\Helper\Sale\Cart::getCartByFUser(Buyer::getId());

        if ($basket === null) {
            return [
                'success' => false,
                'message' => 'error inner',
            ];
        }

        if ($item = $basket->getExistsItem('catalog', $id)) {
            $item->delete();
            $basket->save();

            return self::getSuccess();
        }

        return self::RESPONSES['PRODUCT_NOT_FOUND'];
    }


    /**
     * Функция возвращает массив элементов корзины текущего пользователя
     *
     * @return array
     */
    public static function getUserCartItems(): array {
        $params = [
            'SELECT'       => [
                'ID:int>id',
                'PRICE:int>price',
                'OLD_PRICE:int>oldPrice',
                'QUANTITY:int>quantity',
                'PRODUCT_ID:int>productId',
            ],
            'USE_DISCOUNT' => true,
        ];

        return \ALS\Helper\Sale\Cart::getList($params);
    }


    public static function deleteAll(): bool {
        try {
            Loader::includeModule('sale');
        } catch (LoaderException $e) {
        }

        return CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());
    }


    private static function getSuccess(): array {
        return [
            'success' => true,
            'cart'    => self::getData(),
        ];
    }


    /**
     * Устанавливает цену продукту или офферу вложенному в продукт
     *
     * @param array $product
     * @param array $cartItem
     * @param int|null $offerId
     * @return array
     */
    private static function setPrice(array $product, array $cartItem, int $offerId = null): array {
        if ($offerId === null) {
            // Устанавливаем цены
            if ($cartItem['oldPrice'] !== null) {
                $product['price'] = $cartItem['oldPrice'];
                $product['priceDiscount'] = $cartItem['price'];
            } else {
                $product['price'] = $cartItem['price'];

                if (isset($product['priceDiscount'])) {
                    unset($product['priceDiscount']);
                }
            }
        } else {
            foreach ($product['offers'] as $key => $offer) {
                if ($offerId !== $offer['id']) {
                    continue;
                }

                $product['offers'][$key] = self::setPrice($offer, $cartItem);

                break;
            }
        }

        return $product;
    }

    /**
     * Возвращает рекомендованные продукты
     *
     * @param array $productionIds
     * @param int $limit
     * @return array
     */
    private static function getRecommended(array $productionIds, int $limit): array {
        $result = [];

        // Получаем список рекомендованных товаров
        $products = (new Recommendation())->getItems($productionIds, $limit);

        foreach ($products as $product) {
            $offerSelected = null;

            if (array_key_exists('offers', $product)) {
                foreach ($product['offers'] as $offer) {
                    if (!empty($offer['canBuy'])) {
                        $offerSelected = $offer;

                        break;
                    }
                }
            }

            $item = [
                'id'           => -1 * $product['id'],
                'productionId' => $offerSelected['id'] ?? $product['id'],
                'productId'    => $product['id'],
                'quantity'     => 1,
                'item'         => $product,
            ];

            if ($offerSelected !== null) {
                $item['offerId'] = $offerSelected['id'];

                $quantityMax = $offerSelected['quantity'] ?? null;
            } else {
                $quantityMax = $product['quantity'] ?? null;
            }

            if ($quantityMax !== null) {
                $item['quantityMax'] = $quantityMax;
            }

            $result[] = $item;
        }

        return $result;
    }

}
