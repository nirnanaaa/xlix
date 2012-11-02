<?php

namespace Xlix\Bundle\Api\Battlenet\Wow;

use Xlix\Bundle\Api\Battlenet\Exception\UnsupportedRegionException;
use Xlix\Bundle\Parser\Yaml\YamlParser;
use Xlix\Bundle\Parser\Json\JsonParser;

class BUtils {

    public $region;
    public $locale;
    private $config;
    public $base;
    public $urlscheme;
    public $parser;

    public function __construct($region = 'eu', $locale = 'de_DE', $ssl = true) {
        $this->parser['YAML'] = new YamlParser();
        $this->parser['JSON'] = new JsonParser();
        $this->config = $this->getGlobalConfig();

        $this->setRegion($region);
        $this->setLocale($locale);
        $this->setUrlScheme($ssl);
        $this->baseUrlBuilder();
    }

    /**
     * Gets the global Api configuration and saves it in $config
     * @return mixed
     */
    public function getGlobalConfig() {
        $file = 'Api/Battlenet/constants.yml';
        return $this->parser['YAML']->parseXlixRelativeConfig($file);
    }

    /**
     * Sets the region of the request (default: eu)
     * @param string $region 2 character countrycode
     * @return void
     * @throws UnsupportedRegionException
     */
    public function setRegion($region) {
        $regions = $this->config->regions;
        if (in_array($region, $regions)) {
            $this->region = $region;
        } else {
            throw new UnsupportedRegionException("Region " . $region . " is not a region");
        }
    }

    /**
     * Sets the locale of the request (default: de_DE)
     * @param string $locale %s_%s formatted Locale
     * @return void
     * @throws UnsupportedRegionException
     */
    public function setLocale($locale) {
        $locales = $this->config->locales[$this->region];
        if (in_array($locale, $locales)) {
            $this->locale = $locale;
        } else {
            throw new UnsupportedRegionException("Locale " . $locale . " is not available for your region");
        }
    }

    /**
     * Sets the request scheme (http(s))
     * @param boolean $ssl Use ssl or not?
     * @return void
     */
    public function setUrlScheme($ssl) {
        $this->urlscheme = ($ssl) ? $this->config->base['supported'][1] : $this->config->base['supported'][0];
    }

    /**
     * Sets the basic API url
     * @return void
     */
    public function baseUrlBuilder() {
        $this->base = sprintf($this->config->base['url'], $this->urlscheme, $this->region);
    }

    /**
     * Adds the Locale Suffix or whatever to the URL
     * @param string $url
     * @return void
     */
    public function addUrlLocaleSuffix($url) {
        return $url . "?locale=" . $this->locale;
    }

}