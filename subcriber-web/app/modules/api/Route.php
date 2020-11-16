<?php

use Phalcon\Mvc\Router\Group as RouterGroup;
use Phalcon\Mvc\Router;

$router = $di->getRouter();
$module = 'api';
$namespace = 'Subscriber\Modules\Api\Controllers';

$router->add('/'.$key.'/:params', [
    'namespace' => $namespace,
    'module' => $key,
    'controller' => $key,
    'action' => 'index',
    'params' => 1
])->setName($key);
$router->add('/'.$key.'/:controller/:params', [
    'namespace' => $namespace,
    'module' => $key,
    'controller' => 'badge',
    'action' => 'index',
    'params' => 2
]);
$router->add('/'.$key.'/:controller/:action', [
    'namespace' => $namespace,
    'module' => $key,
    'controller' => 1,
    'action' => 2
]);
$router->add('/'.$key.'/:action', [
    'namespace' => $namespace,
    'module' => $key,
    'controller' => $key,
    'action' => 1
]);
$router->add('/'.$key.'/:controller/:action/:params', [
    'namespace' => $namespace,
    'module' => $key,
    'controller' => 1,
    'action' => 2,
    'params' => 3
]);