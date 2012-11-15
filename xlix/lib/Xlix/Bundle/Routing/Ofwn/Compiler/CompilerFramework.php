<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Routing\Ofwn\Compiler;

/**
 * The main compiler class -> calls the single compilers
 *
 * The methods are useable for initd are:
 * 
 * compile:     compiles the route
 *
 * @author  Florian Kasper <xlix@khnetworks.com>
 * @see     http://version.xlix.eu
 *
 */
class CompilerFramework {
    /**
     * use only public variables for the various "compilers"
     */

    /**
     * @var \Xlix\Bundle\Routing\Ofwn\OfwnUtils
     */
    public $utils;

    /**
     * @var Architecture
     */
    public $arch;

    /**
     * @var CacheManager
     */
    public $manager;

    /**
     * Constructor.
     * 
     * @param CacheManager $manager The Cache Manager
     * @param OfwnUtils    $utils   Some Utils(Request)
     * @param Architecture $arch    Enviroment specific variables
     */
    public function __construct(CacheManager $manager, \Xlix\Bundle\Routing\Ofwn\OfwnUtils $utils, Architecture $arch) {
        $this->bootUp($manager, $utils, $arch);
    }

    /**
     * just assign some variables to publics in the class
     * 
     * @param CacheManager $manager The Cache Manager
     * @param OfwnUtils    $utils   Some Utils(Request)
     * @param Architecture $arch    Enviroment specific variables
     * 
     * @return CompilerFramework
     */
    public function bootUp($manager, $utils, $arch) {
        $this->manager = $manager;
        $this->utils = $utils;
        $this->arch = $arch;
        return $this;
    }

    /**
     * gets the cache from the cacheManager
     * 
     * @return array
     */
    public function getRoutingData() {

        return $this->manager->getCache();
    }

    /**
     * gets the matcher utils if necessary
     * 
     * @return RouteMatcher
     */
    public function getMatcher() {
        return new RouteMatcher();
    }

    /**
     * gets the linker if necessary
     * 
     * @return RouteLinker
     */
    public function getLinker() {
        return new RouteLinker();
    }

    /**
     * gets the Arithmethical unit if necessary
     * 
     * @return RouteALU
     */
    public function getALU() {
        return new RouteALU();
    }

    /**
     * calls the other functions based on the "depth" method
     * 
     * @param string $method    shows the compile depth
     */
    public function compile($method = Architecture::METH_FULL) {
        $routingStuff = $this->getRoutingData();
        if ($method == Architecture::METH_FULL) {
            return $this->seperateRoutingData($routingStuff);
        }
    }

    /**
     * iterates through routes and find the first match
     * @param array $routingData    the routing table-array
     * 
     */
    public function seperateRoutingData($routingData) {
        $matcher = $this->getMatcher();
        $linker = $this->getLinker();
        $alu = $this->getALU();
        foreach ($routingData as $routes) {
            switch ($routes['type']) {
                case 1:
                    if ($route = $this->arch->getStatic()->compileData($routes, $matcher, $linker, $alu, $this->utils)) {
                        return $linker->linkRoute($route);
                        break;
                    }
                    break;
                case 2:
                    if ($this->arch->getDynamic()->compileData($routes, $matcher, $linker, $alu, $this->utils))
                        break;
                    break;
            }
        }
    }

    public function useController($controller) {
        
    }

}

?>
