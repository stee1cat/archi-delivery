<?php
// This is global bootstrap for autoloading

require_once __DIR__ . '/../src/ArchiDelivery/Autoloader.php';

use ArchiDelivery\Autoloader;

Autoloader::init();

\Codeception\Specify\Config::setDeepClone(false);