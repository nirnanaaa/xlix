<?php
namespace Xlix\Bundle\Twig;

<<<<<<< HEAD
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
=======
class GlobalVariableExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'price' => new \Twig_Filter_Method($this, 'priceFilter'),
        );
    }

    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$' . $price;

>>>>>>> 644d210cc30c8ace9afe02f7f08bb576b1634756
        return $price;
    }

    public function getName()
    {
<<<<<<< HEAD
        return 'global';
    }
}
=======
        return 'acme_extension';
    }
}
>>>>>>> 644d210cc30c8ace9afe02f7f08bb576b1634756
