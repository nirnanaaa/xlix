<?php

namespace Xlix\Bundle\Mozok\Encrypt\Interfaces;

interface AlgoInterface {

    public function getSupport();

    public function getName();

    public function getInfos();

    public function getFeatures();

    public function encryptString($string, $salt);

    public function readOptions($options);
}
