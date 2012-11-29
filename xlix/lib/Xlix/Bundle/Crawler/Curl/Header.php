<?php

namespace Xlix\Bundle\Crawler\Curl;

class Header {

    private $intl;
    private $headers;

    public function __construct($intl) {
        $this->intl = $intl;
    }

    public function getLocation() {
        
    }

    public function getStatusCode() {
        preg_match('#HTTP\/1\.(0|1)\s(.*)\s#i', $this->headers[0], $match);
        return $match[2];
    }

    public function wasSuccessfulRequest() {
        
    }

    public function getEncoding() {
        
    }

    public function getEtag() {
        
    }

    public function getPragma() {
        
    }

    public function getServer() {
        
    }

    public function getDate() {
        
    }

    public function getContentType() {
        
    }

    public function getCacheControl() {
        
    }

    public function iterateHelper($search) {
        foreach ($this->headers as $header) {
            echo $header;
            preg_match("#^{$search}\:\ (.*)$#i", $header, $match);
        }
        print_r($match);
        return $match;
    }

    public function getConnectionState($link) {
        $headers = $this->intl->initGet($link)->header->getOnlyHeaders();
        $this->headers = $this->crawlHeaderLines($headers);
        return $this->iterateHelper("Connection");
    }

    public function getOnlyHeaders() {
        ob_start();
        curl_setopt($this->intl->curl, CURLOPT_NOBODY, true);
        curl_setopt($this->intl->curl, CURLOPT_HEADER, true);
        if (($exec = curl_exec($this->intl->curl)) === false) {
            print_r(curl_error($this->intl->curl));
        }
        ob_end_clean();
        $this->intl->_url = $exec;
        curl_setopt($this->intl->curl, CURLOPT_NOBODY, false);
        curl_setopt($this->intl->curl, CURLOPT_HEADER, false);

        return $exec;
    }

    public function getLinkStatus($link) {
        $headers = $this->intl->initGet($link)->header->getOnlyHeaders();
        $this->headers = $this->crawlHeaderLines($headers);
        return $this->getStatusCode();
    }

    public function crawlHeaderLines($header) {
        $loc = array();
        foreach (preg_split("/((\r?\n)|(\r\n?))/", $header) as $line) {
            if (!empty($line)) {
                $loc[] = $line;
            }
        }
        return $loc;
    }

}