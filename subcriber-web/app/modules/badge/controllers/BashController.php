<?php


namespace Subscriber\Modules\Badge\Controllers;


use Subscriber\Common\Mvc\DashboardControllerBase;
use Subscriber\Common\Shellscript\Shell;

class BashController extends DashboardControllerBase
{
    public function indexAction() {
        $shell = new Shell();
        $this->returnJSON($shell->test());
    }
}