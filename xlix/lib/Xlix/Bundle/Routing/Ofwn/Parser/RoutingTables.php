<?php

namespace Xlix\Bundle\Routing\Ofwn\Parser;

//use Xlix\Bundle\Routing\Ofwn\Compiler\RouteCompiler;

class RoutingTables {

    protected $_tabledir;

    public function __construct($dir = null) {
        //$this->compiler = new RouteCompiler;
        $this->setTableDir((is_null($dir)) ? 'Table/Router/' : $dir);
    }

    public function setTableDir($directory) {
        if (is_array($directory)) {
            if (!array_key_exists('internal', $directory)) {
                //throw exception unknown;
            }
        }
        if (is_string($directory) && is_dir(__DIR__ . '/../../' . $directory)) {
            $this->_tabledir = __DIR__ . '/../../' . $directory;
        }
    }

    public function getOfwns() {
        return array_merge($this->getExternalOfwns(),$this->getInternalOfwns());
    }

    public function getInternalOfwns() {
        return $this->parseRoutes($this->readBaseDirFiles("internal"));
    }

    public function getExternalOfwns() {

        return $this->parseRoutes($this->readBaseDirFiles("external"));
    }

    public function parseRoutes($routes) {
        $rid = 0;
        $fid = 0;
        $route = array();
        foreach ($routes as $file) {
            $route[$fid]['type'] = $file[0]; 
            $routeStarted = false;
            foreach ($file as $line) {
                if (preg_match("#^\#\-RouteStart$#i", trim($line))) {
                    $routeStarted = true;
                    continue;
                }
                if (preg_match("#^\#\-RouteEnd$#i", trim($line))) {
                    $routeStarted = false;
                    $rid++;
                    continue;
                }
                if ($routeStarted) {
                    $route[$fid][$rid][] = $line;
                }
            }
            $fid++;
        }
        return $route;
    }

    public function parseType($tline) {
        switch (trim(strtolower($tline))) {
            case '#-static':
                return 1;
                break;
            case '#-dynamic':
                return 2;
                break;
            case '#-mixed':
                return 3;
                break;
            case '#-redirect' :
                return 4;
                break;
            default:
                return 99;
        }
    }

    public function readBaseDirFiles($dir) {
        $files = array();
        $dir = $this->_tabledir . '/' . $dir;
        if ($externalDir = opendir($dir)) {
            while (false !== ($entry = readdir($externalDir))) {
                if (!preg_match("#^(\.|\..|\.php)$#", $entry)) {
                    $files[] = $this->readFileLines($dir . "/" . $entry);
                }
            }
        }

        return $files;
    }
    public function readFileLines($file) {
        $fileHandle = fopen($file, "rb");
        $lines = array();
        while (!feof($fileHandle)) {
            $lines[] = fgets($fileHandle);
        }
        $lines[0] = $this->parseType($lines[0]);
        return $lines;
    }

}