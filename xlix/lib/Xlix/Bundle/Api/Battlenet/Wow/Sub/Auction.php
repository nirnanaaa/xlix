<?php

namespace Xlix\Bundle\Api\Battlenet\Wow\Sub;

use Xlix\Bundle\Api\Battlenet\Interfaces\SubClassesInterface;
use Xlix\Bundle\Api\Battlenet\Wow\Sub\BNetSubClassExtender;

class Auction extends BNetSubClassExtender implements SubClassesInterface {

    public $uBase;
    public $parseUrl;
    public $realm;
    public $real;
    public $data;
    public $object;
    public function setRealm($realm) {
        $this->realm = $realm;
        return $this;
    }

    public function setBase() {
        $this->uBase = 'auction/data/' . $this->realm;
    }

    public function getAuction($realm = null) {
        $this->setBase();
        if (null === $realm && null !== $this->real) {
            $this->currentUrl = $this->uBase . $this->real;
        } else {
            $this->currentUrl = $this->uBase . $realm;
        }
        $url = $this->getExternalUrl($this->getCurrentUrl());
        $this->currentUrl = $url->files[0]->url;
        $this->data = $this->getExternalUrl($this->currentUrl);
        print_r($this->data);
        return $this;
        // return $this;
    }

    public function getAllAuctionsByCharacter() {
        return $this->getExternalUrl($this->parseUrl);
    }

    public function getAllAuctionsByItem() {
        
    }

    public function getAllLongAuctions() {
        
    }

    public function getAllVeryLongAuctions() {
        
    }

    public function getAllShortAuctions() {
        
    }

    public function getAllMediumAuctions() {
        
    }

    public function getAllAuctions() {
        return $this->getExternalUrl($this->currentUrl);
    }

    public function getHordeAuctions() {
        return $this->getExternalUrl($this->currentUrl)->horde->auctions;
    }

    public function getAllianceAuctions() {
        return $this->getExternalUrl($this->currentUrl)->alliance->auctions;
    }

    public function getNeutralAuctions() {
        return $this->getExternalUrl($this->currentUrl)->neutral->auctions;
    }

    public function getBuyoutPrice() {
        return $this->object->buyout;
    }

    public function getBidPrice() {
        return $this->object->bid;
    }

    public function getStackSize() {
        return $this->object->quantity;
    }

    public function getTimeLeft() {
        return $this->object->timeLeft;
    }

    public function getItemId() {
        return $this->object->item;
    }

    public function getAuctionId() {
        
    }

    public function getOwner() {
        
    }

}