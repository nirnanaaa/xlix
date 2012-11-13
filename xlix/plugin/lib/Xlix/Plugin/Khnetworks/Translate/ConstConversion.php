<?php

namespace Xlix\Plugin\Shades\Translate;

use Xlix\Bundle\Parser\Yaml\YamlParser;

class ConstConversion {

    protected $file;

    public function parseValue($const) {
        $parser = new YamlParser();
        if (is_object($this->file)) {
            $cons = $this->file;
        } else {
            $cons = (object) $parser->parseConfig(dirname(__FILE__) . '/log.yml');
            $this->file = $cons;
        }
        return $cons->translation[$const];
    }

    public function converseArray($array) {
        $arrays = array();
        
        foreach ($array as $value) {
            $arrays[$value['group_id']]['group_id'] = $value['group_id'];
            $arrays[$value['group_id']]['group_name'] = ($group = $this->parseValue($value['group_name'])) ? $group : $value['group_name'];
        }
        return $arrays;
    }

}