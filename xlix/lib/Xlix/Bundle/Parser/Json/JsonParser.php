<?php

namespace Xlix\Bundle\Parser\Json;

use Xlix\Bundle\Validation\StringValidation;

class JsonParser {

    protected $validator;

    public function __construct() {
        $this->validator = new StringValidation;
    }

    public function encodeJson($mixed) {
        return json_encode($mixed);
    }

    public function decodeJson($string, $assoc = false) {
        if (!$this->validator->isString($string)) {
            return false;
        }
        return json_decode($string, $assoc);
    }

    public function decodeAsArray($string) {
        return $this->decodeJson($string, true);
    }

    public function decodeAsObject($string) {
        return $this->decodeJson($string);
    }

}