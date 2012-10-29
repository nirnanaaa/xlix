<?php

namespace Xlix\Bundle\File;

use Xlix\Bundle\File\Exception\InvalidFileProvidedException;
use Xlix\Bundle\File\Exception\FileNotFoundException;

class Download {

    protected $_location;

    public function __construct($init) {
        $filename = end(explode("/", $init));
        if (!is_string($init)) {
            throw new InvalidFileProvidedException("init must be a String!");
        }
        if (!file_exists($init)) {
            throw new FileNotFoundException("the init file was not found in the system!");
        }
        if (!$this->checkNameForIlegal($filename)) {
            throw new InvalidFileProvidedException("The filename you've entered is not a valid filename");
        }
        $this->_location = $init;
    }

    public function getFile($contentType, $filename) {
        $mtime = ($mtime = filemtime($this->_location)) ? $mtime : gmtime();
        $size = filesize($this->_location);
        header('Content-Description: File Transfer');
        @apache_setenv('no-gzip', 1);
        @ini_set('zlib.output_compression', 0);
        header('Content-Type: ' . $contentType);
        header('Content-lenght: ' . $size);
        if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE") != false) {
            header("Content-Disposition: attachment; filename=" . urlencode($filename) . '; modification-date="' . date('r', $mtime) . '";');
        } else {
            header("Content-Disposition: attachment; filename=\"" . $filename . '"; modification-date="' . date('r', $mtime) . '";');
        }
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');

        set_time_limit(0);

        ob_flush();
        flush();
        readfile($this->_location);

        return true;
    }

    public function checkNameForIlegal($name) {
        if (preg_match('/(ä|ü|ö|\\|\0|\ )/i', $name)) {
            return false;
        }
        return true;
    }

}

?>
