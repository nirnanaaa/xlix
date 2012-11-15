<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Routing\Ofwn\Compiler;

class RouteMatcher {

    public $foundRoute = false;

    public function matchesRouteToCurrentUrl($pattern, $utils) {
        $utl = $utils->getRequestUri();
        $cutted = $this->cutBaseOut($utl, $utils->getConfig());
        $ctd = explode("?",$cutted);
        if ($this->foundRoute) {
            return false;
        } else {
            $regexBuilder = new Regex\Builder();
            $whatwehave = $regexBuilder->replaceWithString($pattern['pattern']);
            if (preg_match("#^{$whatwehave}$#", $ctd[0])) {
                $this->foundRoute = true;
                return $pattern;
            }
        }
    }

    public function cutBaseOut($from, $config) {
        return str_replace($config->base_url, "", $from);
    }

}

?>
