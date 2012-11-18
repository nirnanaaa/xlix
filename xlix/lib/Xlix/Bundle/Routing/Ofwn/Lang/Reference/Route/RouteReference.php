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
        "controller",
        "action"
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

        $constants = new RouteConstants();
        $rid = 0;
        $result = array();
        foreach ($string as $str) {
            $str = str_replace(" ", "", $str);
            $process = explode($constants->getSeperator(), $str);
            foreach ($process as $proc) {
                preg_match("#(.*?)\=#i", $proc, $index);
                if (array_key_exists(1, $index)) {
                    if (in_array($index[1], $this->constants)) {

                        preg_match("#{$index[1]}\=\"(.*?)\"#i", $proc, $value);
                        if ($value[1] != "") {
                            $result[$rid][$index[1]] = $value[1];
                        }
                    }
                }
            }
            $rid++;
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
