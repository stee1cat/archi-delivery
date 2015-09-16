<?php

/**
 * @package archi-delivery
 * @author Gennadiy Khatuntsev <e.steelcat@gmail.com>
 * @link https://github.com/stee1cat/archi-delivery
 */

namespace ArchiDelivery;

use ArchiDelivery\Order\Item;

/**
 * Class Order
 * @package ArchiDelivery
 */
class Order {

    /**
     * Формат отправляемого заказа
     */
    const ORDER_JSON = 1;

    /**
     * Количество персон
     *
     * @var int
     */
    protected $flatwareCount;

    /**
     * Комментарий (max length 200)
     *
     * @var string
     */
    protected $comment;

    /**
     * Путь к БД (если необходима запись в конкретную БД)
     *
     * @var string
     */
    protected $database;

    /**
     * Строка с временем, в которое заказ должен быть доставлен (формат: 2013-04-22 12:04:17)
     *
     * @var string
     */
    protected $time;

    /**
     * Верхний диапазон времени, в которое заказ должен быть доставлен (формат: 2013-04-22 12:04:17)
     *
     * @var string
     * @since v1.0.0.7
     */
    protected $timeEnd;

    /**
     * Оплачен ли заказ
     *
     * @var bool
     * @since v1.0.0.2
     */
    protected $isPayment;

    /**
     * Тип оплаты
     *
     * @var int
     * @since v1.0.0.2
     */
    protected $paymentType;

    /**
     * Содержимое заказа (<ID>#<quantity>[,<ID>#<quantity>])
     *
     * @var string
     */
    protected $order;

    /**
     * Тип заказа (для самовывоза возможно понадобится значение -1, с указанием имени и телефона клиента)
     *
     * @var
     * @since v1.0.0.4
     */
    protected $orderType;

    /**
     * Сдача с
     *
     * @var string
     * @since v1.5.7.0
     */
    protected $changeFrom;

    /**
     * @var int
     * @since v1.5.8.0
     */
    protected $orderFormatType;

    /**
     * Служба доставки
     *
     * @var Delivery
     */
    protected $delivery;

    /**
     * Содержимое заказа
     *
     * @var Item[]
     */
    protected $items = array();

    /**
     * Клиент
     *
     * @var Client
     */
    protected $client;

    /**
     * @var Client\Address
     */
    protected $address;

    /**
     * Параметры доступные к отправке
     *
     * @var array
     */
    protected $params = array(
        'flatwareCount',
        'comment',
        'database',
        'time',
        'timeEnd',
        'isPayment',
        'paymentType',
        'order',
        'orderType',
        'changeFrom',
        'orderFormatType',
    );

    /**
     * @param Delivery $delivery
     */
    public function __construct(Delivery $delivery) {
        $this->delivery = $delivery;
    }

    /**
     * @return Client
     */
    public function getClient() {
        return $this->client;
    }

    /**
     * @param Client $client
     * @return Order
     */
    public function setClient(Client $client) {
        $this->client = $client;
        return $this;
    }

    /**
     * @return int
     */
    public function getFlatwareCount() {
        return $this->flatwareCount;
    }

    /**
     * @param int $flatwareCount
     * @return Order
     */
    public function setFlatwareCount($flatwareCount) {
        $this->flatwareCount = intval($flatwareCount);
        return $this;
    }

    /**
     * @return string
     */
    public function getComment() {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return Order
     */
    public function setComment($comment) {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return string
     */
    public function getDatabase() {
        return $this->database;
    }

    /**
     * @param string $database
     * @return Order
     */
    public function setDatabase($database) {
        $this->database = $database;
        return $this;
    }

    /**
     * @return string
     */
    public function getTime() {
        return $this->time;
    }

    /**
     * @param string $time
     * @return Order
     */
    public function setTime($time) {
        $this->time = $time;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimeEnd() {
        return $this->timeEnd;
    }

    /**
     * @param string $timeEnd
     * @return Order
     */
    public function setTimeEnd($timeEnd) {
        $this->timeEnd = $timeEnd;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isPayment() {
        return $this->isPayment;
    }

    /**
     * @param boolean $isPayment
     * @return Order
     */
    public function setPayment($isPayment) {
        $this->isPayment = boolval($isPayment);
        return $this;
    }

    /**
     * @return int
     */
    public function getPaymentType() {
        return $this->paymentType;
    }

    /**
     * @param int $paymentType
     * @return Order
     */
    public function setPaymentType($paymentType) {
        $this->paymentType = intval($paymentType);
        return $this;
    }

    /**
     * @return string
     */
    public function getOrder() {
        return $this->order;
    }

    /**
     * @param string $order
     * @return Order
     */
    public function setOrder($order) {
        $this->order = $order;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderType() {
        return $this->orderType;
    }

    /**
     * @param mixed $orderType
     * @return Order
     */
    public function setOrderType($orderType) {
        $this->orderType = $orderType;
        return $this;
    }

    /**
     * @return string
     */
    public function getChangeFrom() {
        return $this->changeFrom;
    }

    /**
     * @param string $changeFrom
     * @return Order
     */
    public function setChangeFrom($changeFrom) {
        $this->changeFrom = $changeFrom;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrderFormatType() {
        return $this->orderFormatType;
    }

    /**
     * @param int $orderFormatType
     * @return Order
     */
    public function setOrderFormatType($orderFormatType) {
        $this->orderFormatType = intval($orderFormatType);
        return $this;
    }

    /**
     * @param Item $item
     * @return Order
     */
    public function addItem(Item $item) {
        $this->items[] = $item;
        return $this;
    }

    /**
     * @return Order\Item[]
     */
    public function getItems() {
        return $this->items;
    }

    /**
     * @param Order\Item[] $items
     * @return Order
     */
    public function setItems($items) {
        $this->items = $items;
        return $this;
    }

    /**
     * Возвращает количество товаров в заказе
     *
     * @return int
     */
    public function getItemsCount() {
        return count($this->items);
    }

    /**
     * @return Client\Address
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * @param Client\Address $address
     * @return Order
     */
    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    /**
     * @return bool
     * @throws Delivery\ParseException
     */
    public function send() {
        $params = array();
        foreach ($this->params as $paramName) {
            $value = $this->{$paramName};
            switch ($paramName) {
                case 'order':
                    $items = array();
                    foreach ($this->items as $item) {
                        $items[] = ($this->orderFormatType == self::ORDER_JSON)? $item->toArray(): $item->toString();
                    }
                    $value = ($this->orderFormatType == self::ORDER_JSON)? json_encode($items): implode(',', $items);
                    break;
                case 'type':
                    if ($value == 0) {
                        continue 2;
                    }
                    break;
                default:
            }
            if ($value !== null) {
                $params[strtolower($paramName)] = $value;
            }
        }
        $address = $this->getAddress();
        if ($address) {
            $params = array_merge($params, $address->toArray());
        }
        $client = $this->getClient();
        if ($client) {
            $params = array_merge($params, $client->toArray());
        }
        $response = $this->delivery->api('neworder', $params);
        return $response->isSuccess();
    }

}