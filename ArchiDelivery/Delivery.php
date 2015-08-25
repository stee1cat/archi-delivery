<?php

/**
 * @package archi-delivery
 * @author Gennadiy Khatuntsev <e.steelcat@gmail.com>
 * @link https://github.com/stee1cat/archi-delivery
 */

namespace ArchiDelivery;

use ArchiDelivery\Delivery\ParseException;

class Delivery {

    /**
     * IP-сервера
     *
     * @var string
     */
    protected $ip;

    /**
     * @var Loader
     */
    protected $loader;

    /**
     * @var bool
     */
    protected $errorReporting = false;

    public function __construct() {
        $this->loader = new Loader();
    }

    public function api($action = '', array $params) {
        $result = false;
        $url = ($action)? 'http://' . $this->getIp() . '/' . $action: 'http://' . $this->getIp() . '/';
        $this->loader->setURL($url);
        $this->loader->setGetParams($params);
        $response = $this->loader->get();
        if ($this->loader->isXML()) {
            libxml_use_internal_errors(true);
            $result = simplexml_load_string($response);
            if (libxml_get_errors() && $this->isErrorReporting()) {
                $errors = libxml_get_errors();
                foreach ($errors as $error) {
                    throw new ParseException($error->message, $error->code);
                }
            }
            libxml_use_internal_errors(false);
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