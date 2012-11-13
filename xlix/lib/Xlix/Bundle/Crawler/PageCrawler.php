<?php

namespace Xlix\Bundle\Crawler;

use Xlix\Bundle\Crawler\Curl\Fetch;

class PageCrawler {

    public $crawler;

    public function __construct($page) {
        $this->crawler = new Fetch();
        $this->initPage($page);
    }

    public function initPage($page) {

        return $this;
    }

    public function setCookies($cookies = array()) {
        if(!is_array($cookies) || empty($cookies)){
            // throw exception (InvalidOptionProviededException)
        }
    }

    public function writeCookieFile() {
        
    }

    public function getAllLinks() {
        
    }

}