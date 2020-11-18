<?php

/**
 * Meta
 */

namespace Daudau\Common\Mvc\Helper;

class Breadcrumbs extends \Phalcon\Mvc\User\Component {

    private static $instance;
    private static $_elements = array();

    public static function getInstance($caption = null, $link = null) {
        if (!self::$instance) {
            self::$instance = new Breadcrumbs();
        }
        if ($caption) {
            self::$instance->add($caption, $link);
        }
        return self::$instance;
    }

    public function add($cation, $link) {
        if ($cation) {
            self::$_elements[] = array(
                'active' => false,
                'link' => '/'.$link,
                'caption' => $cation,
            );
        }
    }

    public function reset() {
        self::$_elements = array();
    }

    public function get() {

        $lastKey = key(array_slice(self::$_elements, -1, 1, true));

        self::$_elements[$lastKey]['active'] = true;

        return self::$_elements;
    }

    public function set($cation, $link) {
        if ($cation) {
            self::$_elements[] = array(
                'active' => false,
                'link' => $link,
                'caption' => $cation,
            );
        }
    }
    
    public function getActive() {
        
        $lastKey = key(array_slice(self::$_elements, -1, 1, true));

        return self::$_elements[$lastKey]['caption'];

    }

}
