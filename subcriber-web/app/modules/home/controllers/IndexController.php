<?php
namespace Subscriber\Modules\Home\Controllers;
use Subscriber\Common\Mvc\Controller;
class IndexController extends Controller
{
    public function initialize() {
        $this->view->setMainView(MAIN_VIEW_PATH . '/home');
        $this->view->setLayoutsDir(MAIN_VIEW_PATH . '/layouts/');
        $this->view->setLayout('dashboard_login');
        $this->view->setPartialsDir(MAIN_VIEW_PATH . '/partials/');
        $this->tag->setTitle('Coursemos Cloud Admin');
    }
    public function indexAction()
    {

    }

    public function contactAction()
    {

    }

}

