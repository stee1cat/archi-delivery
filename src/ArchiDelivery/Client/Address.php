<?php

/**
 * @package archi-delivery
 * @author Gennadiy Khatuntsev <e.steelcat@gmail.com>
 * @link https://github.com/stee1cat/archi-delivery
 */

namespace ArchiDelivery\Client;

/**
 * Class Address
 * @package ArchiDelivery\Client
 */
class Address {

    /**
     * Название города или населенного пункта
     *
     * @var string
     * @since v1.0.0.8
     */
    protected $cityName;

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
     * Офис
     *
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
     * @var string
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
    protected $doorPhone;

    /**
     * Станция метро
     *
     * @var string
     * @since v1.5.7.0
     */
    protected $metro;

    /**
     * @return string
     */
    public function getCityName() {
        return $this->cityName;
    }

    /**
     * @param string $cityName
     * @return Address
     */
    public function setCityName($cityName) {
        $this->cityName = trim($cityName);
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
     * @return Address
     */
    public function setStreet($street) {
        $this->street = trim($street);
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
     * @return Address
     */
    public function setHome($home) {
        $this->home = trim($home);
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
     * @return Address
     */
    public function setOffice($office) {
        $this->office = trim($office);
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
     * @return Address
     */
    public function setCorps($corps) {
        $this->corps = trim($corps);
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
     * @return Address
     */
    public function setRoom($room) {
        $this->room = trim($room);
        return $this;
    }

    /**
     * @return string
     */
    public function getFrontDoor() {
        return $this->frontDoor;
    }

    /**
     * @param string $frontDoor
     * @return Address
     */
    public function setFrontDoor($frontDoor) {
        $this->frontDoor = trim($frontDoor);
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
     * @return Address
     */
    public function setLevel($level) {
        $this->level = trim($level);
        return $this;
    }

    /**
     * @return string
     */
    public function getDoorPhone() {
        return $this->doorPhone;
    }

    /**
     * @param string $doorPhone
     * @return Address
     */
    public function setDoorPhone($doorPhone) {
        $this->doorPhone = trim($doorPhone);
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
     * @return Address
     */
    public function setMetro($metro) {
        $this->metro = $metro;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray() {
        $fields = array(
            'cityname' => $this->getCityName(),
            'street' => $this->getStreet(),
            'home' => $this->getHome(),
            'corps' => $this->getCorps(),
            'office' => $this->getOffice(),
            'room' => $this->getRoom(),
            'frontdoor' => $this->getFrontDoor(),
            'level' => $this->getLevel(),
            'doorphone' => $this->getDoorPhone(),
            'metro' => $this->getMetro(),
        );
        $result = array_diff($fields, array(''));
        return $result;
    }

}