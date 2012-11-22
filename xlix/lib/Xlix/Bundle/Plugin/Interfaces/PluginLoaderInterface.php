<?php

namespace Xlix\Bundle\Plugin\Interfaces;

interface PluginLoaderInterface {

    public function loadPlugin($plugin);

    public function getPluginConfig($plugin);

    public function getPluginVersion($plugin);

    public function getPluginDeps($plugin);
    
    public function getPluginDescr($plugin);
}