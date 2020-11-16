<?php

use Phalcon\Loader;

$loader = new Loader();
$modules = $di->getModules();
/**
 * Register Namespaces
 */
$loader->registerNamespaces($modules['additional_namespaces']);

/**
 * Register module classes
 */

$loader->registerClasses($modules['register_classes']);
$loader->register();
//add composer autoloader
require_once BASE_PATH . '/vendor/autoload.php';
