<?php

/**
 * Meta
 */

namespace Publisher\Common\Mvc\Helper;

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

    public function getAjaxClick()
    {
        return '';
    }
}
