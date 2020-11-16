<?php
namespace Daudau\Modules\Admin\Controllers;
use Daudau\Common\Models\Users\Users;
use Daudau\Modules\Admin\Forms\LoginForm;
use Daudau\Modules\Admin\Forms\SignUpForm;

class HomeController extends BaseDashboardController
{
    public function initialize() {
        parent::initialize();
    }
    public function indexAction()
    {
        $this->view->activemenu = [
        ];
        $this->view->names = [
            [
                'label' => 'Trang chủ',
                'href' => '/admin'
            ],
        ];
    }

}

