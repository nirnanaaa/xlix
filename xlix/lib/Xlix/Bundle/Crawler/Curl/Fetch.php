<?php

namespace Xlix\Bundle\Crawler\Curl;

use Xlix\Bundle\Crawler\JDownloader;

class Fetch {

    public $curl;
    public $_url;
    private $_link;
    private $_keys;
    private $_links;
    public $browser;
    public $header;

    public function __construct() {
        set_time_limit(0);
        $this->curl = curl_init();
        $fp = fopen(dirname(__FILE__) . "/cookie.txt", "a");
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($this->curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . "/cookie.txt");
        curl_setopt($this->curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . "/cookie.txt");
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($this->curl, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, 0);
        $this->browser = new Browser($this->curl);
        $this->header = new Header($this);
    }

    public function __destruct() {
        if (gettype($this->curl) == 'resource')
            curl_close($this->curl);
    }



    public function getHttpStatusLine() {
        $header = $this->crawlHeaderLines();
        return $header[0];
    }

    public function crawlLinkExists($key) {
        if (!array_key_exists($key, $this->_keys)) {
            $this->_keys[$key] = true;
            return false;
        } else {
            return true;
        }
    }

    public function sendArrayToJDownloader($array, $host = "10.12.0.26", $port = "10025") {
        $jDownloader = new JDownloader($host, $port);
        foreach ($array as $element) {
            $jDownloader->addDownloadLink($element)->ask();
        }
        return "links successfully sent to JD's home";
    }



    public function crawlLocation() {
        foreach (preg_split("/((\r?\n)|(\r\n?))/", $this->_url) as $line) {
            if (preg_match('/location: (http|www)\S+/i', $line, $matches)) {
                $location = $matches[0];
            }
        }
        $loc = explode(" ", $location);
        return $loc[1];
    }



    public function crawlAllLinks() {
        $dom = new \DOMDocument();
        @$dom->loadHTML($this->_url);
        $aLinks = array();
        $url = parse_url($this->_link);
        foreach ($dom->getElementsByTagName('a') as $link) {
            $attr = $link->getAttribute('href');
            if (!$this->crawlLinkExists($attr)) {
                if (!strstr($attr, "http")) {
                    if (!preg_match("/(#|javascript)/i", $attr)) {
                        $aLinks[] = $url['scheme'] . "://" . $url['host'] . $attr;
                    }
                } else {
                    if (!preg_match("/(#|javascript)/i", $attr)) {
                        $aLinks[] = $attr;
                    }
                }
            }
        }
        return $aLinks;
    }

    public function crawl() {
        ob_start();
        if (($exec = curl_exec($this->curl)) === false) {
            $exec = curl_error($this->curl);
        }
        ob_end_clean();
        $this->_url = $exec;
        return $exec;
    }

    public function crawlIntoFile($file) {
        $size = $this->getFileSize();
        $fsz = 0;
        $file = fopen($file, 'w');
        while ($fsz <= $size) {
            $max = $fsz + 1000000;
            curl_setopt($this->curl, CURLOPT_RANGE, "{$fsz}-{$max}");
            curl_setopt($this->curl, CURLOPT_FILE, $file);
            curl_exec($this->curl);
            $fsz = $fsz + 1000000;
        }
        fclose($file);
    }

    public function getFileSize() {
        curl_setopt($this->curl, CURLOPT_NOBODY, true);
        curl_setopt($this->curl, CURLOPT_HEADER, true);
        $data = curl_exec($this->curl);
        if ($data === false) {
            echo 'cURL failed';
            exit;
        }
        if (preg_match('/Content-Length: (\d+)/', $data, $matches)) {
            $contentLength = (int) $matches[1];
        }
        curl_setopt($this->curl, CURLOPT_NOBODY, false);
        curl_setopt($this->curl, CURLOPT_HEADER, false);
        return $contentLength;
    }

    public function setUserAgent($agent) {
        curl_setopt($this->curl, CURLOPT_USERAGENT, $agent);
    }

    public function initGet($url) {
        $this->_link = $url;
        curl_setopt($this->curl, CURLOPT_URL, $url);
        return $this;
    }

    public function initPut() {
        
    }

    public function initOptions() {
        
    }

    public function initPost($url, $data) {
        $this->_link = $url;
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_POST, 1);
        if (empty($data) || !is_array($data)) {
            //throw exception InvalidArgumentProvided must be array
        }
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
        return $this;
    }

}