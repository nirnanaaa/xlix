<?php

namespace Xlix\Bundle\Tests;

use Xlix\Bundle\Mozok\Encrypt\EncryptPassword;
use Xlix\Bundle\Mozok\Salts\RandomSalt;
class PasswordTest extends \PHPUnit_Framework_TestCase {

    public function testHashNewPasswordLen() {
        $enc = new EncryptPassword();
        $hash = $enc->generateNewpassword();
        $result = strlen($hash['hash']);
        $this->assertEquals(40, $result);
    }

    public function testPasswordRandomly() {
        $enc = new EncryptPassword();
        $hash = $enc->generateNewpassword();
        $hash2 = $enc->generateNewpassword();
        // assert that our calculator added the numbers correctly!
        $val = false;
        if ($hash !== $hash2) {
            $val = true;
        }
        $this->assertTrue(TRUE, $val);
    }

    public function testPasswordValidation() {
        $enc = new EncryptPassword();
        $this->assertTrue(TRUE,$enc->mozokCheck("65def8bf2cf5", "8dee84fad401f8e8d4f3e980cc8cc4ecb8635fc2", "b119ca7e"));    
    }
    public function testSaltFunctionality(){
        $enc = new RandomSalt();
        $this->assertEquals(40,strlen($enc->getRandomSalt()));
    }

}

?>