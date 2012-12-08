<?php

namespace Xlix\Bundle\Crawler;

use Xlix\Bundle\Crawler\Curl\Fetch;

class JDownloader extends Fetch {

    private $cuMl;
    private $cuBs;

    public function __construct($base, $port) {
        parent::__construct();
        $this->cuBs = $base . ":" . $port;
    }
    public function encodeGet(){
        $this->cuMl = urlencode($this->cuMl);
    }
    public function ask() {
        $this->encodeGet();
        return $this->initGet($this->cuBs . $this->cuMl)->crawl();
    }

    public function getSpeed() {
        $this->cuMl = "/get/speed";
        return $this;
    }

    public function getLinks() {
        $this->cuMl = "/get/downloads/allist";
        return $this;
    }

    public function getIp() {
        $this->cuMl = "/get/ip";
        return $this;
    }

    public function getConfig() {
        $this->cuMl = "/get/config";
        return $this;
    }

    public function getSpeedLimit() {
        $this->cuMl = "/get/speedlimit";
        return $this;
    }

    public function getRcVersion() {
        $this->cuMl = "/get/rcversion";
        return $this;
    }

    public function startDownload() {
        $this->cuMl = "/action/start";
        return $this;
    }

    public function pauseDownload() {
        $this->cuMl = "/action/pause";
        return $this;
    }

    public function stopDownload() {
        $this->cuMl = "/action/stop";
        return $this;
    }

    public function toggleDownload() {
        $this->cuMl = "/action/toggle";
        return $this;
    }

    public function doReconnect() {
        $this->cuMl = "/action/reconnect";
        return $this;
    }

    public function exitJdownloader() {
        $this->cuMl = "/action/shutdown";
        return $this;
    }

    public function restartJdownloader() {
        $this->cuMl = "/action/shutdown";
        return $this;
    }

    public function updateJdownloader() {
        $this->cuMl = "/action/update/force1/";
        return $this;
    }

    public function setMaxSimDownloads($limit) {
        $this->cuMl = "/action/set/download/limit/" . $limit;
        return $this;
    }

    public function setMaxDownloadSpeed($speed) {
        $this->cuMl = "/action/set/download/max/" . $speed;
        return $this;
    }

    public function addDownloadLink($link,$start = 1, $grabber = 0) {
        $this->cuMl = "/action/add/links/grabber".$grabber."/start".$start."/".$link;
        return $this;
    }

    public function saveContainer($loca) {
        $this->cuMl = "/action/save/container/".$loca;
        return $this;
    }

}
