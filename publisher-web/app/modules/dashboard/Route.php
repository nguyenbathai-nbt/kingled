<?php

use Phalcon\Mvc\Router\Group as RouterGroup;
use Phalcon\Mvc\Router;

$router = $di->getRouter();
$module = 'dashboard';
$namespace = 'Publisher\Modules\Dashboard\Controllers';

$routes = [
    '/admin' => [
        'controller' => 'index',
        'action' => 'index'
    ],
    '/bash' => [
        'controller' => 'bash',
        'action' => 'index'
    ],
];
foreach ($routes as $key => $route) {
    $iroute = [
        'namespace' => $namespace,
        'module' => $module,
        'controller' => $route['controller'],
        'action' => $route['action']
    ];
    if (isset($route['params'])) $iroute['params'] = $route['params'];
    $router->add($key, $iroute);
}

