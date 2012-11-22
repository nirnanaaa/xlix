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

class ReferenceMatcher {

    public function getMatch($text, ConstantsInterface $const) {
        preg_match_all("#{$const->getIdentifier()}(.*?){$const->getEndDelimiter()}#i", $text[0], $matches);
        $combined = array();
        foreach ($matches[1] as $match) {
            if (!empty($match)) {
                $combined[] = str_replace($const->getStartDelimiter(), "", $match);
            }
        }
        return($combined);
    }

}

?>
