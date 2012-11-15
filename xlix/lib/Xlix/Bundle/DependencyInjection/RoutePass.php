<?php

namespace Xlix\Bundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class RoutePass implements CompilerPassInterface {

    public function process(ContainerBuilder $container) {
        //$definition = $container->getDefinition('router.default');
        //print_r($container);
       // $definition->replaceArgument(1, null);
    }

}