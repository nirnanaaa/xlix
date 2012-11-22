<?php

namespace Xlix\Bundle\Twig;

use Xlix\Bundle\Parser\Yaml\YamlParser;

class Includes extends \Twig_Extension {

    public function getFunctions() {
        return array(
            'jquery' => new \Twig_Function_Method($this, 'jquery'),
            'jqueryui' => new \Twig_Function_Method($this, 'jqueryui'),
        );
    }


    public function jquery() {
        $parser = new YamlParser();
        return $parser->parseXlixConfig()->global['twig']['jquery'];
    }

    public function jqueryui() {
        $parser = new YamlParser();
        return $parser->parseXlixConfig()->global['twig']['jqueryui'];
    }

    public function getName() {
        return 'includes';
    }

}