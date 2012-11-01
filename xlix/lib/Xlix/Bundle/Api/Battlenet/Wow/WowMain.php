<?php

namespace Xlix\Bundle\Api\Battlenet\Wow;

use Xlix\Bundle\Api\Battlenet\Interfaces\GameMainInterface;
use Xlix\Bundle\Parser\Yaml\YamlParser;
use Xlix\Bundle\Exception\InvalidConfigurationProvidedException;
use Xlix\Bundle\Api\Battlenet\Wow\Sub\Achievement;
use Xlix\Bundle\Api\Battlenet\Wow\Sub\Auction;
use Xlix\Bundle\Api\Battlenet\Wow\Sub\ChallengeMode;
use Xlix\Bundle\Api\Battlenet\Wow\Sub\Character;
use Xlix\Bundle\Api\Battlenet\Wow\Sub\Guild;
use Xlix\Bundle\Api\Battlenet\Wow\Sub\Item;
use Xlix\Bundle\Api\Battlenet\Wow\Sub\PetBattle;
use Xlix\Bundle\Api\Battlenet\Wow\Sub\Pvp;
class WowMain implements GameMainInterface {

    protected $parser;
    public $achievement;
    public $character;
    public $guild;
    public $auction;
    public $battlePet;
    public $challengeMode;
    public $item;
    public $pvp;
    public function __construct() {
        $this->parser = new YamlParser;
        $this->achievement = new Achievement;
        $this->character = new Character;
        $this->guild = new Guild;
        $this->challengeMode = new ChallengeMode;
        $this->battlePet = new PetBattle;
        $this->item = new Item;
        $this->pvp = new Pvp;
        $this->auction = new Auction;
    }

    public function getGameName() {
        return "World of Warcraft";
    }

    public function getGameType() {
        return "MMORPG";
    }

    public function getGame() {
        
    }

    public function getGameConstants() {
        $file = 'Api/Battlenet/Wow/Config/constants.yml';
        return $this->parser->parseXlixRelativeConfig($file);
    }

    public function getCodeVersion() {
        return 0x001; //eq. v0.0.1
    }

    public function bootCheckUp() {
        if (empty($this->getGameConstants())) {
            throw new InvalidConfigurationProvidedException("configuration failure or config is empty");
        }
    }

}