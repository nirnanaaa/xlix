<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Routing\Ofwn\Compiler;

use Symfony\Component\HttpFoundation\Request;
use Xlix\Bundle\Routing\Ofwn\Parser\RoutingTables;
use Xlix\Bundle\Routing\Ofwn\Compiler\StepOneExtractor;

/**
 * Manages the cache / file 
 *
 * methods called by Init file are:
 * 
 * getCache:    gets the content of the cache as array
 *
 * @author  Florian Kasper <xlix@khnetworks.com>
 * @see     http://version.xlix.eu
 *
 */
class CacheManager {

    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    public $_request;

    /**
     * @var array
     */
    public $_config;

    /**
     * @var array
     */
    public $_cache;

    /**
     * Constructor.
     *
     * @param \Xlix\Bundle\Routing\Ofwn\Compiler\ConfigManager $config  the config instance
     * 
     */
    public function __construct(ConfigManager $config) {
        $this->_request = new Request($_GET, $_POST, pathinfo(2), $_COOKIE, $_FILES, $_SERVER);
        $this->_config = $config->getConfig();
        $this->_cache = $this->getCache();
    }

    /**
     * gets the routes based on if they are cached / expired / not cached
     * 
     * uses various functions / Classes therefor cause it is very mixed content
     *
     * @return array
     * 
     */
    public function getCache() {
        $directoryBuilder = __DIR__ . DIRECTORY_SEPARATOR . $this->_config->cachedir .
                DIRECTORY_SEPARATOR . $this->_config->cachefile;

        if (!file_exists($directoryBuilder) || $this->isExpired($directoryBuilder)) {
            unlink($directoryBuilder);
            touch($directoryBuilder);
            $this->buildCacheFromScratch($directoryBuilder);
        } else {
            $this->buildCacheFromScratch($directoryBuilder);
            return unserialize(file_get_contents($directoryBuilder));
        }
    }
    /**
     * checks if cached file is expired based on the expire time from Config.yml
     * in the Compiler root directory
     *
     * @param string $cache File location of the cache file
     * @return boolean
     * 
     */
    public function isExpired($cache) {
        if (filemtime($cache) + $this->_config->expire > time()) {
            return false;
        }
        return true;
    }
    /**
     * builds a cache up from scratch if there is no one
     *
     * @param string $cache File location of the cache file
     * @return boolean|array
     * 
     */
    public function buildCacheFromScratch($cache) {
        $TableParser = new RoutingTables;
        $ofwnTables = $TableParser->getOfwns();
        $xTractor = new StepOneExtractor($ofwnTables);
        if (file_put_contents($cache, serialize($xTractor->callExtension()))) {
            return $xTractor->callExtension();
        }
        return false;
    }

}