<?php

namespace Xlix\Plugin\Shades;

use Xlix\Bundle\Plugin\Interfaces\PluginParentInterface;
use Xlix\Plugin\Shades\Translate\ConstConversion;

class Loader implements PluginParentInterface {
    protected $_loaderPlugins = array();
    public function __construct() {
       $this->_loaderPlugins = array(
          "conversion" => new ConstConversion(),
       );
    }

    public function getVersion() {
        return 0x01;
    }

    public function getRequirements() {
        return null;
    }

    public function getEmbeddedPlugin($plugin) {
        return $this->_loaderPlugins[$plugin];
    }

    public function getConfigLocation() {
        return dirname(__FILE__) . '/Config/Shades.yml';
    }

    public function getDescription() {
        return null;
    }

    public function boot() {
        
    }

}