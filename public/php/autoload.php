<?php

/*class Autoloader{
    public function register($classname){
        include __DIR__ ."/{$classname}.php";
    }
}
$a= new Autoloader();
spl_autoload_register([$a,'register']);
*/


class Autoloader{
    public static  function register($classname){
        include __DIR__ . "/{$classname}.php";
    }
}
//spl_autoload_register(['Autoloader','register']);  
spl_autoload_register([Autoloader::class,'register']); //namespace

?>