<?php

use Subscriber\Common\Mvc\Auth;
use Subscriber\Modules\Ec2\Services\InstanceServices;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Security;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager as EventsManager;
use Subscriber\Common\Plugins\SecurityPlugin;

/**
 * Registering a router
 */

$di->setShared('router', function () {
    $router = new Router(false);
    $router->removeExtraSlashes(true);
//    $modules = $this->getModules();
//    $router->setDefaultModule($modules['default_module']);

    return $router;
});

/**
 * The URL component is used to generate all kinds of URLs in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Starts the session the first time some component requests the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

$di->setShared('helper', function() {
    return new Subscriber\Common\Mvc\Helper();
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->setShared('flashSession', function () {
    $fls = new \Phalcon\Flash\Session([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
    $fls->setAutoescape(true);
    $fls->setImplicitFlush(true);
    return $fls;
});
$di->setShared('flash', function () {
    return new \Phalcon\Flash\Direct([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});
$di->setShared("security", function () {
    $security = new Security();

    // Set the password hashing factor to 12 rounds
    $security->setWorkFactor(12);
    $security->setDefaultHash(Security::CRYPT_BLOWFISH_Y);
    return $security;
});

$di->setShared("msecurity", function () {
    $security = new Security();
    $security->setWorkFactor(10);
    return $security;
});

$di->setShared("auth", function () {
    return new Auth();
});
$di->setShared("acl", function () {
    return new SecurityPlugin();
});
/**
 * Set the default namespace for dispatcher
 */
$di->setShared('dispatcher', function() {
    $dispatcher = new Dispatcher();
    $eventsManager = new EventsManager;
    $eventsManager->attach('dispatch:beforeDispatch', new SecurityPlugin);
    $dispatcher->setEventsManager($eventsManager);
    return $dispatcher;
});

$di->setShared('instance_service',function (){
    $instance_service = new InstanceServices();
    return $instance_service;
});
