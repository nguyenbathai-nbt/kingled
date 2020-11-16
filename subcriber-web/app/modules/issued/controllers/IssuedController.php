<?php

namespace Subscriber\Modules\Issued\Controllers;

use Subscriber\Common\Mvc\DashboardControllerBase;
use Subscriber\Modules\Badge\Forms\IssuedForm;

class IssuedController extends DashboardControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->view->names = [
            [
                'label' => 'Issued',
                'href' => '/issued'
            ],
        ];
    }

    public function indexAction()
    {
        $this->view->activemenu = [
            'is',
            'issued_list'
        ];
        $this->view->issued= null;

    }



}

