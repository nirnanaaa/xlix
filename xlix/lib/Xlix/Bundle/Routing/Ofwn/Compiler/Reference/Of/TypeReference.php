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

class TypeReference implements ReferenceInterface {

    private $_maxlen = 1;
    private $_name = 'type';
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
        return $this->getValidation()->isAlnum($mixed);
    }

    public function handleData($data) {
        
    }

}