<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Crypto\Aes;

/**
 * Thanks go to https://gist.github.com/1077723 for the inspiration
 * 
 */
class TwoLevel {

    public function encodeBaseData($key, $data) {
        return base64_encode($this->encode256data($key, $data));
    }

    public function decodeBaseData($key, $hashed) {
        return $this->decode256data($key, base64_decode($hashed));
    }

    public function encode256data($key, $data) {
        return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->getKey($key), $this->getData($data), MCRYPT_MODE_CBC, str_repeat("\0", 16));
    }

    public function decode256data($key, $hashed) {
        $data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->getKey($key), $hashed, MCRYPT_MODE_CBC, str_repeat("\0", 16));
        $padding = ord($data[strlen($data) - 1]);
        return substr($data, 0, -$padding);
    }

    public function getKey($key) {
        if (32 !== strlen($key)) {
            return hash('Sha256', $key, true);
        }
        return $key;
    }

    public function getPadding($data) {
        return 16 - (strlen($data) % 16);
    }

    public function getData($data) {
        $data .= str_repeat(chr($this->getPadding($data)), $this->getPadding($data));
        return $data;
    }

}

?>
