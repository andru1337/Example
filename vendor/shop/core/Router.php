<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 24.04.2018
 * Time: 23:00
 */

namespace shop;


class Router
{

    protected static $routes = []; //таблица маршрутов
    protected static $route = []; //текущий маршрут

    public static function add($regexp, $route = []) {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes() {
        return self::$routes;
    }

    public static function getRoute()
    {
        return self::$route;
    }
    public static function dispatch($url) {
        //var_dump($url);
        $url = self::removeQueryString($url);
        //var_dump($url);
        if (self::matchRoute($url)) {
            $contorller = 'app\controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';
            if (class_exists($contorller)) {
                /*Проверяем есть ли такой контроллер создаем объект контроллера, передаем текущий маршрут*/
                $contorllerObject = new $contorller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                /*Проверяем есть ли такой метод экшн у данного контроллера(объекта)*/
                if(method_exists($contorllerObject, $action)) {
                    $contorllerObject->$action();
                    $contorllerObject->getView();
                } else {
                    throw new \Exception("Метод $contorller::$action не найден", 404);

                }
            } else {
                throw new \Exception("Контроллер $contorller не найден", 404);
            }
        } else {
            throw new \Exception("Страница не найдена", 404);
        }
    }
    //сравнивает
    public static function matchRoute($url) {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#{$pattern}#i", $url, $matches)) {
                foreach ($matches as $k => $v) {
                    if(is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if(empty($route['action'])) {
                    $route['action'] = 'index';
                }
                if(!isset($route['prefix'])) {
                    $route['prefix'] = '';
                } else {
                    $route['prefix'] .= '\\';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                //debugPrint(self::$route);
                return true;
            }
        }
        return false;
    }
    //CamelCase
    protected static function upperCamelCase($name) {
        //debugPrint($name);
        $name = str_replace(' ', '',  ucwords(str_replace('-', ' ', $name)));
        //debugPrint($name);
        return $name;

    }
    //camelCase
    protected static function lowerCamelCase($name) {
        $name = self::upperCamelCase($name);
        return lcfirst($name);
    }

    protected static function removeQueryString($url) {
        //var_dump($url);
        if($url) {
            $params = explode('&', $url, 2);
            if(false === strpos($params[0], '=')) {
                return rtrim($params[0], '/');
            } else {
                return '';
            }
            //debugPrint($params);
        }
    }

}