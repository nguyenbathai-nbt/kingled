<?php


namespace Publisher\Modules\Dashboard\Controllers;


use Publisher\Common\Mvc\DashboardControllerBase;
use Publisher\Common\Shellscript\Shell;

class BashController extends DashboardControllerBase
{
    public function indexAction() {
        $shell = new Shell();
        $this->returnJSON($shell->test());
    }
}