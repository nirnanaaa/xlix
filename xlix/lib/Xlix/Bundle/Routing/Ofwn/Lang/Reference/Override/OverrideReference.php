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

class OverrideReference implements ReferenceInterface {

    private $constants = array(
        "type",
        "prefix"
    );

    public function getOptions() {
        
    }

    public function parseContent($string) {
        $string = str_replace(" ", "", $string);
        $constants = new OverrideConstants();
        $process = explode($constants->getSeperator(), $string);
        $result = array();
        foreach ($process as $const) {
            preg_match("#(.*?)\=#i", $const, $index);
            if (in_array($index[1], $this->constants)) {
                preg_match("#{$index[1]}\=\"(.*?)\"#i",$const,$value);
                if($value[1] != ""){
                    $result[$index[1]] = $value[1];
                }
            }
            
        }
        return $result;
    }

    public function registerModules() {
        
    }

}

?>
