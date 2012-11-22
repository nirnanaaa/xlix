<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Routing\Ofwn\Compiler\Reference\Of;

class AttributeReference implements TopLevelInterface {

    private $_name = 'attribute';
    private $_startswith = '.';
    private $_instances = array();

    public function getName() {
        return $this->_name;
    }

    public function getStartswith() {
        return $this->_startswith;
    }

    public function __call($name, $arguments) {
        
        if (preg_match("#^getAttr#i", $name)) {

            $attrib = substr($name, 7);
            $classBuilder = "\\Xlix\\Bundle\\Routing\\Ofwn\\Compiler\\Reference\\Of\\{$attrib}";
            if ($this->haveInstance($classBuilder)) {
                return $this->getInstance($attrib);
            } else {
                
                if (class_exists($classBuilder)) {
                    $cls = new $classBuilder;
                    $this->setInstance($attrib, $cls);
                    return $cls;
                } else {
                    return null;
                }
            }
        }
    }

    public function getInstance($name) {
        return $this->_instances[$name];
    }

    public function setInstance($name, $class) {
        $this->_instances[$name] = $class;
    }

    public function haveInstance($class) {
        if (array_key_exists($class, $this->_instances)) {
            return true;
        }
        return false;
    }

}