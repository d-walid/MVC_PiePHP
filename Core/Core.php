<?php

namespace Core;

use Core\Router;

class Core
{
    public function run()
    {
        include 'src/routes.php';
        $url = str_replace(BASE_URI, '', $_SERVER["REQUEST_URI"]);
        if (($arr = Router::get($url))) {
            /* Static route with routes.php*/
        } else {
            /* Dynamic route filled with URL*/
            $tmp = explode("/", $url);
            $arr["controller"] = count($tmp) > 1 ? $tmp[1] : "user";
            $arr["action"] = count($tmp) > 2 ? $tmp[2] : "error";
        }
        $class = "\\Controller\\" . ucfirst($arr["controller"]) . "Controller";
        if (!class_exists($class)) {
            $class = "\\Controller\\UserController";
        }
        $methode = $arr["action"] . "Action";
        $controller = new $class();
        if (!method_exists($controller, $methode)) {
            $methode = "errorAction";
        }
        $controller->$methode();
    }
}
