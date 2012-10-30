<?php

use Xlix\Bundle\Validation\NetworkValidation;

class ValidationNetworkTest extends \PHPUnit_Framework_TestCase {

    public function testIPvalidIp() {
        $validator = new NetworkValidation();
        $match1 = $validator->isValidIpDiget('31.21.3.9');
        $match2 = $validator->isValidIpDiget("999.999.21.93");
        $this->assertEquals(1, $match1);
        $this->assertEquals(0, $match2);
    }

    public function testisv4() {
        $validator = new NetworkValidation();
        $match1 = $validator->isIpv4('1.1.1.1');
        $this->assertEquals(1, $match1);
    }

    public function testisnov4() {
        $validator = new NetworkValidation();
        $matche = $validator->isIpv4('2001:4860:b002::68:');
        $this->assertEquals(0, $matche);
    }

    public function testisv6() {
        $validator = new NetworkValidation();
        $matche = $validator->isIpv6('2001:4860:b002::68');
        $this->assertEquals(1, $matche);
    }

    public function testisnov6() {
        $validator = new NetworkValidation();
        $matche = $validator->isIpv6('goo');
        $this->assertEquals(0, $matche);
    }

}

?>