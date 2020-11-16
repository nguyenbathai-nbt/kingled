<?php

namespace Daudau\Modules\Admin\Controllers;

use Daudau\Common\Mvc\Controller;

class BaseLoginController extends Controller
{
    public function initialize()
    {
        parent::initialize();

        $this->view->setMainView(MAIN_VIEW_PATH . '/admin');
        $this->view->setLayoutsDir(MAIN_VIEW_PATH . '/layouts/');
        $this->view->setLayout('admin_login');
        $this->view->setPartialsDir(MAIN_VIEW_PATH . '/partials/');
        $this->view->stylesheets = [
            "/AdminLTE-2.4.10/bower_components/jvectormap/jquery-jvectormap.css",
            "/AdminLTE-2.4.10/dist/css/skins/_all-skins.min.css",
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
            "/public/js/main.js",
            "/public/js/admin.js",
        ];
        $this->view->cssClass = "skin-green sidebar-mini";
        if (!$this->session->get('language')) {
            $this->session->set('language', 'en');
        }
    }
}
