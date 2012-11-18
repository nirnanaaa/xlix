<?php

namespace Xlix\Bundle\Routing\Ofwn;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;

class OfwnGateway {

    public function handleRequest(Event $event, $router) {
        $request = $event->getRequest();
        $ofwnize = new OfwnInit($request);
        $info = $ofwnize->getRouteByCurrentUri();
        // print_r($info);
        if ($info['controller']) {
            if ($info['type'] == "rest") {
               $method = strtolower($request->getMethod());
               if($ofwnize->isAllowedMethod($method)){
                   $request->attributes->set('_controller', $info['controller'].':'.$method);
               }else{
                   $request->attributes->set('_controller', $info['controller'].':get');
               }
                
            } else {
                if ($info['action']) {
                    $request->attributes->set('_controller', $info['controller'].':'.$info['action']);
                }
            }
        } else {
            $request->attributes->set('_controller', 'HomepageDefaultBundle:Blog:index');
        }
    }

    public function disableDefaultRouter() {
        
    }

}