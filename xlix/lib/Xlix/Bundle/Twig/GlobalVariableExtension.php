<?php
namespace Xlix\Bundle\Twig;

use Xlix\Bundle\Parser\Yaml\YamlParser;


class GlobalVariableExtension extends \Twig_Extension
{
    public function getFuntions()
    {
        return array(
            'global' => new \Twig_Filter_Function($this, 'globals'),
        );
    }

    public function globals($name)
    {
        $price = ";)";
        return $price;
    }

    public function getName()
    {
        return 'global';
    }
}
