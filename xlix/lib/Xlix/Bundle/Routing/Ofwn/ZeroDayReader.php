<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Routing\Ofwn;

use Xlix\Bundle\Config\ConfigManager;
use Xlix\Bundle\File\FileReader;
use Xlix\Bundle\Routing\Lang\OfwnLanguageParserGateway;

/**
 * @author  Florian Kasper <xlix@khnetworks.com>
 * @see     http://version.xlix.eu
 *
 */
class ZeroDayReader {

    private $config;

    public function __construct(ConfigManager $config) {
        $this->config = $config;
    }

    public function readFilesInDir() {

        $files = array();
        $configro = $this->config->getConfig();
        $dir = $this->parseValues($configro->options['table']['location']);
        //echo $dir;
        $fileReader = new FileReader();
        if ($externalDir = opendir($dir)) {
            while (false !== ($entry = readdir($externalDir))) {
                if (preg_match("#(\.of)$#", $entry)) {
                    $files[] = $fileReader->readFileRelativeToRootCompressed($dir . "/" . $entry);
                }
            }
        }
        return $files;
    }

    public function getAllRouteFiles() {

        $fileList = $this->readFilesInDir();
        print_r($this->parserGateway($fileList));
    }

    public function parserGateway($fileArrayList) {
        print_r($fileArrayList);
        $parser = new OfwnLanguageParserGateway($fileArrayList);
    }

    public function readContentInFile() {
        
    }

    public function parseValues($percentaged) {

        preg_match_all("#\%(.*?)\%#", $percentaged, $match);
        preg_match_all("#\%\/(.*?)$#", $percentaged, $rest);
        $static = array(
            "%xlix.root%" => __DIR__ . '/../..',
        );
        return str_replace($percentaged, $static[$match[0][0]], $percentaged) . "/" . $rest[1][0];
    }

}