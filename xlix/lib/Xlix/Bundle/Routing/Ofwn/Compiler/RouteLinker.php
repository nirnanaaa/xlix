<?php

namespace Xlix\Bundle\Routing\Ofwn\Compiler;

class RouteLinker {

    public function linkRoute($route) {
        if (is_array($route) && array_key_exists("action", $route)) {
            $actions = explode("=", $route["action"]);
            $class = $actions[0] . "Controller";
            $method = $actions[1] . "Action";
            //print_r($class);break;
            if (!class_exists($class)) {
                throw new Exception\ClassNotFoundException("the class cannot be found under: {$class}. Aborting");
            }
            if (!method_exists($class, $method)) {
                throw new Exception\ClassNotFoundException("could not find method: {$method}. Aborting");
            }
            $this->linkRouteToClass($class, $method);
        }
    }

    public function linkRouteToClass($class,$method) {
        $cls = new $class;
    }

}