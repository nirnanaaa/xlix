<?php

namespace Xlix\Bundle\Mozok\Algorithms\Sha;

use Xlix\Bundle\Mozok\Encrypt\Interfaces\AlgoInterface;

class Sha1 implements AlgoInterface {

    private $_name = "Secured Hash Algorithm ( SHA ) 1";
    private $_infos = "In cryptography, SHA-1 is a cryptographic hash function designed by the United States National Security Agency and published by the United States NIST as a U.S. Federal Information Processing Standard. SHA stands for secure hash algorithm. The four SHA algorithms are structured differently and are distinguished as SHA-0, SHA-1, SHA-2, and SHA-3. SHA-1 is very similar to SHA-0, but corrects an error in the original SHA hash specification that led to significant weaknesses. The SHA-0 algorithm was not adopted by many applications. SHA-2 on the other hand significantly differs from the SHA-1 hash function.";
    private $_features = array(
        "encrypt" => true,
        "decrypt" => false,
        "bitlen" => 160
    );
    private $_options = array();

    public function getSupport() {
        return function_exists('sha1');
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

    public function encryptString($string, $salt) {
        $saltArray = unpack("N*", $salt);
        $saltcount = (string) $saltArray[1];
        $saltcount = substr($saltcount,0,3);
        $hasharray = array();
        for($count = 0;$count <= $saltcount; $count++){
            $hasharray[] = sha1($string);
        }
        $reval = array(
            "salt" => $salt,
            "hash" => sha1(implode("", $hasharray))
        );

        return $reval;
    }

    public function readOptions($options){
        return "NYI";
    }
}
