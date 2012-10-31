<?php

namespace Xlix\Bundle\Validation;

use Xlix\Bundle\Validation\Exception\InvalidInputException;

class StringValidation {

    public function isAlnum($resource) {
        
    }

    public function validateLenght($resource, $maxlen, $minlen = 0) {
        
    }

    public function isString($resource) {
        return is_string($resource);
    }

    public function isValidEmail($resource) {
        if(!$this->isString($resource)){
            throw new InvalidInputException("E-mail must be a string");
        }
        if(!filter_var($resource, FILTER_VALIDATE_EMAIL)){
            throw new InvalidInputException("Not an E-mail address");
        }
        return true;
        
    }

}