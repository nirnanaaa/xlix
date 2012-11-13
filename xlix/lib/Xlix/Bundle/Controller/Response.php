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

use Xlix\Bundle\Response\Headers\Headers;
use Xlix\Bundle\Response\Get\Get;
use Xlix\Bundle\Response\Put\Put;
use Xlix\Bundle\Response\File\File;
use Xlix\Bundle\Response\Post\Post;
use Xlix\Bundle\Response\Server\Server;

//extends DepencyContainer(stored in apc/cache?)
class Response {

    public $headers;
    public $get;
    public $post;
    public $put;
    public $file;
    public $server;
    private $_data;
    private $_status;
    private $_header;
    private $_body;

    public function __construct($data = null, $status = null) {
        $this->headers = new Headers();
        $this->get = new Get();
        $this->put = new Put();
        $this->post = new Post();
        $this->file = new File();
        $this->server = new Server();
        if (!is_null($data)) {
            $this->_data = $data;
        }
        if (!is_null($status)) {
            $this->_status = $status;
        }
        $this->spinUp();
    }

    public function spinUp() {
        $this->interCom = new \Xlix\Bundle\Com\InterComFacility();
    }

    public function spinDown() {
        
    }

    public function send() {
        $this->sendHeader();
        $this->sendBody();
    }

    public function sendHeader() {
         $this->interCom->RESsendHeader($this->_header);
    }

    public function sendBody() {
        $this->interCom->RESsendBody($this->_body);
    }

    public function setBody($data) {
        $this->_body = $data;
    }

    public function addBody($data) {
        $this->_body .= $data;
    }

    public function getBody() {
        return sprintf("%s", $this->_body);
    }

    public function handleFromRequest(\Xlix\Bundle\Remote\Request $request) {
        
    }

    public function handleFromOwfn(\Xlix\Bundle\Routing\Ofwn\Compiler\RouteLinker $linker) {
        
    }

}

?>
