<?php
/**
 * Module declaration block
 */
$modules_web = [
    'home',
    'dashboard',
    'session',
    'cli',
    'user',
    'bill',
    'api',
    'product',
    'producer'
];
$default_module = 'session';

$additional_namespaces = [
    'Publisher\Common\Models' => APP_PATH . '/common/models/',
    'Publisher\Common\Models\Users' => APP_PATH . '/common/models/users',
    'Publisher\Common\Models\Bill' => APP_PATH . '/common/models/bill',
    'Publisher\Common\Mvc' => APP_PATH . '/common/mvc/',
    'Publisher\Common\Mvc\Form' => APP_PATH . '/common/mvc/form/',
    'Publisher\Common\Mvc\Helper' => APP_PATH . '/common/mvc/helper/',
    'Publisher\Common\Plugins' => APP_PATH . '/common/plugins/'
];
/**
 * Module util functions
 */
$module_web_def = [
];
$module_cli_def = [
    'cli' => ['className' => 'Publisher\Modules\Cli\Module']
];
$register_classes = [
    'Publisher\Modules\Cli\Module' => APP_PATH . '/modules/cli/Module.php'
];
$namespace_base = "Publisher\Modules\\";
//$default_namespace = `Publisher\Modules\Frontend\Controllers`;
$default_namespace = $namespace_base . ucfirst($default_module) . "\Controllers";
foreach ($modules_web as $module_web) {
    $module_classname = $namespace_base . ucfirst($module_web) . "\Module";
    $module_web_def[$module_web] = ['className' => $module_classname];
    $register_classes[$module_classname] = APP_PATH . '/modules/' . $module_web . '/Module.php';
}
return [
    "modules_web" => $module_web_def,
    "modules_cli" => $module_cli_def,
    "register_classes" => $register_classes,
    "default_module" => $default_module,
    "default_namespace" => $default_namespace,
    "additional_namespaces" => $additional_namespaces
];