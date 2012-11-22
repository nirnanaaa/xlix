<?php

namespace Xlix\Plugin;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class XlixPlugin extends Bundle {

    public function getVersion() {
        return 0x0001a;
    }

    public function getMyName() {
        return "XLIX - Plugin Dir";
    }

    public function getDescription() {
        return "a symfony2 vendor!";
    }

    public function __construct() {
        
       // $plugdir = opendir(__DIR__);
        $classes = array(
            "Khnetworks" => new \Xlix\Plugin\Khnetworks\Loader(),
            
        );
        
     //   while(false !== ($entry = readdir($plugdir))){
         //   if(!preg_match("/\./i",$entry)){
               // $classBuilder = "Xlix\\Plugin\\{$entry}\\Loader";
                
                //if(class_exists($classBuilder)){
                  //  $classes[$entry]  = new $classBuilder;
                   // $classes[] = new $classBuilder();
               // }
          //  }
       // }
    }

}

?>
