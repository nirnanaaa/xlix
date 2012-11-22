<?php

namespace Xlix\Bundle\Api\Server\Rest;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Xlix\Bundle\Api\Server\Rest\RestUtils;

class RestController extends Controller {

    public $response;
    public $utils;

    public function __construct() {
        $this->response = new Response();
        $this->utils = new RestUtils();
        $this->response->headers->set('Content-Type', 'application/json');
    }

    public function renderCode($status) {
        $statuscodes = $this->utils->getConfigOption("responses");
        $this->response->setStatusCode($status, $statuscodes[$status]);
        $this->response->setContent($this->utils->jsonResponse($status . " " .
                        $statuscodes[$status]
                ));
        return $this->response;
    }

}