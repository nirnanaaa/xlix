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

class PatternAttributeReference implements ReferenceInterface {

    private $_maxlen = 255;
    private $_name = 'pattern';
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
        return $data;
    }

}