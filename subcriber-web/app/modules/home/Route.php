<?php
$router = $di->getRouter();
$module = 'home';
$namespace = 'Subscriber\Modules\Home\Controllers';

$routes = [

];
foreach($routes as $key => $route) {
    $router->add($key, [
        'namespace' => $namespace,
        'module' => $module,
        'controller' => $route['controller'],
        'action' => $route['action']
    ]);
}