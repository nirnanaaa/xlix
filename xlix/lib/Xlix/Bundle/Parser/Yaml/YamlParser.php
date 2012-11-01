<?php

namespace Xlix\Bundle\Parser\Yaml;

use Symfony\Component\Yaml\Parser;
use Xlix\Bundle\Loader\FileLoader;

class YamlParser {

    const XlixConfigFileName = 'XlixConfig.yml';

    public $yaml;

    public function __construct() {
        $this->yaml = new Parser();
    }

    public function parseXlixConfig() {
        $configFile = dirname(__FILE__) . '/../../Config/' . self::XlixConfigFileName;
        $value = $this->parseConfig($configFile);
        return  $value;
    }

    public function parseSymfonyConfig() {
        
    }

    public function parseXlixRelativeConfig($file) {
        $pathManager = new FileLoader();
        $location = $pathManager->loadXlixFile($file);
        return $this->parseString($location);
    }
    public function parseString($string){
        $string = (object) $this->yaml->parse($string);
        
        return $string; 
        
    }
    public function parseConfig($location) {
        return $this->parseString(file_get_contents($location));
    }

}