<?php

namespace Xlix\Bundle\Routing\Ofwn\Compiler\Reference\Of;

interface ReferenceInterface {

    public function getMaxLen();

    public function getName();

    public function getValidation();

    public function isValid($mixed);
    
    public function handleData($data);
}