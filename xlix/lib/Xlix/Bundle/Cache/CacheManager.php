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

use Xlix\Bundle\Config\ConfigManager;
use Xlix\Bundle\Routing\Ofwn\ZeroDayReader;

class CacheManager {

    const TYPE_APC = 'Apc';
    const TYPE_FILE = 'File';
    const TYPE_MEMC = 'Memcached';

    private $config;
    private $type;
    private $cache;

    public function __construct(ConfigManager $config) {
        $this->config = $config->getConfig()->options['cache'];
        $this->type = $this->detectBestCache();
        echo "123";
    }

    public function isAlive($id) {
        
    }

    // if (filemtime()) {
    // }


    public function detectBestCache() {
        $type = "";
        if (function_exists('apc_store') == 1 && function_exists('apc_fetch') == 1 &&
                $this->config['apc']['use'] == 1) {
            $type = self::TYPE_APC;
        } elseif (function_exists('memcache_add') && function_exists('memcache_get') &&
                $this->config['memcached']['use'] == 1) {

            $type = self::TYPE_MEMC;
        } else {

            $type = self::TYPE_FILE;
        }
        $cls = sprintf($this->config['templ'], $type);
        $this->cache = new $cls($this->config);
        return $type;
    }

    public function addToCache($id, $value) {
        
    }

    public function getFromCache($id) {
        
    }

}
?>
