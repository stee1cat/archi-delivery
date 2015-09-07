<?php

/**
 * @package archi-delivery
 * @author Gennadiy Khatuntsev <e.steelcat@gmail.com>
 * @link https://github.com/stee1cat/archi-delivery
 */

namespace ArchiDelivery;

use ArchiDelivery\Delivery\ParseException;

/**
 * Class Delivery
 * @package ArchiDelivery
 */
class Delivery {

    /**
     * IP-сервера
     *
     * @var string
     */
    protected $ip;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var bool
     */
    protected $errorReporting = false;

    public function __construct() {
        $this->request = new Request();
    }

    /**
     * @param string $action
     * @param array $params
     * @return Response\Text|bool|\SimpleXMLElement
     * @throws ParseException
     */
    public function api($action = '', array $params) {
        $result = false;
        $url = ($action)? 'http://' . $this->getIp() . '/' . $action: 'http://' . $this->getIp() . '/';
        $this->request->setURL($url);
        $this->request->setGetParams($params);
        $response = $this->request->run();
        if ($this->request->isXML()) {
            libxml_use_internal_errors(true);
            $result = simplexml_load_string($response);
            if (libxml_get_errors() && $this->errorReporting) {
                $errors = libxml_get_errors();
                foreach ($errors as $error) {
                    throw new ParseException($error->message, $error->code);
                }
            }
            libxml_use_internal_errors(false);
        }
        else if ($this->request->isText()) {
            $result = new Response\Text($response);
        }
        return $result;
    }

    /**
     * @return string
     */
    public function getIp() {
        return $this->ip;
    }

    /**
     * @param string $ip
     */
    public function setIp($ip) {
        $this->ip = $ip;
    }

    /**
     * @return boolean
     */
    public function isErrorReporting() {
        return $this->errorReporting;
    }

    /**
     * @param boolean $errorReporting
     */
    public function setErrorReporting($errorReporting) {
        $this->errorReporting = $errorReporting;
    }

}