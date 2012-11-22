<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Routing\Ofwn\Lang\Reference\Override;

use Xlix\Bundle\Routing\Ofwn\Lang\Reference\ReferenceInterface;
use Xlix\Bundle\Routing\Ofwn\Lang\Reference\Override\OverrideConstants;

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
class OverrideReference implements ReferenceInterface {

    /**
     * constants useable
     * @var array
     */
    private $constants = array(
        "type",
        "prefix"
    );

    /**
     * gets the options /classes / modules needed
     * currently unused
     * 
     * @return null
     */
    public function getOptions() {
        
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
        $string = str_replace(" ", "", $string[0]);
        $constants = new OverrideConstants();
        $process = explode($constants->getSeperator(), $string);
        $result = array();
        foreach ($process as $const) {
            preg_match("#(.*?)\=#i", $const, $index);
            if (array_key_exists(1, $index)) {
                if (in_array($index[1], $this->constants)) {
                    preg_match("#{$index[1]}\=\"(.*?)\"#i", $const, $value);
                    if ($value[1] != "") {
                        $result[$index[1]] = $value[1];
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
        
    }

}

?>
