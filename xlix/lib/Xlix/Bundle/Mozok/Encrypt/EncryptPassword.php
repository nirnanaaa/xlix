<?php

namespace Xlix\Bundle\Mozok\Encrypt;

use Xlix\Bundle\Mozok\Encryption\Constants;
use Xlix\Bundle\Mozok\Passwords\RandomPassword;
use Xlix\Bundle\Mozok\Salts\RandomSalt;
use Xlix\Bundle\Mozok\Algorithms\Sha\Sha3;
use Xlix\Bundle\Mozok\Exception\MozokValidateException;

class EncryptPassword {

    public function mozokRounds($salt) {
        
    }

    public function mozokCheck($password, $hash, $salt = null) {
        $sha1 = new Sha3();
        $hashGen = $sha1->encryptString($password, $salt);
        if ($hash !== $hashGen['hash']) {
            throw new MozokValidateException("password missmatch");
            return false;
        }
        return true;
    }

    public function generateNewpassword() {
        $sha1 = new Sha3();
        $salt = new RandomSalt();
        $password = new RandomPassword();
        $salt = substr($salt->getRandomSalt(), 0, 8);
        $pass = $password->generateRandomPassword()->cutPassword(12);
        $base = $sha1->encryptString($pass, $salt);
        $base['clear'] = $pass;
        return $base;
    }

    public function mozokGetEncryption($hash) {
        if (strlen($hash) == 32) {
            // return 
        }
    }
    public function returnte(){
        return "test";
    }

}

?>
