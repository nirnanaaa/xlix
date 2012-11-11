<?php

namespace Xlix\Bundle\Routing\Ofwn\Compiler;

class RouteStaticCompiler {

    public function compileData($route, $matcher, $linker, $alu, $utils) {
        if ($match = $matcher->matchesRouteToCurrentUrl($route, $utils)) {
            return $match;
        }
    }

}