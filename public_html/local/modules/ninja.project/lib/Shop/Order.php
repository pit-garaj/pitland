<?php

declare(strict_types=1);

namespace Ninja\Project\Shop;


use Bitrix\Main\ArgumentException;
use Bitrix\Main\ArgumentNullException;
use Bitrix\Main\ArgumentOutOfRangeException;
use Bitrix\Main\ArgumentTypeException;
use Bitrix\Main\Error;
use Bitrix\Main\Event;
use Bitrix\Main\EventResult;
use Bitrix\Main\NotImplementedException;
use Bitrix\Main\NotSupportedException;
use Bitrix\Main\ObjectNotFoundException;
use Bitrix\Main\SystemException;
use Bitrix\Sale\Delivery\Services\Manager;
use Bitrix\Sale\ResultError;
use Exception;
use Ninja\Project\Catalog\CatalogCart;
use Ninja\Project\Catalog\CatalogCartStore;

class Order
{
    public static string $splitCode = 'split';
    public static string $deliveryCode = 'bx_0684f42f9223eed692a1c2acd7f61544';

    /**
     * @throws ObjectNotFoundException
     * @throws NotSupportedException
     * @throws NotImplementedException
     * @throws ArgumentNullException
     * @throws ArgumentTypeException
     * @throws ArgumentOutOfRangeException
     * @throws ArgumentException
     * @throws SystemException
     * @throws Exception
     */
    public static function onSaleOrderBeforeSaved(Event $event)
    {
        $order = $event->getParameter('ENTITY');

        /**
         * Отменяет если не «Доставка»
         */
        if (self::checkDelivery((int) $order->getField('DELIVERY_ID')) === false) {
            return true;
        }

        /**
         * Отменяет если заказ виртуальный
         */
        if ($order->getField('ADDITIONAL_INFO') === self::$splitCode) {
            return true;
        }

        $orderIds = [];
        $basket = $order->getBasket();
        $productsData = self::getProductsData($basket);

        // Получаем данные основного заказа
        $orderProps = [];
        $propertyCollectionOrder = $order->getPropertyCollection();
        foreach($propertyCollectionOrder as $property) {
            $orderProps[$property->getField('CODE')] = $property->getValue();
        }

        $distributeProductsByStores = CatalogCartStore::distributeProductsByStores($productsData);
        foreach ($distributeProductsByStores as $virtualSiteId => $productIds) {
            CatalogCart::clearCartBySiteId($virtualSiteId);

            foreach ($productIds as $productId => $productQuantity) {
                CatalogCart::add($productId, $productQuantity, $virtualSiteId);
            }

            $params = [
                'SITE_ID' => $virtualSiteId,
                'PERSON_TYPE_ID' => $order->getField('PERSON_TYPE_ID'),
                'DELIVERY_ID' => $order->getField('DELIVERY_ID'),
                'PAYMENT_ID' => $order->getField('PAY_SYSTEM_ID'),
                'COMPANY_ID' => $order->getField('COMPANY_ID'),
                'ALLOW_DELIVERY' => $order->getField('ALLOW_DELIVERY'),
                'PAYED' => $order->getField('PAYED'),
                'STATUS_ID' => $order->getField('STATUS_ID'),
                'CANCELED' => $order->getField('CANCELED'),
                'CURRENCY' => $order->getField('CURRENCY'),
                'DATE_STATUS' => $order->getField('DATE_STATUS'),
                'EMP_STATUS_ID' => $order->getField('EMP_STATUS_ID'),
                'USER_DESCRIPTION' => $order->getField('USER_DESCRIPTION'),
                'COMMENTS' => $order->getField('COMMENTS'),
            ];

            $subOrder = \Ninja\Helper\Sale\Order::createWithCurrentCart($params);
            if ($subOrder) {
                // Устанавливает признак что заказ виртуальный
                $subOrder->setField('ADDITIONAL_INFO', self::$splitCode);

                // Устонавливает компанию в зависимости от склада
                $subOrder->setField('COMPANY_ID', Company::getIdByCode($virtualSiteId) ?? $order->getField('COMPANY_ID'));

                // Устонавливаем данные заказа
                $propertyCollectionSubOrder = $subOrder->getPropertyCollection();
                foreach($propertyCollectionSubOrder as $property) {
                    $propertyCode = $property->getField('CODE');

                    if (!empty($orderProps[$propertyCode])) {
                        $property->setValue($orderProps[$propertyCode]);
                    }
                }

                // Сохраняет заказ
                $subOrder->save();

                $subOrderId = $subOrder->getId();
                $orderIds[] = $subOrderId;

                if ($subOrderId) {
                    $subOrder = \Bitrix\Sale\Order::load($subOrderId);
                    if ($subOrder) {
                        // Устонавливет реальный SITE_ID
                        $subOrder->setField('LID', $order->getSiteId());
                        $subOrder->save();
                    }
                }
            }
        }

        /**
         * Очищает корзину
         */
        CatalogCart::clearCartBySiteId(SITE_ID);

        return new EventResult(
            EventResult::ERROR,
            ResultError::create(new Error('CANCEL_ORDER:' . implode('-', $orderIds), 'GRAIN_IMFAST'))
        );
    }


    /**
     * @throws SystemException
     */
    public static function checkDelivery(int $id): bool
    {
        $delivery = Manager::getById($id);
        return $delivery['XML_ID'] === self::$deliveryCode;
    }


    /**
     * Метод получает данные по товарам в корзине
     * Колличество в корзине и колличество на складах
     *
     * @param object $basket
     * @return array
     */
    public static function getProductsData(object $basket): array
    {
        $result = [];
        foreach ($basket as $basketItem) {
            $productId = $basketItem->getProductId();
            $productQuantity = (int) $basketItem->getQuantity();
            $result[$productId] = [
                'quantity' => $productQuantity,
                'stores' => CatalogCartStore::getAllowStoresAmountForProduct($productId),
            ];
        }

        return $result;
    }
}
