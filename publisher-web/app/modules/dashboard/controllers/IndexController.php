<?php

namespace Publisher\Modules\Dashboard\Controllers;

use Publisher\Common\Models\Customer\Customers;
use Publisher\Common\Models\Customer\CustUsers;
use Publisher\Common\Mvc\DashboardControllerBase;
use Publisher\Modules\Dashboard\Forms\SearchIndex;
class IndexController extends DashboardControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->view->names = [
            [
                'label' => 'Dashboard',
                'href' => '/admin'
            ],
        ];
        $this->view->activemenu = [
            'db'

        ];
    }

    public function indexAction()
    {

      $form = new SearchIndex();
        $this->view->form= $form;

    }

}

