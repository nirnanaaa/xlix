<?php

namespace Xlix\Bundle\Authentication;
use Xlix\Bundle\Mozok\Encrypt\EncryptPassword;
class ValidateNormalRequest {

    public function isValid($password, $hash, $salt = null) {
        $validator = new EncryptPassword();
        $validator->mozokCheck($password, $hash, $salt);
    }

}

?>
