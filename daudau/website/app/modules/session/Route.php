<?php
$router = $di->getRouter();
$module = 'session';
$namespace = 'Daudau\Modules\Session\Controllers';

$routes = [
    '/dang-nhap' => [
        'controller' => 'index',
        'action' => 'login'
    ],
    '/dang-ky' => [
        'controller' => 'index',
        'action' => 'signup'
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
