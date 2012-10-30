<?php

namespace Xlix\Bundle\Loader;

use Xlix\Bundle\Parser\Yaml\YamlParser;

class PluginLoader {

    protected $pluginNamespace;
    protected $_instance = array();

    public function __construct() {
        $yaml = new YamlParser;
        $this->pluginNamespace = $yaml->parseXlixConfig()->plugins['namespace'];
    }

    public function LoadPlugin($plugin_name) {
        $class = "{$this->pluginNamespace}\\{$plugin_name}\\Loader";

        if (class_exists($class)) {
            $cLoad = new $class;
            $this->_instance[$plugin_name] = $cLoad;
            return $cLoad;
        }
    }

    public function loadPluginConfig($plugin_name) {
        if (array_key_exists($plugin_name, $this->_instance)) {
            $class = $this->_instance[$plugin_name];
        } else {
            $class = $this->LoadPlugin($plugin_name);
        }
        $parser = new YamlParser();
        return $parser->parseConfig($class->getConfigLocation());
    }

}