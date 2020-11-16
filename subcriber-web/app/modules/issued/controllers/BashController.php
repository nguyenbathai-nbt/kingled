<?php


namespace Subscriber\Modules\Dashboard\Controllers;


use Subscriber\Common\Mvc\DashboardControllerBase;
use Subscriber\Common\Shellscript\Shell;

class BashController extends DashboardControllerBase
{
    public function indexAction() {
        $shell = new Shell();
        $this->returnJSON($shell->test());
    }
}