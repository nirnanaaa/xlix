<?php

namespace Xlix\Bundle\Authentication;

use Xlix\Bundle\Authentication\ValidateApiRequest;
use Xlix\Bundle\Authentication\ValidateNormalRequest;
use Xlix\Bundle\Exception\NotYetImplementedException;
class ValidateAuthentication {

    public function auth($password = null, $hash = null, $salt = null) {

        $validation = new ValidateNormalRequest();
        return $validation->isValid($password, $hash, $salt);
    }

    public function authAPI($request) {
        throw new NotYetImplementedException("Api is not implemented yet!");
        
        $validation = new ValidateApiRequest();
        return $validation->isValid($request);
    }

}

?>
