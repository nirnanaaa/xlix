<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Routing\Ofwn\Compiler\Reference;

class OfParser {

    /**
     * parses a single route 
     * 
     * 11/08/2012: continue speed improvement!
     * @access  public
     * @param array $route the unparsed route
     * @return array the single route
     *  
     */
    public function parseRoute($route) {
        $lan = new Of\RefLoader();
        $routx = 0;
        $preroute = array();
        foreach ($route as $line) {
            foreach ($line as $inroute) {
                $inroute = preg_replace('#\s\s+#', '', trim($inroute));

                if ($inroute[0] == $lan->attributes->getStartswith()) {

                    $rwd = explode(":", $inroute);
                    $blancoFunction = ucfirst(str_replace($lan->attributes->getStartswith(), "", $rwd[0]));
                    if (!$lan->isRef($blancoFunction)) {
                        continue;
                    }
                    $blancoFunction = $lan->getRefFor($blancoFunction);
                    $functionName = $blancoFunction . "AttributeReference";
                    $fnCall = "getAttr{$functionName}";
                    $preroute[$routx][$lan->attributes->$fnCall()->getName()] =
                            $lan->attributes->$fnCall()->handleData($rwd[1]);
                } /* elseif ($inroute[0] == "'") {
                  $rwd = explode(":", $inroute);
                  $preroute[$routx]['arguments'][substr($rwd[0], 1)] = $rwd[1];
                  }*/
                  $preroute[$routx][$lan->attributes->getAttrTypeReference()->getName()] = $line['type']; 
            }
            $routx++;
        }
        return $preroute;
    }

    public function getReference() {
        
    }

}