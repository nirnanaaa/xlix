<?php

namespace Xlix\Bundle\Twig;

class DumpValue extends \Twig_Extension {

    public function getFunctions() {
        return array(
            'printr' => new \Twig_Function_Method($this, 'printr'),
        );
    }

    public function printr($array) {
        return print_r($array, true);
    }

    public function getName() {
        return 'dumpValue';
    }

}