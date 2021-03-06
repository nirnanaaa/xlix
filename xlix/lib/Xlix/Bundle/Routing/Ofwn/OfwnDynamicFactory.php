<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Routing\Ofwn;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class OfwnDynamicFactory implements LoaderInterface{

    private $loaded = false;

    public function load($resource, $type = null) {
        if (true === $this->loaded) {
            throw new \RuntimeException('Do not add this loader twice');
        }

        $routes = new RouteCollection();

        $pattern = '/extra';
        $defaults = array(
            '_controller' => 'HomepageApiBundle:Broke:authentication',
        );

        $route = new Route($pattern, $defaults);
        $routes->add('extraRoute', $route);

        return $routes;
    }

    public function supports($resource, $type = null) {
        return 'extra' === $type;
    }

    public function getResolver() {
        
    }

    public function setResolver(LoaderResolver $resolver) {
        // irrelevant to us, since we don't need a resolver
    }

}

?>
