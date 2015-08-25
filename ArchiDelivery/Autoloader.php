<?php

/**
 * @package archi-delivery
 * @author Gennadiy Khatuntsev <e.steelcat@gmail.com>
 * @link https://github.com/stee1cat/archi-delivery
 */

namespace ArchiDelivery;

class Autoloader {

    public static $loader;

    public static function init() {
        if (self::$loader == null) {
            self::$loader = new self();
        }
        return self::$loader;
    }

    public function __construct() {
        spl_autoload_register(array($this, 'load'));
    }

    public function load($class) {
        $prefix = 'ArchiDelivery\\';
        $baseDir = __DIR__ . DIRECTORY_SEPARATOR;
        $length = strlen($prefix);
        if (strncmp($prefix, $class, $length) !== 0) {
            return;
        }
        $relativeClass = substr($class, $length);
        $file = $baseDir . str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }

}