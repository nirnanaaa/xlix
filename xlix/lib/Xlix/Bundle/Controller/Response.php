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

class Response {

    public $headers;
    public $get;
    public $post;
    public $put;
    public $file;
    public $server;
    private $data;
    private $status;

    public function __construct($data = null, $status = null) {
        $this->headers = new Headers();
        $this->get = new Get();
        $this->put = new Put();
        $this->post = new Post();
        $this->file = new File();
        $this->server = new Server();
        if (!is_null($data)) {
            $this->data = $data;
        }
        if (!is_null($status)) {
            $this->status = $status;
        }
        $this->spinUp();
    }

    public function spinUp() {
        
    }

}

?>
