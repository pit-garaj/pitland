<?php

declare(strict_types=1);

namespace Ninja\Project\Shop;


use Bitrix\Sale\Basket;
use Bitrix\Sale\Fuser;

class Order
{
    public static function onSaleOrderBeforeSaved(\Bitrix\Main\Event $event)
    {
        $order = $event->getParameter("ENTITY");

        $collection = $order->getPaymentCollection();

        $basket = $order->getBasket();
        foreach ($basket as $basketItem)
        {
            echo '<pre>';
            print_r([
                'USER_ID' => $order->getUserId(),
                'PERSON_TYPE_ID' => $order->getPersonTypeId(),
                'DELIVERY_ID' => $order->getDeliverySystemId()[0],
                'PAYMENT_ID' => $collection[0]->getPaymentSystemId(),
                'product' => [
                    'id' => $basketItem->getProductId(),
                    'quantity' => $basketItem->getQuantity(),
                    'currency' => $order->getCurrency(),
                ],
            ]);
            echo '</pre>';
        }

        die();

        return false;
    }
}
