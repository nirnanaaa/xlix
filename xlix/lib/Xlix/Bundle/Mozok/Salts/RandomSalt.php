<?php
/*
 * This file is part of the XLIX Bundle
 *
 * (c) Florian Kasper
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Xlix\Bundle\Mozok\Salts;

class RandomSalt {

    public function getRandomSalt() {
        $basesalt = base_convert(mt_rand(time(), time() + mt_rand(1009, 9999)) * 2 * mt_rand(1, mt_getrandmax()), 10, 2);
        return sha1($basesalt);
    }

}