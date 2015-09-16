<?php

/**
 * @package archi-delivery
 * @author Gennadiy Khatuntsev <e.steelcat@gmail.com>
 * @link https://github.com/stee1cat/archi-delivery
 */

namespace ArchiDelivery;

/**
 * Interface Response
 * @package ArchiDelivery
 */
interface Response {

    public function isSuccess();
    public function getData();

}