<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
//use Xlix\Bundle\DependencyInjection\RoutePass;

/**
 * just the init Class of the Xlix package
 *
 * @author  Florian Kasper <xlix@khnetworks.com>
 * @see     http://version.xlix.eu
 *
 */
class XlixBundle extends Bundle {

    /**
     * returns the version number
     * @return int
     */
    public function getVersion() {
        return 0x03a;
    } 

    /**
     * returns the name
     * @return string
     */
    public function getMyName() {
        return "XLIX - main";
    }

    /**
     * returns the description
     * @return string
     */
    public function getDescription() {
        return "an Abstraction Framework currently on top of symfony2";
    }

    /**
     * this is very very important so no one can use a bug in the PHP version to
     * attack your script
     */
    public function __construct() {
      //  header_remove("X-Powered-By");
    }

    public function build(ContainerBuilder $container) {    
        //error_log("bla0");
        //$container->addCompilerPass(new RoutePass());
        parent::build($container);
    }

    public function getNamespace() {
        return __NAMESPACE__;
    }

    public function getPath() {
        return strtr(__DIR__, '\\', '/');
    }

}

?>
