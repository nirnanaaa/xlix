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

    public function __construct($options = array()) {
        if (!empty($options) && array_key_exists("utils", $options)) {
            $this->utils = new $options["utils"];
        } else {
            $this->utils = new OfwnUtils();
        }
        $this->zeroDay = new ZeroDayReader($this->utils->configManager);
    }

    public function getRouteByCurrentUri() {
        $uri = $this->utils->getRequestUri();
        $tables = $this->zeroDay->getAllRouteFiles();
        print_r($tables);
       // echo $uri;
    }

    public function test() {
        echo "<pre>";
        echo $this->getRouteByCurrentUri();
        //return $this->utils;
    }

}