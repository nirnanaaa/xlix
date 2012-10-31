<?php

namespace XLix\Plugin\Corscience;

use Xlix\Bundle\Plugin\Interfaces\PluginParentInterface;
use Xlix\Plugin\Corscience\Twig\Extone;

class Loader implements PluginParentInterface {
    protected $_loaderPlugins = array();
    public function __construct() {
       $this->_loaderPlugins = array(
          "twig_extone" => new Extone(),
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
        return dirname(__FILE__) . '/Config/Corscience.yml';
    }

    public function getDescription() {
        return null;
    }

    public function boot() {
        return $this;
    }

}