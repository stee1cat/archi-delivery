<?php

/**
 * @package archi-delivery
 * @author Gennadiy Khatuntsev <e.steelcat@gmail.com>
 * @link https://github.com/stee1cat/archi-delivery
 */

namespace ArchiDelivery;

use ArchiDelivery\Client\Address;

/**
 * Class Client
 * @package ArchiDelivery
 */
class Client {

    /**
     * Режим передачи клиента с указанием имени
     */
    const TYPE_NAME = 0;

    /**
     * Режим передачи клиента с указанием ID
     */
    const TYPE_ID = 1;

    /**
     * ID клиента (в режиме TYPE_ID)
     *
     * @var int
     * @since v1.0.0.8
     */
    protected $id;

    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $surname;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $fathername;

    /**
     * @var string
     */
    protected $fullname;

    /**
     * Телефон
     *
     * @var string
     */
    protected $phone;

    /**
     * Электронная почта
     *
     * @var string
     */
    protected $mail;

    /**
     * @var Address
     */
    protected $address;

    /**
     * Служба доставки
     *
     * @var Delivery
     */
    protected $delivery;

    public function __construct(Delivery $delivery, $params = array()) {
        $this->setAddress(new Address());
        $this->delivery = $delivery;
        foreach ($params as $param => $value) {
            $paramName = mb_strtolower($param, 'UTF-8');
            if (property_exists($this, $paramName)) {
                $this->{$paramName} = $value;
            }
        }
    }

    /**
     * @return Address
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * @param Address $address
     * @return Client
     */
    public function setAddress(Address $address) {
        $this->address = $address;
        return $this;
    }

    /**
     * @return int
     */
    public function getType() {
        return ($this->getId())? self::TYPE_ID: self::TYPE_NAME;
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Client
     */
    public function setId($id) {
        $this->id = intval($id);
        return $this;
    }

    /**
     * @return string
     */
    public function getLogin() {
        return $this->login;
    }

    /**
     * @param string $login
     * @return $this
     */
    public function setLogin($login) {
        $this->login = trim($login);
        return $this;
    }

    /**
     * @return string
     */
    public function getSurname() {
        return $this->surname;
    }

    /**
     * @param string $surname
     * @return Client
     */
    public function setSurname($surname) {
        $this->surname = trim($surname);
        return $this;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Client
     */
    public function setName($name) {
        $this->name = trim($name);
        return $this;
    }

    /**
     * @return string
     */
    public function getFatherName() {
        return $this->fathername;
    }

    /**
     * @param string $fatherName
     * @return Client
     */
    public function setFatherName($fatherName) {
        $this->fathername = trim($fatherName);
        return $this;
    }

    /**
     * @return string
     */
    public function getFullName() {
        return $this->fullname;
    }

    /**
     * @param string $fullName
     * @return Client
     */
    public function setFullName($fullName) {
        $this->fullname = trim($fullName);
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
        $this->phone = trim($phone);
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
     * @param string $number
     * @return Client[]
     * @throws Delivery\ParseException
     */
    public function findByPhone($number) {
        $result = array();
        $params = array(
            'phone' => $this->preparePhone($number, false),
        );
        $response = $this->delivery->api('getclientbyphone', $params);
        if ($response->isSuccess()) {
            foreach ($response->getData() as $client) {
                $result[] = new Client($this->delivery, $client);

            }
        }
        return $result;
    }

    /**
     * @return array
     */
    public function toArray() {
        $result = array(
            'type' => ($this->getType())? $this->getType(): '',
            'phone' => $this->preparePhone($this->getPhone()),
            'mail' => $this->getMail(),
        );
        if ($this->getType() == self::TYPE_ID) {
            $result['clientid'] = $this->getId();
        }
        else {
            $result['client'] = $this->getFullName();
        }
        $result = array_diff($result, array(''));
        return $result;
    }

    /**
     * @param string $number
     * @param bool $format
     * @return string
     */
    private function preparePhone($number, $format = true) {
        $number = preg_replace('/\D/iu', '', $number);
        if (strlen($number) == 11 && intval($number[0]) == 8) {
            $number[0] = 7;
        }
        if (strlen($number) == 11 && $format) {
            $number = preg_replace('/^(\d)(\d{3})(\d{3})(\d{2})(\d{2})$/iu', '$1 ($2) $3-$4-$5', $number);
        }
        return $number;
    }

}