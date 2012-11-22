<?php

namespace Xlix\Bundle\Validation;

use Xlix\Bundle\Validation\Exception\InvalidInputException;

class StringValidation {

    public function isAlpha($resource) {
        if (!$this->isString($resource)) {
            throw new InvalidInputException("Strings only please");
        }
        return ctype_alpha($resource);
    }

    public function isAlnum($resource) {
        if (!$this->isString($resource)) {
            throw new InvalidInputException("Strings only please");
        }
        return ctype_alnum($resource);
    }

    public function validateLenght($resource, $maxlen, $minlen = 0) {
        $preProcess = (string) $resource;
        if (strlen($preProcess) <= $maxlen) {
            if ($minlen != 0) {
                if (strlen($preProcess) < $minlen) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    public function isString($resource) {
        return is_string($resource);
    }

    public function isValidEmail($resource) {
        if (!$this->isString($resource)) {
            throw new InvalidInputException("E-mail must be a string");
        }
        if (!filter_var($resource, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidInputException("Not an E-mail address");
        }
        return true;
    }

}