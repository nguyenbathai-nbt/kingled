<?php

/**
 * Meta
 */

namespace Daudau\Common\Mvc\Helper;

use Phalcon\Tag;
use stdClass;

class Util extends \Phalcon\Mvc\User\Component
{

    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Util();
        }
        return self::$instance;
    }

    public function displayMenu()
    {
        $link = APP_PATH . '/app/config/menu.php';
        $menus = include APP_PATH . '/config/menu.php';
        $html = "";
        foreach ($menus as $key => $menu) {
            $htmlParent = '';
            $parentActive = $this->helper->activeMenu()->activeClass($key);
            if ($menu['items'] == null) {
                $htmlParent .= '<li class=" ' . $parentActive . '" >';
            } else {
                $htmlParent .= '<li class="treeview ' . $parentActive . '" >';
            }

            $htmlParent .= '<a href="' . $menu['url'] . '">';
            $htmlParent .= '<i class=" ' . $menu['icon'] . '"></i> <span>' . $menu['text'] . '</span>';
            if ($this->helper->activeMenu()->isActive($key) == 'active') {
                $htmlParent .= '<i class="fa fa-angle-right pull-right"></i>';
            } else {
                $htmlParent .= '<i class="fa fa-angle-left pull-right"></i>';
            }
            $htmlParent .= '<ul class="treeview-menu">';
            $htmlChild = '';
            if ($menu['items'] != null) {
                foreach ($menu['items'] as $item => $value) {
                    $childActive = $this->helper->activeMenu()->activeClass($item);
                    $htmlChild .= '<li class="' . $childActive . '">';
                    $htmlChild .= '<a href="/' . $value['url'] . '"><i class="fa fa-angle-double-right"></i>' . $value['text'] . '</a>';
                    $htmlChild .= '</li>';
                }
            }

            $htmlParent .= $htmlChild;
            $htmlParent .= '</ul>';
            $htmlParent .= '</li>';
            // if ($htmlChild != '') {
            $html .= $htmlParent;
            // }
        }
        return $html;
    }

    public function paging($data_count, $path, $pageSize, $currentpage)
    {
        $currentPage = $currentpage;
        $totalPage = 0;
        $totalItem = $data_count;
        $pageSize = $pageSize;
        $url = $path['_url'] . "?";
        if (isset($path["page"])) {
            unset($path['page']);
        }
        unset($path['_url']);
        if ($path != null) {
            $url .= http_build_query($path) . '&';
        }
        if ($totalItem % $pageSize == 0) {
            $totalPage = (int)($totalItem / $pageSize);
        } else {
            $totalPage = (int)($totalItem / $pageSize + 1);
        }
//        if ($totalPage == 1) {
//            return '';
//        }
        $paging = '<ul class="pagination" style="margin: 0px;">';
        if ($currentPage >= 1) {
            $paging .= '<li>' . Tag::linkTo(array( $url . 'page=1', '<i class="fa fa-angle-double-left"></i>', 'class' => $this->getAjaxClick())) . '</li>';
            $paging .= '<li>' . Tag::linkTo(array($url . 'page=' . ($currentPage == 1 ? $currentPage : $currentPage - 1), '<i class="fa fa-angle-left"></i>', 'class' => $this->getAjaxClick())) . '</li>';
        }
        if ($totalPage <= 8) {
            $paging .= $this->getPage(1, $totalPage, $currentPage, $url);
        } else {
            if ($currentPage <= 3) {
                $paging .= $this->getPage(1, $currentPage + 1, $currentPage, $url);
                $paging .= '<li><span>...</span></li>' . $this->getPage($totalPage - 2, $totalPage, $currentPage, $url);
            } else if ($currentPage > 3 && $currentPage + 3 < $totalPage) {
                $paging .= $this->getPage($currentPage - 4, $currentPage + 3, $currentPage, $url);
            } else if ($currentPage >= $totalPage - 8 && $currentPage < $totalPage) {
                $paging .= $this->getPage(1, 3, $currentPage, $url);
                $paging .= '<li><span>...</span></li>' . $this->getPage($currentPage - 2, $totalPage, $currentPage, $url);
            } else if ($currentPage == $totalPage) {
                $paging .= $this->getPage(1, 3, $currentPage, $url);
                $paging .= '<li><span>...</span></li>' . $this->getPage($totalPage - 2, $totalPage, $currentPage, $url);
            }
        }
        if ($currentPage <= $totalPage) {
            $paging .= '<li>' . Tag::linkTo(array( $url . 'page=' . ($currentPage == $totalPage ? $currentPage : $currentPage + 1), '<i class="fa fa-angle-right"></i>', 'class' => $this->getAjaxClick())) . '</li>';
            $paging .= '<li>' . Tag::linkTo(array( $url . 'page=' . $totalPage, '<i class="fa fa-angle-double-right"></i>', 'class' => $this->getAjaxClick())) . '</li>';
        }
        $paging .= "</ul>";
        return $paging;
    }

    public function getPage($start, $end, $cur, $url)
    {
        $paging = "";
        for ($i = $start; $i <= $end; $i++) {
            if ($i != $cur) {
                $paging .= '<li>' . Tag::linkTo(array( $url . 'page=' . $i, $i, 'class' => $this->getAjaxClick())) . '</li>';
            } else {
                $paging .= '<li class="active"><a href="javascript:void(0);">' . $i . '</a></li>';
            }
        }
        return $paging;
    }

    public function convert_vi_to_en($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
        $str = preg_replace("/(đ)/", "d", $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
        $str = preg_replace("/(Đ)/", "D", $str);
        //$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
        return $str;
    }

    public function getAjaxClick()
    {
        return '';
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
}
