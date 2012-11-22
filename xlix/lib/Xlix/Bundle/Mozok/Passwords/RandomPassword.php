<?php

namespace Xlix\Bundle\Mozok\Passwords;

class RandomPassword {

    private $_password;

    public function generateRandomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, strlen($alphabet) - 1); //use strlen instead of count
            $pass[$i] = $alphabet[$n];
        }
        $this->_password = sha1(implode($pass));
        return $this;
    }

    public function cutPassword($lenght) {
        return substr($this->_password, 0, $lenght);
    }

}