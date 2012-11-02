<?php

namespace Xlix\Bundle\Api\Battlenet;


use Xlix\Bundle\Api\Battlenet\Wow\WowMain;
use Xlix\Bundle\Api\Battlenet\Diablo\DiabloMain;
use Xlix\Bundle\Api\Battlenet\Wow\BUtils;

class Connectr {

    public $constants;
    public $parser = array();
    private $config;

    public function __construct($region = 'eu', $locale = 'de_DE', $ssl = true) {
        $utils = new BUtils;
        $this->config = $utils->getGlobalConfig();

        $utils->setRegion($region);
        $utils->setLocale($locale);
        $utils->setUrlScheme($ssl);
        $utils->baseUrlBuilder();
    }

    /**
     * gets an instance of the Game Api
     * 
     * @param string $game Diablo/Wow
     * @return Xlix\Bundle\Api\Battlenet\$game Game instance
     * */
    public function getApi($game) {
        switch (trim(strtolower($game))) {
            case 'wow':
                return $this->boot(new WowMain());
                break;
            case 'diablo':
                return $this->boot(new DiabloMain());
                break;
            default:
                return $this->boot(new WowMain());
        }
    }

    /**
     * Run the applications self check mechanism an return an instance of the class
     * @param GameMainInterface $gameClass an instance of a game class
     * @return GameMainInterface Object instance
     */
    public function boot($gameClass) {
        $gameClass->bootCheckUp();
        return $gameClass;
    }

}