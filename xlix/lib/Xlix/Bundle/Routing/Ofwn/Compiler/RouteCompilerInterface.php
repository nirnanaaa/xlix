<?php

namespace Xlix\Bundle\Routing\Ofwn\Compiler;

interface RouteCompilerInterface {

    public function compileStaticRule(RouteStaticCompiler $router);
    
    public function compileDynamicRule(RouteDynamicCompiler $router);

    public function compileRedirectRule(RouteLinker $linker);
}