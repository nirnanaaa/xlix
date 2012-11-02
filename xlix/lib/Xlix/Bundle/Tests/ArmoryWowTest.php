<?php

namespace Xlix\Bundle\Tests;

use Xlix\Bundle\Api\Battlenet\Connectr;

class ArmoryWowTest extends \PHPUnit_Framework_TestCase {

    public function testAchievementTitle() {
        $bnet = new Connectr();
        $game = $bnet->getApi('wow');
        $title = $game->achievement->getAchievementById(2144)->getTitle();
        $this->assertEquals("Was für eine lange, seltsame Reise...", $title);
    }

    public function testPoints() {
        $bnet = new Connectr();
        $game = $bnet->getApi('wow');
        $points = $game->achievement->getAchievementById(2144)->getPoints();
        $this->assertEquals(50, $points);
    }

    public function testDescription() {
        $bnet = new Connectr();
        $game = $bnet->getApi('wow');
        $desc = $game->achievement->getAchievementById(2144)->getDescription();
        $this->assertEquals("Schließt die unten aufgelisteten Weltereignis-Erfolge ab.", $desc);
    }

    public function testReward() {
        $bnet = new Connectr();
        $game = $bnet->getApi('wow');
        $desc = $game->achievement->getAchievementById(2144)->getDescription();
        $this->assertEquals("Schließt die unten aufgelisteten Weltereignis-Erfolge ab.", $desc);
    }

    public function testAccountWide() {
        $bnet = new Connectr();
        $game = $bnet->getApi('wow');
        $acc = $game->achievement->getAchievementById(2144)->isAccountWide();
        $this->assertTrue(true, $acc);
    }

}

?>
