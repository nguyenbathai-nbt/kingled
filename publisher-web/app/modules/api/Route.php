<?php

use Phalcon\Mvc\Router\Group as RouterGroup;
use Phalcon\Mvc\Router;

$router = $di->getRouter();
$module = 'api';
$namespace = 'Publisher\Modules\Api\Controllers';

$router->add('/'.$key.'/:params', [
    'namespace' => $namespace,
    'module' => $module,
    'controller' => $key,
    'action' => 'index',
    'params' => 1
])->setName($key);
$router->add('/'.$key.'/:params', [
    'namespace' => $namespace,
    'module' => $module,
    'controller' => $key,
    'action' => 'index',
    'params' => 1
]);
$router->add('/'.$key.'/:action', [
    'namespace' => $namespace,
    'module' => $module,
    'controller' => $key,
    'action' => 1
]);

$router->add('/'.$key.'/:action/:params', [
    'namespace' => $namespace,
    'module' => $module,
    'controller' => $key,
    'action' => 1,
    'params' => 2
]);