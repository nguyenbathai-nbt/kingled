<?php

namespace Daudau\Common\Mvc\Helper;

class Title extends \Phalcon\Mvc\User\Component {

    private static $instance;
    private static $parts = array();
    private static $separator = ' | ';

    public static function getInstance($title = null, $h1 = false) {
        if (!self::$instance) {
            self::$instance = new Title();
        }
        if ($title) {
            self::$instance->append($title);
            if ($h1) {
                self::$instance->getDi()->get('view')->setVar('title', $title);
            }
        }
        return self::$instance;
    }

    public function prepend($string) {
        if ($string) {
            array_unshift(self::$parts, $string);
        }
    }

    public function append($string) {
        if ($string) {
            self::$parts[] = $string;
        }
    }

    public function get() {
        if (!empty(self::$parts)) {
            return implode(self::$separator, self::$parts);
        }
    }

    public function set($string) {
        if ($string) {
            self::$parts = array($string);
        }
    }

    public function getHeader() {
        if (!empty(self::$parts)) {
            return self::$parts[0];
        }
    }

}
