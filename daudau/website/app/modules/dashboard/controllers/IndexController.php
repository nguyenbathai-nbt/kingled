<?php

namespace Daudau\Modules\Dashboard\Controllers;

use Daudau\Common\Models\Customer\Customers;
use Daudau\Common\Models\Customer\CustUsers;
use Daudau\Common\Mvc\DashboardControllerBase;
use Daudau\Modules\Dashboard\Forms\SearchIndex;
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

