<?php

namespace Daudau\Common\Mvc;

use Daudau\Common\Models\Users\Users;

/**
 * @property \Phalcon\Cache\Backend\Memcache $cache
 * @property \Phalcon\Mvc\View\Simple $viewSimple
 * @property \Application\Mvc\Helper $helper
 * @property \Phalcon\Http\Cookie $cookies
 */
class Controller extends \Phalcon\Mvc\Controller
{

    public function redirect($url, $code = 302)
    {
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

    public function returnJSON($response)
    {
        $this->view->disable();

        $this->response->setContentType('application/json', 'UTF-8');
        $this->response->setContent(json_encode($response));
        $this->response->send();
    }

    public function flashErrors($model)
    {
        foreach ($model->getMessages() as $message) {
            $this->flash->error($message);
        }
    }

    /**
     * Inherited Controller should override this function to use another view
     */
    public function initialize()
    {
        $this->tag->prependTitle('Đậu đậu');
        $this->view->setMainView(MAIN_VIEW_PATH . '/home');
        $this->view->setLayoutsDir(MAIN_VIEW_PATH . '/layouts/');
        $this->view->setLayout('home');
        $this->view->setPartialsDir(MAIN_VIEW_PATH . '/partials/');
        $this->view->stylesheets = [
            "/AdminLTE-2.4.10/bower_components/jvectormap/jquery-jvectormap.css",
            "/AdminLTE-2.4.10/dist/css/skins/_all-skins.min.css",
            "/public/css/framework.min.css",
            "/public/css/core.min.css",
            "/public/css/daudau.min.css",
            "/public/css/shared.min.css",
            "/public/css/home.min.css",
            "/public/css/related.collection.min.css",
            "/public/css/admin.css",
            "/public/css/select2.css",
            "/public/bootstrap-modal/css/bootstrap-modal.css",
            "/public/bootstrap-modal/css/bootstrap-modal-bs3patch.css",
            "/public/formvalidation/dist/css/formValidation.min.css"
        ];
        $this->view->scripts = [
            '/public/js/jquery.js',
            '/public/bootstrap/js/bootstrap.min.js',
            "/AdminLTE-2.4.10/dist/js/adminlte.min.js",
            '/public/js/js.js',
            "/public/js/main.js",
            "/public/js/admin.js",
            "/public/bootstrap-modal/js/bootstrap-modal.js",
            "/public/bootstrap-modal/js/bootstrap-modalmanager.js",
            "/public/formvalidation/dist/js/formvalidation.min.js",
            "/public/formvalidation/dist/js/framework/bootstrap.min.js",
            "/AdminLTE-2.4.10/bower_components/fastclick/lib/fastclick.js",
            "/AdminLTE-2.4.10/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js",
            "/AdminLTE-2.4.10/plugins/jvectormap/jquery-jvectormap-world-mill-en.js",
            "/AdminLTE-2.4.10/bower_components/select2/dist/js/select2.full.js",
            "/public/js/bootbox.min.js",
            "/public/js/moment.js",
            "/public/js/library.js",



        ];
        $auth_site_home = $this->auth->getAuthSiteHome();
        $user = Users::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $auth_site_home['id']
            ]
        ]);
        if(!$user)
        {
            $this->view->user = null;
        }else{
            $this->view->user = $user;
        }

        $this->view->cssClass = "skin-green sidebar-mini";
        if (!$this->session->get('language')) {
            $this->session->set('language', 'en');
        }
    }

}
