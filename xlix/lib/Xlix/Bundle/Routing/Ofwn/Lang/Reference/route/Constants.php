<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Routing\Lang\Reference\route;

use Xlix\Bundle\Routing\Lang\Reference\ConstantsInterface;

class Constants implements ConstantsInterface {

    private $identifier = "route";
    private $type = ConstantsInterface::TYPE_BLOCK;
    private $options = array();

    const GLOBALS_SEPERATOR = ";";
    const GLOBALS_STARTDEL = "{";
    const GLOBALS_ENDDEL = "}";

    public function getIdentifier() {
        return $this->identifier;
    }

    public function getOptions() {
        return $this->options;
    }

    public function getType() {
        return $this->type;
    }

}

?>
