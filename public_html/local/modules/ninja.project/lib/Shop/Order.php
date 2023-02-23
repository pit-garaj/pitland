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
use Ninja\Helper\Dbg;
use Ninja\Project\Catalog\CatalogCart;
use Ninja\Project\Catalog\CatalogCartStore;
use Ninja\Project\Catalog\CatalogStore;
use Ninja\Project\Catalog\CatalogStoreGateway;

class Order
{
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
        $order = $event->getParameter("ENTITY");

        /**
         * Отменяет если не «Доставка»
         */
        if (self::checkDelivery((int) $order->getField('DELIVERY_ID')) === false) {
            return true;
        }

        /**
         * Отменяет если заказ виртуальный
         */
        if ($order->getField('EXTERNAL_ORDER') === 'Y') {
            return true;
        }

        $orderIds = [];

        $basket = $order->getBasket();

        $productIds = [];
        foreach ($basket as $basketItem) {
            $productId = $basketItem->getProductId();
            $productQuantity = (int) $basketItem->getQuantity();
            $productIds[$productId] = $productQuantity;
        }

        $distributeProductsByStores = CatalogCartStore::distributeProductsByStores($productIds);
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
                'CURRENCY' => $order->getField('CURRENCY'),
                'STATUS_ID' => $order->getField('STATUS_ID'),
                'DATE_STATUS' => $order->getField('DATE_STATUS'),
                'EMP_STATUS_ID' => $order->getField('EMP_STATUS_ID'),
            ];
            $subOrder = \Ninja\Helper\Sale\Order::createWithCurrentCart($params);
            if ($subOrder) {
                // Устанавливает признак что заказ виртуальный
                $subOrder->setField('EXTERNAL_ORDER', 'Y');
                $subOrder->save();

                $subOrderId = $subOrder->getId();
                $orderIds[] = $subOrderId;

                if ($subOrderId) {
                    $subOrder = \Bitrix\Sale\Order::load($subOrderId);
                    if ($subOrder) {
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
}
