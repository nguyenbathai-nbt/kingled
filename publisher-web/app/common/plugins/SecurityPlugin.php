<?php

namespace Publisher\Common\Plugins;

use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Plugin;

class SecurityPlugin extends Plugin
{
    private $unsecured_modules = ['home', 'session'];

    public function beforeDispatch(Event $event, Dispatcher $dispatcher)
    {
        $logged = $this->auth->isLoggedIn();
        if (!$logged && !$this->isUnsecureRoute($dispatcher)) {
            $this->response->redirect('/login');
            return false;
        }
    }

    public function isUnsecureRoute(Dispatcher $dispatcher)
    {
        $module = $dispatcher->getModuleName();

        if (!in_array($module, $this->unsecured_modules)) {
            $controller = $dispatcher->getControllerName();
            $action = $dispatcher->getActionName();
            if ($module == 'api') {
                return true;
            }
            return false;
        }
        return true;
    }
}