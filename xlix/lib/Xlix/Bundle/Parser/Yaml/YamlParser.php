<?php

namespace Xlix\Bundle\Parser\Yaml;
use Symfony\Component\Yaml\Parser;
class YamlParser {
    const XlixConfigFileName = 'XlixConfig.yml';
    public $yaml;
    
    public function __construct(){
        $this->yaml = new Parser();
    }
    public function parseXlixConfig() {
        $configFile = dirname(__FILE__).'/../../Config/'.self::XlixConfigFileName;
        $value = $this->yaml->parse(file_get_contents($configFile));
        return (object) $value;
    }

    public function parseSymfonyConfig() {
        
    }

}