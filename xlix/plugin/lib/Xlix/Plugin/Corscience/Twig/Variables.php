<?php

namespace Xlix\Plugin\Corscience\Twig;
use Xlix\Bundle\Parser\Yaml\YamlParser;
class Variables extends \Twig_Extension {

    public function getFunctions() {
        return array(
            'global' => new \Twig_Function_Method($this, 'globals_load'),
        );
    }

    public function globals_load($variable) {
        $parser = new YamlParser();
        $file = $parser->parseConfig(dirname(__FILE__).'/../Config/Globals.yml');
        return $file->globals[$variable];
    }

    public function getName() {
        return 'corscience_globals';
    }

}