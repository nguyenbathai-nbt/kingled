<?php
$router = $di->getRouter();
$module = 'account';
$namespace = 'Daudau\Modules\Account\Controllers';

$routes = [

    '/tai-khoan/cong-thuc' => [
        'controller' => 'index',
        'action' => 'recipe'
    ],
    '/tai-khoan/cong-thuc-da-xem' => [
        'controller' => 'index',
        'action' => 'recipeSeen'
    ],
    '/tai-khoan/xoa-cong-thuc/:params' => [
        'controller' => 'index',
        'action' => 'deleteRecipe',
        'params'=>1
    ],
    '/tai-khoan/cong-thuc-yeu-thich' => [
        'controller' => 'index',
        'action' => 'recipeFavourite'
    ],
    '/tai-khoan/cong-thuc-da-luu' => [
        'controller' => 'index',
        'action' => 'recipeBookmark'
    ],
    '/tai-khoan/ajaxUploadAvatar' => [
        'controller' => 'index',
        'action' => 'ajaxUploadAvatar'
    ],
    '/thanh-vien/:params' => [
        'controller' => 'index',
        'action' => 'member',
        'params' => 1
    ],
    '/thanh-vien' => [
        'controller' => 'index',
        'action' => 'searchUser'
    ],
    '/thanh-vien/:params/quan-tam' => [
        'controller' => 'index',
        'action' => 'bookmarkUser',
        'params'=>1
    ],
    '/thanh-vien/quan-tam' => [
        'controller' => 'index',
        'action' => 'ajaxBookmarkUser'
    ],
    '/tai-khoan' => [
        'controller' => 'index',
        'action' => 'info'
    ],
    '/tai-khoan/thong-tin' => [
        'controller' => 'index',
        'action' => 'info'
    ],
    '/tai-khoan/tim-kiem-thanh-vien' => [
        'controller' => 'index',
        'action' => 'searchUser'
    ],
    '/tai-khoan/doi-mat-khau' => [
        'controller' => 'index',
        'action' => 'changePassword'
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