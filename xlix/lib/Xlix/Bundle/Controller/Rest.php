<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Controller;

use Xlix\Bundle\Api\Server\Rest\RestController;
use Symfony\Component\HttpFoundation\Response;
use Xlix\Bundle\Parser\Json\JsonParser;

class Rest extends ControllerOverride {

    protected $rest;
    protected $response;

    public function __construct() {
        parent::__construct();
        $this->rest = new RestController();
        $this->response = new Response();
    }

    public function indexAction() {
        
    }

    public function getAction() {
        
    }

    public function postAction() {
        
    }

    public function putAction() {
        
    }

    public function renderResponse($message, $code = 200) {
        $json = new JsonParser();
        $this->response->headers->add(array(
            
            "Content-Type" => "application/json",
            "Content-Lenght" => strlen(sprintf("%s", $message))
        ));
        $this->response->setStatusCode($code);
        return $this->response->setContent($json->encodeJson(array("status" => $code,"message" =>$message)));
    }

}

?>
