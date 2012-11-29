<?php

namespace Xlix\Bundle\Mozok\Algorithms\Sha;

use Xlix\Bundle\Mozok\Encrypt\Interfaces\AlgoInterface;

class Sha3 implements AlgoInterface {

    private $_name = "Secured Hash Algorithm ( SHA ) 3";
    private $_infos = "Keccak";
    private $_features = array(
        "encrypt" => true,
        "decrypt" => false,
        "bitlen" => 384
    );
    private $_options = array();

    public function getSupport() {
        return function_exists('sha3');
    }

    public function getName() {
        return $this->_name;
    }

    public function getInfos() {
        return $this->_infos;
    }

    public function getFeatures() {
        return $this->_features;
    }

    public function ascDec($str) {
        for ($i = 0, $j = strlen($str); $i < $j; $i++) {
            $dec_array[] = ord($str{$i});
        }
        return implode($dec_array);
    }

    public function encryptString($string, $salt) {
        $hashes_used_secondary = array(
            "sha1",
            "sha256",
            "whirlpool",
            "adler32",
            "md5",
            "crc32",
            "snefru256",
            "salsa20",
            "sha512"
        );
        $saltArray = unpack("N*", $salt);
        $saltcount = (string) $saltArray[1];
        $saltcount = substr($saltcount, 0, 3);
        $hash_use = $hashes_used_secondary[$saltcount[1] - 1];


        $hasharray = array();
        for ($count = 0; $count <= $saltcount * 2; $count++) {

            $hasharray[] = sha3($this->ascDec($string) * $count);
            if (null !== hash($hash_use, $salt)) {
                $hasharray[] = hash($hash_use, $salt);
            }
        }
        $reval = array(
            "salt" => $salt,
            "hash" => sha3(implode("", $hasharray), 384)
        );
        return $reval;
    }

    public function readOptions($options) {
        return "NYI";
    }

}
