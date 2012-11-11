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

class Architecture {

    const ARCH_CRS = 'cross';
    const ARCH_PRO = 'prod';
    const ARCH_DEV = 'dev';
    const METH_FULL = 'full';

    public function getDynamic() {
        return new RouteDynamicCompiler();
    }

    public function getStatic() {
        return new RouteStaticCompiler();
    }


}

?>
