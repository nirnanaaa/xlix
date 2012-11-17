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

/**
 * Call a controller based route
 *
 * OfwnLanguageParserGateway calls the following method:
 * 
 * parseContent(param)
 *
 * @author  Florian Kasper <xlix@khnetworks.com>
 * @see     http://version.xlix.eu
 *
 */
class RouteReference implements ReferenceInterface {

    /**
     * constants useable
     * @var array
     */
    private $constants = array(
        "name",
        "prefix",
        "route",
        "parameters",
        "type",
    );

    /**
     * types of parameters
     * collection => same as an array
     * single => a single value
     * dual => NYI / WD(will drop)
     */
    private $types = array(
        "collection",
        "single",
        "dual"
    );

    /**
     * gets the options /classes / modules needed
     * currently unused
     * 
     * @return null
     */
    public function getOptions() {
        return null;
    }

    /**
     * it looks a bit strange but ... it is :) to clarify:
     * 
     * parsing an array (string) into a new array with elements
     *  
     * @param   array $string the RAW routing information
     * @todo    refactor $string to $array or something clear
     * @return  array 
     */
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
                        if (preg_match("#GETV#", $value[1])) {
                            preg_match("#\[\"(.*?)\"]#", $value[1], $getvar);
                            $value[1] = $_GET[$getvar[1]];
                        }
                        $result[$index[1]][$indexes[1]] = $value[1];
                    }
                }
            }
        }

        return $result;
    }
    /**
     * currently unused ... but this method should register all *Mod files
     *
     * @return null
     */
    public function registerModules() {
        return null;
    }

}

?>
