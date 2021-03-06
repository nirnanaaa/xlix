<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Routing\Ofwn\Lang\Reference;

interface ConstantsInterface {

    const TYPE_BLOCK = "block";
    const TYPE_VAR = "variable";

    public function getIdentifier();

    public function getType();

    public function getOptions();
}

?>
