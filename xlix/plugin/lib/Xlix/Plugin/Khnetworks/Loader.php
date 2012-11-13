<?php

namespace Xlix\Plugin\Khnetworks;

use Xlix\Bundle\Plugin\Interfaces\PluginParentInterface;
use Xlix\Plugin\Khnetworks\Entity\Log;
class Loader implements PluginParentInterface {
    protected $_loaderPlugins = array();
    public function __construct() {
       $this->_loaderPlugins = array(
          "log" => new Log(),
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
        return dirname(__FILE__) . '/Config/Khnetworks.yml';
    }

    public function getDescription() {
        return null;
    }

    public function boot() {
        
    }

}