<?php

namespace Xlix\Bundle\Loader;

class FileLoader {

    public function loadLocalFile($file) {
        return file_get_contents($file);
    }

    public function loadXlixFile($file) {
        return file_get_contents(dirname(__FILE__) . '/../' . $file);
    }

    public function loadFileRootRelative() {
        
    }

}