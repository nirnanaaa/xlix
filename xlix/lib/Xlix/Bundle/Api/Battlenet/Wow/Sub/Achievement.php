<?php

namespace Xlix\Bundle\Api\Battlenet\Wow\Sub;

use Xlix\Bundle\Api\Battlenet\Interfaces\SubClassesInterface;
use Xlix\Bundle\Api\Battlenet\Wow\Sub\BNetSubClassExtender;

class Achievement extends BNetSubClassExtender implements SubClassesInterface {

    public $uBase;
    public $idx;

    public function getAchievementById($id = null) {
        $this->setBase();
        if (null === $id && null !== $this->idx) {
            $this->currentUrl = $this->uBase . $this->idx;
        } else {
            $this->currentUrl = $this->uBase . $id;
        }

        return $this;
    }

    public function getAll() {
        return $this->getUrl();
    }

    public function getTitle() {
        return $this->getUrl()->title;
    }

    public function getDescription() {
        return $this->geturl()->description;
    }

    public function getReward() {
        return $this->getUrl()->rewardItems;
    }

    public function getPoints() {
        return $this->getUrl()->points;
    }
    public function getCriteria(){
        return $this->getUrl()->criteria;
    }
    public function isAccountWide(){
        return $this->getUrl()->accountWide;
    }
    public function setBase() {
        $this->uBase = "achievement/";
    }

}