<?php

namespace Xlix\Bundle\Api\Server\Rest;

use Xlix\Bundle\Parser\Yaml\YamlParser;
use Xlix\Bundle\Parser\Json\JsonParser;

class RestUtils {

    private $_config;
    private $_encoders = array();

    public function __construct() {
        $this->_encoders['JSON'] = new JsonParser();
        $this->_encoders['YAML'] = new YamlParser();
        $this->_config = $this->getConfig();
    }

    public function getConfig() {
        return $this->_encoders['YAML']->parseXlixConfig();
    }

    public function getConfigOption($option) {
        return $this->_config->api['server'][$option];
    }

    public function jsonResponse($responseObject) {
        return $this->_encoders['JSON']->encodeJson($responseObject);
    }

    public function rfc2396Url($json) {
          
    }

}