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

use Xlix\Bundle\Config\ConfigManager;

/**
 * @author  Florian Kasper <xlix@khnetworks.com>
 * @see     http://version.xlix.eu
 *
 */
class ZeroDayReader {

    private $config;

    public function __construct(ConfigManager $config) {
        $this->config = $config;
    }

}