<?php

namespace Xlix\Bundle\Api\Battlenet\Interfaces;

interface GameMainInterface {

    public function __construct();

    public function getGameName();

    public function getGameType();

    public function getGame();

    public function getCodeVersion();

    public function bootCheckUp();
}