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
     * NYI
     */
    public function __construct() {
        
    }

}

?>
