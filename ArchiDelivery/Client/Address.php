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
        $this->cityName = $cityName;
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
     * @return Address
     */
    public function setHome($home) {
        $this->home = $home;
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
        $this->office = $office;
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
     * @return Address
     */
    public function setRoom($room) {
        $this->room = $room;
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
        $this->frontDoor = $frontDoor;
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
        $this->level = $level;
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
        $this->doorPhone = $doorPhone;
        return $this;
    }

}