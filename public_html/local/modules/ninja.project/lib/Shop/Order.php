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
use Bitrix\Sale\ResultError;
use Ninja\Helper\Dbg;
use Ninja\Project\Catalog\CatalogCart;

class Order
{
    public static string $state = '';

    public static function onSaleOrderDeleted($order, $isSuccess)
    {
        Dbg::show('onSaleOrderDeleted');
        die();
    }

    /**
     * @throws ObjectNotFoundException
     * @throws NotSupportedException
     * @throws NotImplementedException
     * @throws ArgumentNullException
     * @throws ArgumentTypeException
     * @throws ArgumentOutOfRangeException
     * @throws ArgumentException
     */
    public static function onSaleOrderBeforeSaved(Event $event)
    {
        $isNew = $event->getParameter('IS_NEW');

        if (self::$state === 'update' || $isNew === false) {
            return true;
        }

        self::$state = 'update';

        $order = $event->getParameter("ENTITY");

        $collection = $order->getPaymentCollection();

        $basket = $order->getBasket();
        foreach ($basket as $key => $basketItem)
        {
            $productId = $basketItem->getProductId();
            $siteId = 'm' . ($key + 1);

            CatalogCart::clearCartBySiteId($siteId);
            CatalogCart::add($productId, 1, $siteId);

            $params = [
                'USER_ID' => $order->getUserId(),
                'PERSON_TYPE_ID' => $order->getPersonTypeId(),
                'DELIVERY_ID' => $order->getDeliverySystemId()[0],
                'PAYMENT_ID' => $collection[0]->getPaymentSystemId(),
                'SITE_ID' => $siteId,
            ];
            $order = \Ninja\Helper\Sale\Order::createWithCurrentCart($params);
            $order->save();

            /*echo '<pre>';
            print_r([
                'SITE_ID' => $order->getSiteId(),
                'USER_ID' => $order->getUserId(),
                'FUSER_ID' => Buyer::getId(),
                'PERSON_TYPE_ID' => $order->getPersonTypeId(),
                'DELIVERY_ID' => $order->getDeliverySystemId()[0],
                'PAYMENT_ID' => $collection[0]->getPaymentSystemId(),
                'product' => [
                    'id' => $basketItem->getProductId(),
                    'quantity' => $basketItem->getQuantity(),
                    'currency' => $order->getCurrency(),
                ],
            ]);
            echo '</pre>';*/
        }

        CatalogCart::clearCartBySiteId(SITE_ID);

        return new EventResult(
            EventResult::ERROR,
            ResultError::create(new Error('Cancel order', 'GRAIN_IMFAST'))
        );
    }
}
