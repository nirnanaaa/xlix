<?php

namespace Xlix\Bundle\Routing\Ofwn\Compiler;

use Xlix\Bundle\Routing\Ofwn\Compiler\Constants\RoutingTypes as COMPILER_TYPES;

class RouteCompiler implements RouteCompilerInterface {

    public function compileDynamicRule(RouteDynamicCompiler $router) {
        
    }

    /**
     * Example:
     * NAME:
     *      type:               redirect
     *      from:               {webroot}
     *      to:                 {webroot}/web
     *      status:             302
     * seperated as array:
     *      $ = array(
     *      "type" => COMPILER_TYPES::REDIRECT
     *      "from" => 
     * 
     * );
     */
    public function compileRedirectRule(RouteLinker $linker) {
        
    }

    /**
     * Example:
     * NAME:
     *      type:               static/relative/dynamic
     *      matches_absolute:   /web/mediax/{a1}/{a2};{a3}?{ax}
     *      type:               controller
     *      name:               AdminBundle:Index
     *      actionif:           {a1} eq 2
     *      actionthen:         calc
     *      manual_parameters:  {a2} eq 31         
     */
    public function compileStaticRule(RouteStaticCompiler $router) {
        
    }

}