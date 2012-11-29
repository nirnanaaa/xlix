<?php

namespace Xlix\Bundle\Log;
class Log{
    
    private $logger;
    
    public function __construct($logger){
        $this->logger = $logger;
    }
    public function logEvent($event){
        $this->logger->info(sprintf("Event: %s from client ?! .. STATUS: passed", $event));
    }


}
