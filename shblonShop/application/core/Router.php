<?php

namespace application\core;

use application\core\View;

class Router {

    private static $listUrl=[];
    private static $route = [];


    public static function add($url,$view,$controller,$action,$layouts){
        self::$listUrl[]=[
            'url'=>$url,
            'view'=>$view,
            'controller'=>$controller,
            'layouts'=>$layouts,
            'action'=>$action
        ];
    }

    public static function run(){
        if (self::match()) {
            $path = 'application\controllers\\'.ucfirst(self::$route['controller']).'Controller';
            if (class_exists($path)) {
                $action = self::$route['action'].'Action';
                if (method_exists($path, $action)) {
                    $controller = new $path(self::$route);
                    $controller->$action();
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }

    private static function match() {
        $url = trim($_SERVER['REQUEST_URI']);
        foreach (self::$listUrl as $route) {
            if($url=='/'){
                if(trim($route['url'],'/') == ''){
                    self::$route = $route;
                    return true;
                }else{
                    continue;
                }
            }else{
                if ($route['url'] == $url) {
                    self::$route = $route;
                    return true;
                }
            }
        }
        return false;
    }

}