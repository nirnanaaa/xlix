<?php

namespace Xlix\Bundle\Crawler\Curl;

class Header {

    private $intl;
    private $headers;

    public function __construct($intl) {
        $this->intl = $intl;
    }

    public function getLocation($link) {
        $headers = $this->intl->initGet($link)->header->getOnlyHeaders();
        $this->headers = $this->crawlHeaderLines($headers);
        $helper = $this->iterateHelper("(L|l)ocation");
        return $helper[2];
    }

    public function getStatusCode() {
        preg_match('#^HTTP\/1\.(0|1)\s(.*)\s#i', $this->headers[0], $match);
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

    public function getSize($link) {
        $headers = $this->intl->initGet($link)->header->getOnlyHeaders();
        $this->headers = $this->crawlHeaderLines($headers);
        $helper = $this->iterateHelper("(C|c)ontent\-(L|l)ength");
        return $helper[3];
    }

    public function getServer($link) {
        $headers = $this->intl->initGet($link)->header->getOnlyHeaders();
        $this->headers = $this->crawlHeaderLines($headers);
        $helper = $this->iterateHelper("(S|s)erver");
        return $helper[2];
    }

    public function getDate($link) {
        $headers = $this->intl->initGet($link)->header->getOnlyHeaders();
        $this->headers = $this->crawlHeaderLines($headers);
        $helper = $this->iterateHelper("(D|d)ate");
        return strtotime($helper[2]);
    }

    public function getCacheControl() {
        
    }

    public function iterateHelper($search) {
        foreach ($this->headers as $header) {
            if (preg_match("#^{$search}:\s(.*)$#", $header, $match)) {
                return $match;
            }
        }
    }

    public function getConnectionState($link) {
        $headers = $this->intl->initGet($link)->header->getOnlyHeaders();
        $this->headers = $this->crawlHeaderLines($headers);
        $helper = $this->iterateHelper("(C|c)onnection");
        return $helper[2];
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