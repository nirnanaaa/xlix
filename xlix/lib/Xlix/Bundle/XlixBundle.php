<?php

namespace Xlix\Bundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class XlixBundle extends Bundle {

    public function getVersion() {
        return 0x0001a;
    }

    public function getMyName() {
        return "XLIX - Provider bundle for Symfony2";
    }

    public function getDescription() {
        return "a symfony2 vendor!";
    }
    public function __construct() {
<<<<<<< HEAD
        
=======
        //load your important files here
>>>>>>> 03ea9998d918f7d89f8b7ddee2b2418b7bbc02f1
    }
}

?>
