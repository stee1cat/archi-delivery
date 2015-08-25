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
     * Режим передачи клиента с указанием имени
     */
    const TYPE_NAME = 0;

    /**
     * Режим передачи клиента с указанием ID
     */
    const TYPE_ID = 1;

    /**
     * Формат отправляемого заказа
     */
    const ORDER_JSON = 1;

    /**
     * Режим передачи клиента
     *
     * @var int
     * @since v1.0.0.8
     */
    protected $type;

    /**
     * ФИО клиента
     *
     * @var string
     */
    protected $client;

    /**
     * ID клиента (в режиме TYPE_ID)
     *
     * @var int
     * @since v1.0.0.8
     */
    protected $clientId;

    /**
     * Название города или населенного пункта
     *
     * @var string
     * @since v1.0.0.8
     */
    protected $cityName;

    /**
     * Телефон
     *
     * @var string
     */
    protected $phone;

    /**
     * Улица
     *
     * @var string
     */
    protected $street;

    /**
     * Дом
     *
     * @var string
     */
    protected $home;

    /**
     * @var string
     */
    protected $office;

    /**
     * Корпус
     *
     * @var string
     */
    protected $corps;

    /**
     * Квартира
     *
     * @var string
     */
    protected $room;

    /**
     * Подъезд
     *
     * @var int
     */
    protected $frontDoor;

    /**
     * Этаж
     *
     * @var int
     */
    protected $level;

    /**
     * Код домофона
     *
     * @var string
     */
    protected $doorPhone = false;

    /**
     * Количество персон
     *
     * @var int
     */
    protected $flatwareCount;

    /**
     * Электронная почта
     *
     * @var string
     */
    protected $mail;

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
     * Тип заказа
     *
     * @var
     * @since v1.0.0.4
     */
    protected $orderType;

    /**
     * Станция метро
     *
     * @var string
     * @since v1.5.7.0
     */
    protected $metro;

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
     * Параметры доступные к отправке
     *
     * @var array
     */
    protected $params = array(
        'type',
        'client',
        'clientId',
        'cityName',
        'phone',
        'street',
        'home',
        'corps',
        'room',
        'frontDoor',
        'level',
        'doorPhone',
        'flatwareCount',
        'mail',
        'comment',
        'database',
        'time',
        'timeEnd',
        'isPayment',
        'paymentType',
        'order',
        'orderType',
        'metro',
        'changeFrom',
        'orderFormatType',
    );

    /**
     * @return int
     */
    public function getClientType() {
        return $this->type;
    }

    /**
     * @param int $type
     * @return Order
     */
    public function setClientType($type) {
        $this->type = intval($type);
        return $this;
    }

    /**
     * @return string
     */
    public function getClient() {
        return $this->client;
    }

    /**
     * @param string $client
     * @return Order
     */
    public function setClient($client) {
        $this->client = $client;
        return $this;
    }

    /**
     * @return int
     */
    public function getClientId() {
        return $this->clientId;
    }

    /**
     * @param int $clientId
     * @return Order
     */
    public function setClientId($clientId) {
        $this->clientId = intval($clientId);
        return $this;
    }

    /**
     * @return string
     */
    public function getCityName() {
        return $this->cityName;
    }

    /**
     * @param string $cityName
     * @return Order
     */
    public function setCityName($cityName) {
        $this->cityName = $cityName;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return Order
     */
    public function setPhone($phone) {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreet() {
        return $this->street;
    }

    /**
     * @param string $street
     * @return Order
     */
    public function setStreet($street) {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string
     */
    public function getHome() {
        return $this->home;
    }

    /**
     * @param string $home
     * @return Order
     */
    public function setHome($home) {
        $this->home = $home;
        return $this;
    }

    /**
     * @return string
     */
    public function getCorps() {
        return $this->corps;
    }

    /**
     * @param string $corps
     * @return Order
     */
    public function setCorps($corps) {
        $this->corps = $corps;
        return $this;
    }

    /**
     * @return string
     */
    public function getRoom() {
        return $this->room;
    }

    /**
     * @param string $room
     * @return Order
     */
    public function setRoom($room) {
        $this->room = $room;
        return $this;
    }

    /**
     * @return string
     */
    public function getOffice() {
        return $this->office;
    }

    /**
     * @param string $office
     * @return Order
     */
    public function setOffice($office) {
        $this->office = $office;
        return $this;
    }

    /**
     * @return int
     */
    public function getFrontDoor() {
        return $this->frontDoor;
    }

    /**
     * @param int $frontDoor
     * @return Order
     */
    public function setFrontDoor($frontDoor) {
        $this->frontDoor = intval($frontDoor);
        return $this;
    }

    /**
     * @return int
     */
    public function getLevel() {
        return $this->level;
    }

    /**
     * @param int $level
     * @return Order
     */
    public function setLevel($level) {
        $this->level = intval($level);
        return $this;
    }

    /**
     * @return boolean
     */
    public function isDoorPhone() {
        return $this->doorPhone;
    }

    /**
     * @param boolean $doorPhone
     * @return Order
     */
    public function setDoorPhone($doorPhone) {
        $this->doorPhone = !!$doorPhone;
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
    public function getMail() {
        return $this->mail;
    }

    /**
     * @param string $mail
     * @return Order
     */
    public function setMail($mail) {
        $this->mail = $mail;
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
    public function getMetro() {
        return $this->metro;
    }

    /**
     * @param string $metro
     * @return Order
     */
    public function setMetro($metro) {
        $this->metro = $metro;
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
     * @return Delivery
     */
    public function getDelivery() {
        return $this->delivery;
    }

    /**
     * @param Delivery $delivery
     * @return Order
     */
    public function setDelivery($delivery) {
        $this->delivery = $delivery;
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

    public function send() {
        $result = false;
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
                default:
            }
            if ($value !== null) {
                $params[strtolower($paramName)] = iconv('UTF-8', 'CP1251', $value);
            }
        }
        $response = $this->delivery->api('neworder', $params);
        if ($response instanceof \SimpleXMLElement && $response->Errors instanceof \SimpleXMLElement) {
            $result = !$response->Errors->count();
        }
        return $result;
    }

}