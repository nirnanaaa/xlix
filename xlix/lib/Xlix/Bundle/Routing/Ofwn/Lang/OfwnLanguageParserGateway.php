<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Routing\Ofwn\Lang;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event; //UU
use Xlix\Bundle\Config\ConfigManager;
use Xlix\Bundle\Builder\ArrayBuilder;

/**
 * Call a controller based route
 *
 * Normally the user uses the following functions:
 * 
 * __construct(params)
 * and
 * routeParser()
 *
 * @author  Florian Kasper <xlix@khnetworks.com>
 * @see     http://version.xlix.eu
 *
 */
class OfwnLanguageParserGateway {

    /**
     * the file array
     * @var array
     */
    private $fileList;

    /**
     * event dispatcher UU
     * @var \Symfony\Component\EventDispatcher\EventDispatcher
     */
    private $dispatcher;

    /**
     * config class
     * @var \Xlix\Bundle\Config\ConfigManager
     */
    private $config;

    /**
     * constants are here
     * array of "Constants" classes
     * 
     * @var array
     */
    private $constants;

    /**
     * reference's are here
     * array of "Reference" classes
     * 
     * @var array
     */
    private $reference;

    /**
     * Constructor.
     * 
     * @param array         $fileList The RAW routing table as array (1 ele for each file)
     * @param ConfigManager $config   The configuration holder class
     * 
     */
    public function __construct($fileList, ConfigManager $config) {
        $this->fileList = $fileList;
        $this->dispatcher = new EventDispatcher();
        $this->config = $config;
        $this->getConstants($config->getConfig());
        $this->getReference($config->getConfig());
    }

    /**
     * Calls the specific parser functions which are parsing the RAW content
     * 
     * @return array
     */
    public function routeParser() {
         
        $cacheClass = $this->config->getConfig()->options['cache']['class'];
        $cacheManager = new $cacheClass($this->config);
        if ($cacheManager->isExisting('LanguageParserGatewaynn') == 1 &&
                $ref = $cacheManager->getFromCache('LanguageParserGatewaynn')) { 
        } else {
            $referenceMatcher = new Reference\ReferenceMatcher();
            $arrayBuilder = new ArrayBuilder();
            foreach ($this->constants as $name => $const) {
                $match = $referenceMatcher->getMatch($this->fileList, $const);
         
                $arrayBuilder->addToArray($this->config->getConfig()->ofwn['mapping']['reference'], $this->reference[$name]->parseContent($match), strtolower($name));
            }

            $ref = $arrayBuilder->getArray($this->config->getConfig()->ofwn['mapping']['reference']);
            $cacheManager->addToCache('LanguageParserGatewaynn', $ref);
        }
        return $ref;
        //return();
    }

    /**
     * includes all constant files to $this->constants
     * 
     * @param  ConfigManger     $config     the config manager class
     * 
     * @return void
     */
    private function getConstants($config) {
        foreach ($config->ofwn['reference'] as $ref) {
            $constantsBuilder = "{$config->ofwn['location']}\\{$ref}\\{$ref}{$config->ofwn['mapping']['constants']}";
            if (class_exists($constantsBuilder)) {
                $this->constants[$ref] = new $constantsBuilder;
            } else {
                $this->constants[$ref] = null;
            }
        }
    }

    /**
     * includes all reference files to $this->reference
     * 
     * @param  ConfigManger     $config     the config manager class
     * 
     * @return void
     */
    private function getReference($config) {
        foreach ($config->ofwn['reference'] as $ref) {
            $refBuilder = "{$config->ofwn['location']}\\{$ref}\\{$ref}{$config->ofwn['mapping']['reference']}";
            if (class_exists($refBuilder)) {
                $this->reference[$ref] = new $refBuilder;
            } else {
                $this->reference[$ref] = null;
            }
        }
    }

}
