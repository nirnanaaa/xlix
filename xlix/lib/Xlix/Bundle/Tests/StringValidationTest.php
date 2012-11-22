<?php

use Xlix\Bundle\Validation\StringValidation;

class StringValidationTest extends \PHPUnit_Framework_TestCase {

    public function testisalpha() {
        $validator = new StringValidation;
        $match1 = (int) $validator->isAlpha("google");
        $this->assertEquals(1, $match1);
    }

    public function testisNOalpha() {
        $validator = new StringValidation;
        $match1 = (int) $validator->isAlpha("google.com");
        $this->assertEquals(0, $match1);
    }

    public function testisalphanum() {
        $validator = new StringValidation;
        $match1 = (int) $validator->isAlnum("g00gle");
        $this->assertEquals(1, $match1);
    }

    public function testisNOalphanum() {
        $validator = new StringValidation;
        $match1 = (int) $validator->isAlnum("g-as!.com");
        $this->assertEquals(0, $match1);
    }

    public function testisEmail() {
        $validator = new StringValidation;
        $match1 = (int) $validator->isValidEmail("xlix@khnetworks.com");
        $this->assertEquals(1, $match1);
    }

    public function testisNOEmail() {
        try {
            $validator = new StringValidation;
            $validator->isValidEmail(".as.das.d.asdxlix@blafasel@khnetworks.com");
        } catch (\Xlix\Bundle\Validation\Exception\InvalidInputException $expected) {
            return;
        }
        $this->fail("no exception has been risen");
    }

    public function testLenght() {
        $validator = new StringValidation;
        $match1 = (int) $validator->validateLenght("das", 5, 1);
        $this->assertEquals(1, $match1);
    }

    public function testTooLong() {
        $validator = new StringValidation;
        $match1 = (int) $validator->validateLenght("das ist ein kleiner test", 5, 1);
        $this->assertEquals(0, $match1);
    }

    public function testTooShort() {
        $validator = new StringValidation;
        $match1 = (int) $validator->validateLenght("d", 5, 2);
        $this->assertEquals(0, $match1);
    }

    public function testIsString() {
        $validator = new StringValidation;
        $match1 = (int) $validator->isString("das ist ein kleiner test");
        $this->assertEquals(1, $match1);
    }

}