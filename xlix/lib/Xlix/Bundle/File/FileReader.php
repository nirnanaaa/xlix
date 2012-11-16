<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\File;

class FileReader {

    public function readFileRelativeToRootCompressed($filename) {
        $fileContent = trim(file_get_contents($filename));
        $fileContent = preg_replace('/\s\s+/', '', $fileContent);
        return $fileContent;
    }

    public function readFileRelativeToRoot($filename) {
        $lines = array();
        $fileHandle = fopen($filename, "rb");
        while (!feof($fileHandle)) {
            $lines[] = fgets($fileHandle);
        }
        return $lines;
    }

    public function readFileToArray($filename = array()) {
        $filesum = array();
        $fileId = 0;
        foreach($filename as $file){
            $filesum[$fileId] = $file;
            $fileId++;
        }
        return $filesum;
    }

}

?>
