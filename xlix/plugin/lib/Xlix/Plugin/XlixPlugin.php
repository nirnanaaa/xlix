<?php

namespace Xlix\Plugin;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class XlixPlugin extends Bundle {

    public function getVersion() {
        return 0x0001a;
    }

    public function getMyName() {
        return "XLIX - Plugin Dir";
    }

    public function getDescription() {
        return "a Content Management System, wich can be used as a symfony2 vendor!";
    }

}

?>
