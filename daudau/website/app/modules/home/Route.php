<?php
$router = $di->getRouter();
$module = 'home';
$namespace = 'Daudau\Modules\Home\Controllers';

$routes = [
    '/' =>   [
        'controller' => 'index',
        'action' => 'index'
    ],
    '/contact' =>   [
        'controller' => 'index',
        'action' => 'contact'
    ]
];
foreach($routes as $key => $route) {
    $router->add($key, [
        'namespace' => $namespace,
        'module' => $module,
        'controller' => $route['controller'],
        'action' => $route['action']
    ]);
}