<?php

namespace Xlix\Bundle\Routing\Ofwn;

use Xlix\Bundle\Config\ConfigManager;

interface OfwnUtilsInterface {

    public function getConfig();

    public function getRequest();

    public function getResponse();

    public function getCache(ConfigManager $config);
}