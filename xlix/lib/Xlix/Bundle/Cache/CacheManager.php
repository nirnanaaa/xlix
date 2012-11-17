<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\CacheManager;

use Xlix\Bundle\Config\ConfigManager;

class CacheManager {

    const TYPE_APC = 'Apc';
    const TYPE_FILE = 'File';
    const TYPE_MEMC = 'Memcached';

    private $config;
    private $type;

    public function __construct(ConfigManager $config) {
        $this->config = $config;
        $this->type = $this->detectBestCache();
    }

    public function isLifetimeExceeded($id) {
        
    }

    public function detectBestCache() {
        if (function_exists('apc_store') && function_exists('apc_fetch')) {
            $this->type = self::TYPE_APC;
        } elseif (function_exists('memcache_add') && function_exists('memcache_get')) {
            $this->type = self::TYPE_MEMC;
        } else {
            $this->type = self::TYPE_FILE;
        }
    }

    public function addToCache($id, $value) {
        
    }

    public function getFromCache($id) {
        
    }

}

?>
