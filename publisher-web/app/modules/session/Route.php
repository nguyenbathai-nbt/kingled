<?php
$router = $di->getRouter();
$module = 'session';
$namespace = 'Publisher\Modules\Session\Controllers';

$routes = [
    '/' => [
        'controller' => 'index',
        'action' => 'login'
    ],
    '/login' => [
        'controller' => 'index',
        'action' => 'login'
    ],
    '/signup' => [
        'controller' => 'index',
        'action' => 'signUp'
    ],
    '/logout' => [
        'controller' => 'index',
        'action' => 'logout'
    ],
    '/forgot' => [
        'controller' => 'index',
        'action' => 'forgotPassword'
    ],
    '/reset-password/{code}/{email}' => [
        'controller' => 'index',
        'action' => 'resetPassword'
    ],
    '/change-language' => [
        'controller' => 'index',
        'action' => 'changeLanguage'
    ]


];
foreach ($routes as $key => $route) {
    $router->add($key, [
        'namespace' => $namespace,
        'module' => $module,
        'controller' => $route['controller'],
        'action' => $route['action']
    ]);
}
