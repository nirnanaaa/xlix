<?php

namespace Xlix\Bundle\Mailer;

use Xlix\Bundle\Parser\Yaml\YamlParser;

class Mail {

    protected $_sysmailer;
    protected $_parser;

    public function __construct() {
        $this->_parser = new YamlParser();
        $this->sysmailer = $this->_parser->parseXlixConfig()->mailer['from'];
    }

    public function sendMail($to, $from, $subject, $text) {
        
    }

    public function sendSystemMail() {
        
    }

}