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

use Xlix\Bundle\Routing\Ofwn\Parser\RoutingTables;
use Xlix\Bundle\Routing\Ofwn\OfwnUtils;
use Xlix\Bundle\Routing\Ofwn\Compiler\ConfigManager;
use Xlix\Bundle\Routing\Ofwn\Compiler\CacheManager;

/**
 * Call a controller based route
 *
 * The methods are useable for enduser are:
 * 
 * callCompiler :   further callController or callAction
 *                  move to __call!!
 *
 * @author  Florian Kasper <xlix@khnetworks.com>
 * @see     http://version.xlix.eu
 *
 */
class OfwnInit {

    /**
     * @var \Xlix\Bundle\Routing\Ofwn\Parser\RoutingTable The basic route parser
     * @deprecated since version 0x02
     */
    public $routingTables;

    /**
     * @var \Xlix\BundleRouting\Ofwn\OfwnUtils utilities
     */
    public $ofwnUtils;

    /**
     * @var \Xlix\BundleRouting\Ofwn\Compiler\CompilerBasic basic compiler
     * @ignore
     */
    public $ofwnCompiler;

    /**
     * @var array routes
     * @deprecated since version 0x02
     */
    public $routes;

    /**
     * Constructor.
     *
     * @param array  $options      The options
     * @todo move fetchRoutes out because it's deprecated
     */
    public function __construct($options = array()) {
        $this->routingTables = new RoutingTables();
        $this->ofwnUtils = new OfwnUtils();
        $this->fetchRoutes();
        //  $this->ofwnCompiler = new Compiler;
    }

    /**
     * RouteFile fetcher
     */
    public function fetchRoutes() {
        $this->routes = $this->routingTables->getOfwns();
    }

    /**
     * compiler call
     * @todo move to callOfwnCompiler and handle it with my own response
     * @deprecated since version 0x02
     */
    public function callCompiler() {
        $cpinit = new CacheManager(new ConfigManager());
        $compilerExec = new Compiler\CompilerFramework($cpinit, $this->ofwnUtils, new Compiler\Architecture());
        $compilerExec->compile();
    }

    private function callSymfonyCompiler() {
        $this->callCompiler();
    }

    /**
     * NYI WOI
     */
    private function callFOSCompiler() {
        
    }

    /**
     * NYI
     */
    private function callOfwnCompiler() {
        
    }

    /**
     * calls the compiler or other functions.
     * 
     * if there is no useable method it will throw an Exception
     * 
     * @param string $arch The compiler Architecture e.g Ofwn
     * @param array $params Parameters used by the function
     * 
     * @return Response
     */
    public function __call($arch, $params = null) {
        if (preg_match("#^call(Ofwn|Symfony|Fos)Com#i", $arch)) {
            switch (strtolower($arch)):
                case 'ofwn':
                    $this->callOfwnCompiler();
                    break;
                case 'fos':
                    $this->callFOSCompiler();
                    break;
                case 'symfony':
                    $this->callSymfonyCompiler();
                    break;

            endswitch;
        } else {
            throw new Compiler\Exception\InvalidCompilerOptionException("call not known");
        }
        if (is_null($params)) {
            throw new Compiler\Exception\InvalidCompilerOptionException("no or too few parameters provided");
        }
    }

}