<?php

use Phalcon\Mvc\Router\Group as RouterGroup;
use Phalcon\Mvc\Router;

$router = $di->getRouter();
$module = 'dashboard';
$namespace = 'Daudau\Modules\Dashboard\Controllers';

$routes = [


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
