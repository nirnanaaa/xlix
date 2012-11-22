<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Config;

use Xlix\Bundle\Parser\Yaml\YamlParser;

class ConfigManager {

    private $file;

    public function __construct($file) {
        $this->file = $file;
    }

    /**
     * Gets the compiler configuration file
     * 
     * @return array
     */
    public function getConfig() {
        $parser = new YamlParser();
        if (!$parser instanceof YamlParser) {
            throw new Exception\ConfigException("Xlix Yaml Extension is necessary for parsing the configuration");
        }
        return $parser->parseXlixRelativeConfig($this->file);
    }

    public function addConfig() {
        
    }

    public function setConfig() {
        
    }

}