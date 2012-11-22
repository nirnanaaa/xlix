<?php

use Xlix\Bundle\File\Download;

class Filetest extends \PHPUnit_Framework_TestCase {

    public function testFilenameRestrictionswithoutSpaces() {
        $enc = new Download("composer.json");
        $delete = $enc->checkNameForIlegal("DasIstEinTestOhneSonderZeichen");      
        $this->assertTrue(TRUE,$delete);
    }
    public function testFilenameRestrictionswithIllegalChars() {
        $enc = new Download("composer.json");
        $delete = $enc->checkNameForIlegal("ä8g09ßa€đ¶ŋ\\ŋ ^_@012931230789278902870270892079850987235789ßz23hun ipgh0 hu5uw hb    <<<>>>><<||||´`ß");      
        $this->assertTrue(TRUE,$delete);
    }
}