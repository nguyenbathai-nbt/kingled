<?php

namespace Subscriber\Common\Mvc;

use Subscriber\Common\Mvc\Helper\ActiveMenu;
use Subscriber\Common\Mvc\Helper\Breadcrumbs;
use Subscriber\Common\Mvc\Helper\Title;
use Subscriber\Common\Mvc\Helper\Util;
use Phalcon\Di;
use Phalcon\Mvc\User\Component;

class Helper extends Component
{

    protected $admin_translate = null;

    public function __construct()
    {
        if (!$this->session->get('language')) {
            $lanuage = 'en';
            $this->session->set('language', 'en');
        } else {
            $lanuage = $this->session->get('language');
        }
        $file = BASE_PATH . '/data/translations/admin/' . $lanuage . '.php';
        if (!is_file($file)) {
            die("file $file not exists");
        }
        $translations = include($file);
        $this->getDI()->set('admin_translate', new \Phalcon\Translate\Adapter\NativeArray(array('content' => $translations)));
    }

    public function title($title = null, $h1 = false)
    {
        return Title::getInstance($title, $h1);
    }

//    public function at($string, $placeholders = null)
//    {
//        $di = Di::getDefault();
//        $connection = $di->getShared('admin_translate');
//        $this->admin_translate = $connection;
//        return $this->admin_translate->query($string, $placeholders);
//    }

    public function activeMenu()
    {
        return ActiveMenu::getInstance();
    }

    public function bc($caption = null, $link = null)
    {
        return Breadcrumbs::getInstance($caption, $link);
    }

    public function util()
    {
        return Util::getInstance();
    }

    public function translate($string, $placeholders = null)
    {

        if (!$this->admin_translate) {
            $this->admin_translate = $this->getDi()->getShared('admin_translate');
        }
        return $this->admin_translate->query($string, $placeholders);
    }


}
