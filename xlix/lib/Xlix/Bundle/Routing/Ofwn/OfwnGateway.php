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

class OfwnGateway {

    public function handleRequest(Event $event) {
       //echo "bla";
        $request = $event->getRequest();
        $ofwnize = new OfwnInit();
        $info = $ofwnize->callCompiler();
        $request->attributes->add(array('_controller' => $info['class']."::".$info['method']));
    }

    public function disableDefaultRouter() {
        
    }

}