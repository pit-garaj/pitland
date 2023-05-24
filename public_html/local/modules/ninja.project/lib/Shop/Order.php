<?php

declare(strict_types=1);

namespace Ninja\Project\Shop;


use Bitrix\Main\Application;
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
use CEvent;
use Exception;
use Ninja\Helper\Price;
use Ninja\Project\Catalog\CatalogCart;
use Ninja\Project\Catalog\CatalogCartStore;

class Order
{
    public static string $splitCode = 'split';
    public static string $oneClickToBuyCode = 'Быстрый заказ';
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
        /**
         * Костыль!!!
         * Данные берем из POST запроса, потому что не получилось получить актуальный номер телефона.
         * getPropertyCollection выдает старый а если нет старого то ничего.
         */
        $orderProps = self::getOrderPropsByPost($order);

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

                    $orderPrice = ($subOrder->getPrice() && $subOrder->getCurrency()) ? Price::format($subOrder->getPrice(), ' ' . $subOrder->getCurrency()) : '';

                    $arMessageFields = array(
                        "RS_ORDER_ID" => $subOrderId,
                        "CLIENT_NAME" => $orderProps['FIO'],
                        "ACCOUNT_NUMBER" => $subOrderId,
                        "PHONE" => $orderProps['PHONE'],
                        "COMMENT" => $subOrder->getField('USER_DESCRIPTION'),
                        "RS_DATE_CREATE" => ConvertTimeStamp(false, "FULL"),
                    );

                    if ($orderPrice) {
                        $arMessageFields['ORDER_PRICE'] = $orderPrice;
                    }

                    if (!empty($orderProps['EMAIL'])) {
                        $arMessageFields['EMAIL_BUYER'] = $orderProps['EMAIL'];
                    }

                    if ($subOrder->getField('COMMENTS') === self::$oneClickToBuyCode) {
                        CEvent::Send("NEW_ONE_CLICK_BUY", $order->getSiteId(), $arMessageFields);
                    }

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


    private static function getOrderPropsByPost(object $order): array
    {
        $result = [];
        $request = Application::getInstance()->getContext()->getRequest();

        $propertyCollectionOrder = $order->getPropertyCollection();
        foreach($propertyCollectionOrder as $property) {
            $propId = $property->getField('ORDER_PROPS_ID');
            $propCode = $property->getField('CODE');

            if (!empty($_POST['ONE_CLICK_BUY'])) {
                $propValue = $request->getPost('ONE_CLICK_BUY')[$propCode] ?? $property->getValue();
            } else {
                $propValue = $request->getPost('ORDER_PROP_' . $propId) ?? $property->getValue();
            }

            $result[$property->getField('CODE')] = $propValue;
        }

        return $result;
    }
}
