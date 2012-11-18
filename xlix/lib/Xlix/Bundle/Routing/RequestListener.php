<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Routing;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RequestListener {

    protected $container;
    private $logger;
    private $router;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
        $this->logger = $this->container->get('logger');
        $this->router = $this->container->get('router');
    }

    public function onKernelRequest(GetResponseEvent $event) {
        //$logger = $event->
        $dispatcher = $event->getDispatcher();
        $ofwnGateway = new Ofwn\OfwnGateway();
        if (HttpKernelInterface::MASTER_REQUEST === $event->getRequestType()) {
            $ofwnGateway->handleRequest($event,$this->router);  
           // $dispatcher->addListener('kernel.request', array($ofwnGateway, 'handleRequest'), 999);
        }
    }

    public function routeInit(Event $event) {
        $request = $event->getRequest();
        $request->attributes->add(array('_controller' => "Homepage\\DefaultBundle\\Controller\\BlogController::indexAction"));
    }

}

?>
