<?php

namespace Publisher\Common\Mvc\Helper;

class ActiveMenu extends \Phalcon\Mvc\User\Component {

    private static $instance;
    private $active = array();

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new ActiveMenu();
        }
        return self::$instance;
    }

    public function setActive($value) {
        $this->active[] = $value;
    }

    public function deleteActive($value) {
        unset($this->active[0]);
    }

    public function getActive() {
        return $this->active;
    }

    public function isActive($value) {
        if (in_array($value, $this->active)) {
            return true;
        }
    }

    public function activeClass($value) {
        if ($this->isActive($value)) {
            return ' active';
        }
    }

}

?>