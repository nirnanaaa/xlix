<?php

namespace Xlix\Bundle\Authentication;

use Xlix\Bundle\Authentication\ValidateApiRequest;
use Xlix\Bundle\Authentication\ValidateNormalRequest;
use Xlix\Bundle\Exception\NotYetImplementedException;
use Xlix\Bundle\Parser\Yaml\YamlParser;
use Symfony\Component\HttpFoundation\Request;

class ValidateAuthentication {

    public function isApi() {
        $request = Request::createFromGlobals();
        $cfg = new YamlParser();
        $api = $cfg->parseXlixConfig()->api;
        $headers = $request->headers;
        if ($headers->get($api['header_key']) && $headers->get($api['header_secret'])) {
            
        }
    }

    public function auth($password = null, $hash = null, $salt = null) {

        $validation = new ValidateNormalRequest();
        return $validation->isValid($password, $hash, $salt);
    }

    public function authAPI($request) {
        throw new NotYetImplementedException("Api is not implemented yet!");

        $validation = new ValidateApiRequest();
        return $validation->isValid($request);
    }

    public function isPostOrApiAuth() {
        $request = Request::createFromGlobals();
        if ($request->isMethod('POST') || $this->isApi()) {
            return true;
        }
        return false;
    }

}

?>
