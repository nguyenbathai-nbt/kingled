<?php

$router = $di->getRouter();
foreach ($application->getModules() as $key => $module) {
    $moduleRoute = APP_PATH . "/modules/$key/Route.php";
    if (file_exists($moduleRoute)) {
        require $moduleRoute;
    }
//    $namespace = preg_replace('/Module$/', 'Controllers', $module["className"]);
//    $router->add('/'.$key.'/:params', [
//        'namespace' => $namespace,
//        'module' => $key,
//        'controller' => 'index',
//        'action' => 'index',
//        'params' => 1
//    ])->setName($key);
//    $router->add('/'.$key.'/:controller/:params', [
//        'namespace' => $namespace,
//        'module' => $key,
//        'controller' => 1,
//        'action' => 'index',
//        'params' => 2
//    ]);
//    $router->add('/'.$key.'/:controller/:action', [
//        'namespace' => $namespace,
//        'module' => $key,
//        'controller' => 1,
//        'action' => 2
//    ]);
//    $router->add('/'.$key.'/:controller/:action/:params', [
//        'namespace' => $namespace,
//        'module' => $key,
//        'controller' => 1,
//        'action' => 2,
//        'params' => 3
//    ]);
}
