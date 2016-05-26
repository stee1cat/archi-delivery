<?php

/**
 * @package archi-delivery
 * @author Gennadiy Khatuntsev <e.steelcat@gmail.com>
 * @link https://github.com/stee1cat/archi-delivery
 */

namespace ArchiDelivery\Response;

use ArchiDelivery\Response;

/**
 * Class Error
 * @package ArchiDelivery\Response
 */
class Error implements Response {

    private $raw;

    private $result = false;

    private $data = array();

    public function __construct($response = '') {
        $this->raw = $response;
    }

    public function isSuccess() {
        return $this->result;
    }

    public function getData() {
        return $this->data;
    }

}