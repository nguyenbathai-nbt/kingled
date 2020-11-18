<?php
use Phalcon\Mvc\Router\Group as RouterGroup;
use Phalcon\Mvc\Router;
$router = $di->getRouter();
$key = 'api';
$namespace = 'Daudau\Modules\Api\Controllers';

$router->add('/'.$key.'/:params', [
    'namespace' => $namespace,
    'module' => $key,
    'controller' => 'index',
    'action' => 'index',
    'params' => 1
])->setName($key);
$router->add('/'.$key.'/:controller/:params', [
    'namespace' => $namespace,
    'module' => $key,
    'controller' => 1,
    'action' => 'index',
    'params' => 2
]);
$router->add('/'.$key.'/:controller/:action', [
    'namespace' => $namespace,
    'module' => $key,
    'controller' => 1,
    'action' => 2
]);
$router->add('/'.$key.'/:controller/:action/:params', [
    'namespace' => $namespace,
    'module' => $key,
    'controller' => 1,
    'action' => 2,
    'params' => 3
]);