<?php

namespace Xlix\Bundle\Routing\Ofwn\Compiler;

use Symfony\Component\HttpFoundation\Request;

class StepOneExtractor {

    protected $_routes;

    public function __construct($routes) {
        $this->_routes = $routes;
    }

    public function callExtension() {
        $cry = array();
        foreach ($this->_routes as $route) {
            foreach ($route as $routex) {
                if (is_array($routex)) {
                    $routex['type'] = $route['type'];
                    $cry[] = $routex;
                }
            }
        }
        // print_r($this->_routes);
        return $this->compileStatic($cry);
    }

    public function parseOptions() {
        
    }

    public function __call($function, $arguments) {
        if (substr($function, 0, 7) == "compile") {
            $parser = new \Xlix\Bundle\Routing\Ofwn\Compiler\Reference\OfParser();
            return $parser->parseRoute($arguments[0]);
            switch (strtolower(substr($function, 7))) {
                case 'static':
                    break;
                case 'dynamic':
                    break;
                case 'mixed';
                    break;
                default:
                //EXCEPTION (function not exists bla bla bla)
            }
        }
    }

}