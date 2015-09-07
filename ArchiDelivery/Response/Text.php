<?php

/**
 * @package archi-delivery
 * @author Gennadiy Khatuntsev <e.steelcat@gmail.com>
 * @link https://github.com/stee1cat/archi-delivery
 */

namespace ArchiDelivery\Response;

class Text {

    private $raw;

    private $result = false;

    private $data = array();

    public function __construct($response) {
        $this->raw = $response;
        $this->parse();
    }

    public function isSuccess() {
        return $this->result;
    }

    public function getData() {
        return $this->data;
    }

    private function parse() {
        $lines = explode("\n", $this->raw);
        // result
        if (isset($lines[0])) {
            $this->result = (preg_match('/^RESULT=OK\s*$/iu', $lines[0]))? true: false;
        }
        // data
        if (isset($lines[1])) {
            $data = preg_replace('/^DATA\=(.*)$/iu', '$1', $lines[1]);
            $this->data = json_decode($data, true);
        }
    }

}