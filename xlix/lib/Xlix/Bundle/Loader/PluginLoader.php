<?php
##DEPRECATED
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
       
    }

    public function loadPluginConfig($plugin_name) {

    }

}