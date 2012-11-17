<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Builder;

class ArrayBuilder {

    /**
     * Associative 3d array
     * @var array
     */
    public $array = array();

    public function addToArray($name, $content, $index = null) {
        if ($content) {
            if (!$index) {

                $this->array[$name][] = $content;
            } else {
                $this->array[$name][$index] = $content;
            }
        }
    }

    public function setArray($name, $array) {
        $this->array[$name] = $array;
    }

    public function getArray($name) {
        return $this->array[$name];
    }

}

?>
