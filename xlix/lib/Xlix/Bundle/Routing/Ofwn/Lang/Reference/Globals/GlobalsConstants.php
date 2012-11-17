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

use Xlix\Bundle\Routing\Ofwn\Lang\Reference\ConstantsInterface;

class GlobalsConstants implements ConstantsInterface {

    private $identifier = "global";
    private $type = ConstantsInterface::TYPE_BLOCK;
    private $options = array();
    private $enddel = "}";
    private $startdel = "{";
    private $seperator = "";

    public function getIdentifier() {
        return $this->identifier;
    }

    public function getOptions() {
        return $this->options;
    }

    public function getType() {
        return $this->type;
    }

    public function getEndDelimiter() {
        return $this->enddel;
    }

    public function getSeperator() {
        return $this->seperator;
    }

    public function getStartDelimiter() {
        return $this->startdel;
    }

}

?>
