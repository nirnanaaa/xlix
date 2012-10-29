<?php

namespace Xlix\Bundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class XlixBundle extends Bundle {

    public function getVersion() {
        return 0x0001a;
    }

    public function getMyName() {
        return "XLIX - CMS Bundle for Symfony2";
    }

    public function getDescription() {
        return "a Content Management System, wich can be used as a symfony2 vendor!";
    }

}

?>
