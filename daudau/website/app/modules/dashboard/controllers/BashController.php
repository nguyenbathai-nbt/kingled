<?php


namespace Daudau\Modules\Dashboard\Controllers;


use Daudau\Common\Mvc\DashboardControllerBase;
use Daudau\Common\Shellscript\Shell;

class BashController extends DashboardControllerBase
{
    public function indexAction() {
        $shell = new Shell();
        $this->returnJSON($shell->test());
    }
}