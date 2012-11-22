<?php

namespace Xlix\Bundle\Routing\Ofwn\Compiler;

class RouteLinker {

    public function linkRoute($route) {
        print_r($route);
        if (is_array($route) && array_key_exists("action", $route)) {
            echo "bla";
            return array(
                'match' => $route['match'],
                'controller' => $route['action'],
                'name' => $route['name'],
            );
        }
    }



}