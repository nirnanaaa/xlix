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

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Route;

class OfwnGateway {

    public function handleRequest(Event $event, $router) {
        //echo "bla";
        $request = $event->getRequest();
        $ofwnize = new OfwnInit();
        $info = $ofwnize->test();
        // create a new route; other arguments would be an
        // array containing requirements and an array with options
        print_r($info);
        foreach ($info as $routes) {

            
            $route = new Route($routes['match'], array(
                        '_controller' => $routes['controller'],
                    ));

            $router->getRouteCollection()->add($routes['name'], $route);
        }
        //$request->attributes->add(array('_controller' => $info['class'] . "::" . $info['method']));
    }

    public function disableDefaultRouter() {
        
    }

}