<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Routing\Ofwn\Compiler\Reference\Of;

class RefLoader {

    public $attributes;
    public $types;
    public $arrays;
    public $registered_reference;

    public function __construct() {
        $this->attributes = new AttributeReference();
        $this->registered_reference = array(
            "Controller" => "Action",
            "Action" => "Action",
            "Name" => "Name",
            "Match" => "Pattern",
            "Require" => "Require",
            "Status" => "Status"
        );
    }

    public function isRef($ref) {
        if (array_key_exists($ref, $this->registered_reference)) {
            return true;
        }
        return false;
    }
    public function getRefFor($ref){
        return $this->registered_reference[$ref];
    }

}

?>
