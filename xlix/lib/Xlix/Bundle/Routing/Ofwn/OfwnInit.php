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

//use Xlix\Bundle\Routing\Ofwn\Parser\RoutingTables;
use Xlix\Bundle\Routing\Ofwn\OfwnUtils;

//use Xlix\Bundle\Routing\Ofwn\Compiler\ConfigManager;
//use Xlix\Bundle\Routing\Ofwn\Compiler\CacheManager;

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
     * Constructor.
     *
     * @param array  $options      The options
     * @todo move fetchRoutes out because it's deprecated
     */
    private $utils;
    private $zeroDay;
    private $request;

    public function __construct($request, $options = array()) {
        if (!empty($options) && array_key_exists("utils", $options)) {
            $this->utils = new $options["utils"];
        } else {
            $this->utils = new OfwnUtils();
        }
        $this->request = $request;
        $this->zeroDay = new ZeroDayReader($this->utils->configManager);
    }

    public function getRouteByCurrentUri() {
        $uri = $this->utils->getRequestUri();
        $tables = $this->zeroDay->getAllRouteFiles();
        foreach ($tables['route'] as $routes) {
            if (array_key_exists('prefix', $routes)) {
                if ($routes['prefix'] === "none") {
                    if ($routes['route'] ==
                            $this->getCuttedRequestUri()) {
                        return $routes;
                    }
                }
            } else {
                // if ($routes['prefix'] !== "none") {
                if ($tables['override']['prefix'] . $routes['route'] ==
                        $this->getCuttedRequestUri()) {
                    return $routes;
                    //   }
                }
            }
            // print_r($this->getCuttedRequestUri());
        }
        return null;
        // echo $uri;
    }

    public function getCuttedRequestUri() {
        $Curi = explode("?", $this->request->getRequestUri());
        return preg_replace("#\/(.*?)\/#", "/", $Curi[0]);
    }

    public function isAllowedMethod($method) {
        $allowed = $this->utils->config->options['request']['allowed_methods'];
        if(in_array(strtoupper($method), $allowed)){
            return true;
        }else{
            return false;
        }
    }

}