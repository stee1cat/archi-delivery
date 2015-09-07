<?php

/**
 * @package archi-delivery
 * @author Gennadiy Khatuntsev <e.steelcat@gmail.com>
 * @link https://github.com/stee1cat/archi-delivery
 */

namespace ArchiDelivery;

/**
 * Class Client
 * @package ArchiDelivery
 */
class Client {

    /**
     * @var int
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
     * Служба доставки
     *
     * @var Delivery
     */
    protected $delivery;

    public function __construct($params = array()) {
        foreach ($params as $param => $value) {
            $paramName = mb_strtolower($param, 'UTF-8');
            if (property_exists($this, $paramName)) {
                $this->{$paramName} = $value;
            }
        }
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @return $this
     */
    public function setLogin($login) {
        $this->login = $login;
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
        $this->surname = $surname;
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
        $this->name = $name;
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
        $this->fathername = $fatherName;
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
        $this->fullname = $fullName;
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
     * @param string $number
     * @return Client[]
     * @throws Delivery\ParseException
     */
    public function findByPhone($number) {
        $result = array();
        $params = array(
            'phone' => $this->preparePhone($number),
        );
        $response = $this->delivery->api('getclientbyphone', $params);
        if ($response->isSuccess()) {
            foreach ($response->getData() as $client) {
                $result[] = new Client($client);

            }
        }
        return $result;
    }

    private function preparePhone($number) {
        $number = preg_replace('/\D/iu', '', $number);
        if (strlen($number) == 11 && intval($number[0]) == 8) {
            $number[0] = 7;
        }
        return $number;
    }

}