<?php

namespace Xlix\Bundle\Mozok\Encrypt;

use Xlix\Bundle\Mozok\Encryption\Constants;
use Xlix\Bundle\Mozok\Passwords\RandomPassword;
use Xlix\Bundle\Mozok\Salts\RandomSalt;
<<<<<<< HEAD
use Xlix\Bundle\Mozok\Algorithms\Sha\Sha3;
=======
use Xlix\Bundle\Mozok\Algorithms\Sha\Sha1;
>>>>>>> 644d210cc30c8ace9afe02f7f08bb576b1634756
use Xlix\Bundle\Mozok\Exception\MozokValidateException;

class EncryptPassword {

    public function mozokRounds($salt) {
        
    }

    public function mozokCheck($password, $hash, $salt = null) {
<<<<<<< HEAD
        $sha1 = new Sha3();
=======
        $sha1 = new Sha1();
>>>>>>> 644d210cc30c8ace9afe02f7f08bb576b1634756
        $hashGen = $sha1->encryptString($password, $salt);
        if ($hash !== $hashGen['hash']) {
            throw new MozokValidateException("password missmatch");
            return false;
        }
        return true;
    }

    public function generateNewpassword() {
<<<<<<< HEAD
        $sha1 = new Sha3();
=======
        $sha1 = new Sha1();
>>>>>>> 644d210cc30c8ace9afe02f7f08bb576b1634756
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
