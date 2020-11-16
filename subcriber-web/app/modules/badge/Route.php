<?php

use Phalcon\Mvc\Router\Group as RouterGroup;

$router = $di->getRouter();
$module = 'badge';
$namespace = 'Subscriber\Modules\Badge\Controllers';

$routes = [
    '/all-badge' => [
        'controller' => 'index',
        'action' => 'index'
    ],

    '/badge/info/:params' => [
        'controller' => 'index',
        'action' => 'info',
        'params' => 1
    ],
    '/badge/verify'=>[
        'controller'=>'index',
        'action'=>'verify'
    ],
    '/badge/develop'=>[
        'controller'=>'index',
        'action'=>'develop'

    ]
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
$controllerRoutes = [
    'roles',
    'users',
    'profile'
];
foreach ($controllerRoutes as $controllerRoute) {
    $routerGroup = new RouterGroup(
        [
            'module' => $module,
            'controller' => "op_$controllerRoute",
            'namespace' => $namespace
        ]
    );
    $routerGroup->setPrefix("/$controllerRoute");
    $routerGroup->add('/:action/:params', [
        'action' => 1,
        'params' => 2,
    ]);
    $routerGroup->add('/:action', [
        'action' => 1,
    ]);
    $router->mount($routerGroup);
}
$routes = [
    '/admin' => [
        'controller' => 'index',
        'action' => 'index'
    ],
    '/roles' => [
        'controller' => 'op_roles',
        'action' => 'index'
    ],
    '/users' => [
        'controller' => 'op_users',
        'action' => 'index'
    ],
    '/profile' => [
        'controller' => 'profile',
        'action' => 'index'
    ]
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
