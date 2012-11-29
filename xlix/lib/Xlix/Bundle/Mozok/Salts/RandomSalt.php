<?php

namespace Xlix\Bundle\Mozok\Salts;

class RandomSalt {

    public function getRandomSalt() {
        //-> $basesalt = base_convert(mt_rand(time(), time() + mt_rand(1009, 9999)) * 2 * mt_rand(1, mt_getrandmax()), 10, 2);
        return $this->createSha3Salt();
    }

    public function createSha3Salt() {
        $basesalt = base_convert(
                sha3(
                        mktime(
                                mt_rand(1, 24), mt_rand(1, 60), mt_rand(1, 60), mt_rand(1, 12), mt_rand(1, 7), mt_rand(1970, 2051)
                        ) + mt_getrandmax()
                        , 384)
                , 16, 10);
        $basesalt = $basesalt * 256;
        return sha3($basesalt, 256);
    }

}