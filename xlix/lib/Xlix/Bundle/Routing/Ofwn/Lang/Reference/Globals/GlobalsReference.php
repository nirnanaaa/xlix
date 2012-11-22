<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Routing\Ofwn\Lang\Reference\Globals;

use Xlix\Bundle\Routing\Ofwn\Lang\Reference\ReferenceInterface;

/**
 * Call a controller based route
 * but ... globals are currently the same as override in my mind
 *
 * OfwnLanguageParserGateway calls the following method:
 * 
 * parseContent(param)
 *
 * @author  Florian Kasper <xlix@khnetworks.com>
 * @see     http://version.xlix.eu
 *
 */
class GlobalsReference implements ReferenceInterface {

    /**
     * gets the options /classes / modules needed
     * currently unused
     * 
     * @return null
     */
    public function getOptions() {
        
    }

    /**
     *
     * parsing an array (string) into a new array with elements
     *  
     * @param   array $string the RAW routing information
     * @todo    refactor $string to $array or something clear
     * @return  array 
     */
    public function parseContent($string) {
        return $string;
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
