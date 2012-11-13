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

class StatusAttributeReference implements ReferenceInterface {

    private $_maxlen = 255;
    private $_name = 'status';
    private $_validation = "\\Xlix\\Bundle\\Validation\\StringValidation";

    public function getMaxLen() {
        return $this->_maxlen;
    }

    public function getName() {
        return $this->_name;
    }

    public function getValidation() {
        return new $this->_validation;
    }

    public function isValid($mixed) {
        return $this->getValidation()->isString($mixed);
    }

    public function handleData($data) {
        if(!is_int($data)){
            $data = (int) $data;
        }
        if($data < 0 || $data > 599){
            return "NIL";
        }
        else return $data;
    }

}