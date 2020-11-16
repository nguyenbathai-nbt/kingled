<?php
$router = $di->getRouter();
$module = 'admin';
$namespace = 'Daudau\Modules\Admin\Controllers';

$router->add('/'.$key.'/:controller', [
    'namespace' => $namespace,
    'module' => $key,
    'controller' => 'index',
    'action' => 1
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
$router->add('/'.$key.'/dang-nhap', [
    'namespace' => $namespace,
    'module' => $key,
    'controller' => 'login',
    'action' => 'login'
]);
$router->add('/'.$key.'/dang-xuat', [
    'namespace' => $namespace,
    'module' => $key,
    'controller' => 'login',
    'action' => 'logout'
]);
$router->add('/'.$key.'/dang-ky', [
    'namespace' => $namespace,
    'module' => $key,
    'controller' => 'login',
    'action' => 'signup'
]);
$router->add('/'.$key, [
    'namespace' => $namespace,
    'module' => $key,
    'controller' => 'home',
    'action' => 'index'
]);
