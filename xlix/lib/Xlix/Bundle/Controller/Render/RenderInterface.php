<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Controller\Render;

/**
 * an interface for language renders
 * supported languages:
 * -YAML
 * -PHP
 * -JSON
 * -XML
 *
 * @author  Florian Kasper <xlix@khnetworks.com>
 * @see     http://version.xlix.eu
 *
 */
interface RenderInterface {

    /**
     * renders the name of the language
     */
    public function renderLang();
    /**
     * @param mixed $data the data to render
     */
    public function render($data);
}

?>
