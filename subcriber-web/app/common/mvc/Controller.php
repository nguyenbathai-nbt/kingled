<?php

namespace Subscriber\Common\Mvc;

/**
 * @property \Phalcon\Cache\Backend\Memcache $cache
 * @property \Phalcon\Mvc\View\Simple $viewSimple
 * @property \Application\Mvc\Helper $helper
 * @property \Phalcon\Http\Cookie $cookies
 */
class Controller extends \Phalcon\Mvc\Controller {

    public function redirect($url, $code = 302) {
        switch ($code) {
            case 301:
                header('HTTP/1.1 301 Moved Permanently');
                break;
            case 302:
                header('HTTP/1.1 302 Moved Temporarily');
                break;
        }
        $this->view->disable();
        header('Location: ' . $url);
        $this->response->send();
    }

    public function returnJSON($response) {
        $this->view->disable();

        $this->response->setContentType('application/json', 'UTF-8');
        $this->response->setContent(json_encode($response));
        $this->response->send();
    }

    public function flashErrors($model) {
        foreach ($model->getMessages() as $message) {
            $this->flash->error($message);
        }
    }

    /**
     * Inherited Controller should override this function to use another view
     */
    public function initialize() {
        $this->view->setMainView(MAIN_VIEW_PATH . '/dashboard');
        $this->view->setLayoutsDir(MAIN_VIEW_PATH . '/layouts/');
        $this->view->setLayout('dashboard_loggedin');
        $this->view->setPartialsDir(MAIN_VIEW_PATH . '/partials/');
        $this->tag->prependTitle('Subscriber');
    }

}
