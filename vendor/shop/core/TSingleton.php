<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 24.04.2018
 * Time: 17:14
 */

namespace shop;


trait TSingleton {

    private static $instance;

    public static function instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}