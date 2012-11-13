<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Controller\Render\Yaml;

use Xlix\Bundle\Parser\Yaml\YamlEncoder;

/**
 * Language Reference for:
 * ****YAML****
 *
 * @author  Florian Kasper <xlix@khnetworks.com>
 * @see     http://version.xlix.eu
 *
 */
class Render implements \Xlix\Bundle\Controller\Render\RenderInterface {

    /**
     * renders the requested value into a YAML string
     * @param mixed $data Input Data
     * @return string
     */
    public function render($data) {
        $yamlEncoder = new YamlEncoder();
        return $yamlEncoder->encode($data);
    }

    public function renderLang() {
        return sprintf("YAML");
    }

}

?>
