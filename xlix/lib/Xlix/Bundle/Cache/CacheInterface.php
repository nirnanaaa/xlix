<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Cache;

interface CacheInterface {

    public function __construct($cache);

    public function isAlive($id);

    public function getFromCache($id);

    public function addToCache($id, $value);
}

?>
