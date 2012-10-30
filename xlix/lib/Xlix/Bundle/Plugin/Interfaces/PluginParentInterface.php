<?php

namespace Xlix\Bundle\Plugin\Interfaces;

interface PluginParentInterface {

    public function getVersion();

    public function getRequirements();

    public function getConfigLocation();

    public function getDescription();

    public function boot();
}