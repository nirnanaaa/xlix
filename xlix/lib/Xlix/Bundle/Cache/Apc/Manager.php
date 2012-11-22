<?php

namespace Xlix\Bundle\Cache\Apc;

use Xlix\Bundle\Cache\CacheInterface;
use Xlix\Bundle\Builder\ArrayBuilder;

/**
 * The APC caching class
 * useable methods are:
 * 
 * addToCache(params)
 * getFromCache(param)
 * isAlive(param)
 *
 * @author  Florian Kasper <xlix@khnetworks.com>
 * @see     http://version.xlix.eu
 *
 */
class Manager implements CacheInterface {

    /**
     * configuration ARRAY!!!
     * @var array
     */
    private $config;

    /**
     * Constructor.
     * 
     * @param array $config the configuration handled a class above
     */
    public function __construct($config) {
        $this->config = $config;
    }

    /**
     * Adds data to cache (asking myself if i should encrypt the data with an algorithm)
     * 
     * @param mixed $id string or integer, mostly string
     * @param mixed $value Description
     * 
     * @return boolean
     */
    public function addToCache($id, $value) {
        $builder = new ArrayBuilder();
        $builder->addToArray($id, $id, 'name');
        $builder->addToArray($id, time(), 'mtime');
        $builder->addToArray($id, base64_encode(json_encode($value)), 'value');
        return apc_store($id, $builder->getArray($id));
    }

    /**
     * checks if a key is in cache
     * 
     * @param mixed $id string or integer, mostly string
     * 
     * @return boolean 
     */
    public function isExisting($id) {
        return apc_exists($id);
    }
    /**
     * gets content from cache
     * 
     * @param mixed $id string or integer, mostly string
     * 
     * @return mixed
     */
    public function getFromCache($id) {
        if (!$this->isExisting($id)) {
            return 0;
        }
        if (!$this->isAlive($id)) {
            return 0;
        }
        $fetch = apc_fetch($id);
        return json_decode(base64_decode($fetch['value']), true);
    }
    /**
     * checks if a key is valid
     * 
     * @param mixed $id string or integer, mostly string
     * 
     * @return integer
     */
    public function isAlive($id) {
        if (!$this->isExisting($id)) {
            return 0;
        }
        $fetch = apc_fetch($id);
        if ($fetch['mtime'] + $this->config['keep'] > time()) {
            return 1;
        }
        return 0;
    }

}

?>
