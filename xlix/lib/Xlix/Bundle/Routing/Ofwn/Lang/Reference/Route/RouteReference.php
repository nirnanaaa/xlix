<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Routing\Ofwn\Lang\Reference\Route;

use Xlix\Bundle\Routing\Ofwn\Lang\Reference\ReferenceInterface;
use Xlix\Bundle\Routing\Ofwn\Lang\Reference\Route\RouteConstants;

class RouteReference implements ReferenceInterface {

    private $constants = array(
        "name",
        "prefix",
        "route",
        "parameters",
        "type",
    );
    private $types = array(
        "collection",
        "single",
        "dual"
    );

    public function getOptions() {
        
    }

    public function parseContent($string) {
        $string = str_replace(" ", "", $string);
        $constants = new RouteConstants();
        $process = explode($constants->getSeperator(), $string);
        $result = array();
        foreach ($process as $proc) {
            preg_match("#(.*?)\=#i", $proc, $index);
            if (in_array($index[1], $this->constants)) {
                preg_match("#{$index[1]}\=\"(.*?)\"#i", $proc, $value);
                if ($value[1] != "") {
                    $result[$index[1]] = $value[1];
                    continue;
                }
                preg_match("#\=(.*?)\(#", $proc, $type);
                if (in_array($type[1], $this->types)) {
                    preg_match("#\((.*?)\)#", $proc, $value);
                    $ppc = explode(",", $value[1]);
                    foreach ($ppc as $values) {
                        preg_match("#\"(.*?)\"\=#", $values, $indexes);
                        preg_match("#{$indexes[0]}(.*?)\!#", $values, $value);
                        if(preg_match("#GETV#",$value[1])){
                            preg_match("#\[\"(.*?)\"]#",$value[1],$getvar);
                            $value[1] = $_GET[$getvar[1]];
                        }
                        $result[$index[1]][$indexes[1]] = $value[1];
                    }

                }
            }
            //preg_match("#\#");
            // print_r($index);
        }

        return $result;
    }

    public function registerModules() {
        
    }

}

?>
