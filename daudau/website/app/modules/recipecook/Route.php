<?php
$router = $di->getRouter();
$module = 'recipecook';
$namespace = 'Daudau\Modules\Recipecook\Controllers';

$routes = [
    '/cong-thuc/{slug:[a-zA-Z0-9_-]+}.html' => [
        'controller' => 'index',
        'action' => 'index'
    ],
    '/cong-thuc/chinh-sua/{slug:[a-zA-Z0-9_-]+}.html' => [
        'controller' => 'index',
        'action' => 'editRecipe'
    ],
    '/cong-thuc/tu-choi/{slug:[a-zA-Z0-9_-]+}.html' => [
        'controller' => 'index',
        'action' => 'rejectRecipe'
    ],
    '/cong-thuc/tao-cong-thuc' => [
        'controller' => 'index',
        'action' => 'create'
    ],
    '/cong-thuc/tim-kiem-cong-thuc' => [
        'controller' => 'index',
        'action' => 'ajaxSearchRecipe'
    ],
    '/cach-lam' => [
        'controller' => 'make',
        'action' => 'index'
    ],


];
foreach ($routes as $key => $route) {
    if (isset($route['params'])) {
        $router->add($key, [
            'namespace' => $namespace,
            'module' => $module,
            'controller' => $route['controller'],
            'action' => $route['action'],
            'params' => $route['params']
        ]);
    } else {
        $router->add($key, [
            'namespace' => $namespace,
            'module' => $module,
            'controller' => $route['controller'],
            'action' => $route['action']
        ]);
    }

}