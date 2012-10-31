<?php

namespace Xlix\Bundle\Plugin;

use Xlix\Bundle\Plugin\Interfaces\PluginLoaderInterface;
use Xlix\Bundle\Parser\Yaml\YamlParser;

class Loader implements PluginLoaderInterface {

    protected $_plugins = array();

    public function getPluginConfig($plugin) {

        $class = $this->loadPlugin($plugin);

        $parser = new YamlParser();
        return $parser->parseConfig($class->getConfigLocation());
    }

    public function getPluginDeps($plugin) {
        $class = $this->loadPlugin($plugin);
        return $class->getRequirements();
    }

    public function getPluginDescr($plugin) {
        $class = $this->loadPlugin($plugin);
        return $class->getDescription();
    }

    public function getPluginVersion($plugin) {
        $class = $this->loadPlugin($plugin);
        return $class->getVersion();
    }

    public function loadPlugin($plugin) {
        $class = "Xlix\\Plugin\\{$plugin}\\Loader";
        if ($this->_plugins[$plugin] instanceof $class) {
            $cLoad = $this->_plugins[$plugin];
        } else {
            if (class_exists($class)) {
                $cLoad = new $class;
                $this->_plugins[$plugin] = $cLoad->boot();
            }
        }
        return $cLoad;
    }

}