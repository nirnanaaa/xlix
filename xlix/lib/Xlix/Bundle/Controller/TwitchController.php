<?php

namespace Xlix\Bundle\Controller;

use Xlix\Bundle\Controller\ControllerOverride;
use Symfony\Component\HttpFoundation\Response;

class TwitchController  extends ControllerOverride {

    public function callbackAction() {
        print_r($_GET);
        print_r($_POST);
        return new Response;
    }

}