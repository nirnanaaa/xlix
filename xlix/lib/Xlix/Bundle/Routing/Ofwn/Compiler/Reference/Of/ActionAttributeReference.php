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

class ActionAttributeReference implements ReferenceInterface {

    private $_maxlen = 255;
    private $_name = 'action';
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
        //~ eq Controller
        // Camel Case Seperation s
        $uncamelcased = $this->uncamelcase($data);
        return $uncamelcased;
    }

    public function uncamelcase($data) {
        if (preg_match("#~#", $data)) {
            $data = explode("~", $data);
            if (preg_match("#|#", $data[0])) {
                $dax = $data;
                $data = explode("|", $data[0]);
                $dReturn = implode("\\", preg_split('/(?=[A-Z])/', $data[0]));
                return $dReturn . "\\".$data[1]."\\Controller\\" . $dax[1];
            } else {
                $dReturn = implode("\\", preg_split('/(?=[A-Z])/', $data[0]));
                return $dReturn . "\\Controller\\" . $data[1];
            }
        }
    }

}