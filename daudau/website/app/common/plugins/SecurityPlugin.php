<?php

namespace Daudau\Common\Plugins;

use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Plugin;

class SecurityPlugin extends Plugin
{
    private $unsecured_modules = ['session'];

    public function beforeDispatch(Event $event, Dispatcher $dispatcher)
    {
        $module = $dispatcher->getModuleName();
        $action = $dispatcher->getActionName();
        if ($module == 'admin' || $module == 'api') {
            $logged = $this->auth->isLoggedIn();

            if (!$logged && !$this->isUnsecureRoute($dispatcher)) {
                $this->response->redirect('/admin/dang-nhap');
                return false;
            }
        } else {
            $logged = $this->auth->isLoggedInSiteHome();
            if ($_SERVER['REQUEST_URI'] != "/dang-nhap") {
                $this->session->set('previous-url', $_SERVER['REQUEST_URI']);
            }
            if (!$logged && !$this->isUnsecureRouteSiteHome($dispatcher)) {
                $this->response->redirect('/dang-nhap');
                return false;
            }
        }
    }

    public function isUnsecureRoute(Dispatcher $dispatcher)
    {
        $module = $dispatcher->getModuleName();

        if (!in_array($module, $this->unsecured_modules)) {
            $controller = $dispatcher->getControllerName();
            $action = $dispatcher->getActionName();
            if ($module == 'api' || $module == 'admin' && ($action == 'login' || $action == "signup") || $module == 'recipecook' || ($module == 'admin' && $controller == 'bookmark' && $action == 'ajaxBookmark') || ($module == 'admin' && $controller == 'bookmark' && $action == 'ajaxFavourite') || ($module == 'admin' && $controller == 'comment' && $action == 'postAjaxComment')) {
                return true;
            }
            return false;
        }
        return true;
    }

    public function isUnsecureRouteSiteHome(Dispatcher $dispatcher)
    {
        $module = $dispatcher->getModuleName();

        if (!in_array($module, $this->unsecured_modules)) {
            $controller = $dispatcher->getControllerName();
            $action = $dispatcher->getActionName();
            if ($module == 'session' && ($action == 'login' || $action == "signup") || $module == "home" || ($module == "recipecook" && $action == "index") || ($module=="recipecook" && $controller=="index" && $action=="ajaxSearchRecipe")) {
                return true;
            }
            return false;
        }
        return true;
    }
}