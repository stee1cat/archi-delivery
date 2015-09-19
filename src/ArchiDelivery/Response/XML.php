<?php

/**
 * @package archi-delivery
 * @author Gennadiy Khatuntsev <e.steelcat@gmail.com>
 * @link https://github.com/stee1cat/archi-delivery
 */

namespace ArchiDelivery\Response;

use ArchiDelivery\Response;
use SimpleXMLElement;

/**
 * Class XML
 * @package ArchiDelivery\Response
 */
class XML implements Response {

    /**
     * @var SimpleXMLElement
     */
    private $raw;

    private $result = false;

    private $data = array();

    public function __construct(SimpleXMLElement $response) {
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
        // result
        if (!(($this->raw->Errors instanceof SimpleXMLElement) && $this->raw->Errors->count())) {
            $this->result = true;
        }
        // data
        if ($this->raw->Results instanceof SimpleXMLElement) {
            $this->data = $this->toArray($this->raw->Results);
        }
    }

    /**
     * @param SimpleXMLElement[]|SimpleXMLElement $xml
     * @return array
     */
    private function toArray($xml) {
        $result = array();
        foreach ($xml as $index => $node) {
            $result[$index] = (is_object($node))? $this->toArray($node): $node;
        }
        return $result;
    }

}