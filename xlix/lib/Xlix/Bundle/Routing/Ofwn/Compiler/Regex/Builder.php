<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Routing\Ofwn\Compiler\Regex;

class Builder {

    public $regex;
    private $delimiter = "#";
    private $end;
    private $start;
    private $body;

    public function getRegex() {
        return $this->start . $this->delimiter . $this->body . $this->delimiter . $this->end;
    }

    public function addMaxMinLen($maxlen, $minlen) {
        
    }

    public function addMatchesAlnum() {
        $this->body .= "\w";
        return $this;
    }

    public function addMatchesDigit() {
        $this->body .= "\d";
        return $this;
    }

    public function addPlus() {
        $this->body .= "+";
        return $this;
    }

    public function AmatchesB($a, $b) {
        
    }

    public function addCaseInsensitive() {
        $this->end .= "i";
        return $this;
    }

    public function addFindAll() {
        $this->end .= "g";
        return $this;
    }

    public function addEndWith() {
        $bdy = (array) $this->body;
        array_push($bdy, "$");
        $this->body = implode($bdy);
        return $this;
    }

    public function addStartWith() {
        $bdy = (array) $this->body;
        array_unshift($bdy, "^");
        $this->body = implode($bdy);
        return $this;
    }

    public function replaceWithString($placeholder) {
        return preg_replace("#\{(\w+|\s+)\}#", "\w+", $placeholder);
    }

}

?>
