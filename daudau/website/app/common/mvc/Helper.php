<?php

namespace Daudau\Common\Mvc;

use Daudau\Common\Mvc\Helper\ActiveMenu;
use Daudau\Common\Mvc\Helper\Breadcrumbs;
use Daudau\Common\Mvc\Helper\Title;
use Daudau\Common\Mvc\Helper\Util;
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

    public function timePost($time_post)
    {
        $date_now = date('Y-m-d G:i:s');
        $timeStampNow = strtotime($date_now);
        $timeStampPost = strtotime($time_post);
        $count = $timeStampNow - $timeStampPost;
        if ($count < 60) {
            return $count . " giây trước";
        } else if ($count > 60 && $count < 3600) {
            $minute = $count / 60 - ($count % 60) / 60;
            return $minute . " phút trước";
        } else if ($count > 3600 && $count < 86400) {
            $hour = $count / 3600 - ($count % 3600) / 3600;
            return $hour . " giờ trước";
        } else if ($count > 86400 && $count < 2592000) {
            $day = $count / 86400 - ($count % 86400) / 86400;
            return $day . " ngày trước";
        } else if ($count > 2592000 && $count < 31104000) {
            $month = $count / 2592000 - ($count % 2592000) / 2592000;
            return $month . " tháng trước";
        }
    }

    function resize_image($file, $w, $h, $type_image, $crop = FALSE)
    {
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width - ($width * abs($r - $w / $h)));
            } else {
                $height = ceil($height - ($height * abs($r - $w / $h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w / $h > $r) {
                $newwidth = $h * $r;
                $newheight = $h;
            } else {
                $newheight = $w / $r;
                $newwidth = $w;
            }
        }
        if ($type_image == "image/png") {
            $src = imagecreatefrompng($file);
        } else if ($type_image == "image/jpeg") {
            $src = imagecreatefromjpeg($file);
        }
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

        return $dst;
    }


}
