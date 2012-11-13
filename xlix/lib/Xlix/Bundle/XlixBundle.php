<?php

namespace Xlix\Bundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class XlixBundle extends Bundle {

    public function getVersion() {
        return 0x0001a;
    }

    public function getMyName() {
        return "XLIX - main";
    }

    public function getDescription() {
        return "an Abstraction Framework currently on top of symfony2";
    }
    public function __construct() {

    }
}

?>
