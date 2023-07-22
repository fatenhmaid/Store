<?php
namespace A\B;
use info;

function hello(){
    echo 'Hello A';
}
//define('AJYAL',true);
const LARAVEL ='Laravel A';

class Person implements Human {
    use info;
   protected const MALE='m';
    const FEMALE='f';
    public $name='faten';//no function 
    protected $gender;
    private $age;
    public static $country;

    /*public function setAge(){
        echo __METHOD__;
    }*/


    public function __construct(){
       // $this->name=time();
       echo __CLASS__;
    }


    public static function setCountry($country,$city= null,$state=''){
     //   $this->country=$country;
     self::$country= $country;

    }

    public function name(){
        return $this->name;
    }
    public function age(){
        return $this->age;
    }
}
//$person->setCountry('Ps');
//$person->setCountry('Ps','city');
