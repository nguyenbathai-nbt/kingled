<?php
namespace Publisher\Modules\Home\Controllers;
use Publisher\Common\Mvc\Controller;
class IndexController extends Controller
{
    public function initialize() {
        $this->view->setMainView(MAIN_VIEW_PATH . '/home');
        $this->view->setLayoutsDir(MAIN_VIEW_PATH . '/layouts/');
        $this->view->setLayout('dashboard_loggedin');
        $this->view->setPartialsDir(MAIN_VIEW_PATH . '/partials/');
        $this->tag->setTitle('Badgechain Admin');
    }
    public function indexAction()
    {
           // return $this->redirect('/login');
    }

    public function contactAction()
    {

    }

}

