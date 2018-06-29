<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 24.04.2018
 * Time: 17:13
 */

namespace shop;


class Registry
{

    use TSingleton;

    public static $properties = [];

    public function setProperty($name, $value)
    {
        self::$properties[$name] = $value;
    }

    public static function getProperty($name)
    {
        if (isset(self::$properties[$name])) {
            return self::$properties[$name];
        }
        return null;
    }

    public static function getProperties()
    {
        return self::$properties;
    }
}
