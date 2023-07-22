<?php
namespace B;
use info;

use A\B\Person as PersonA;

function hello(){
    echo 'Hello B';
}
// define('AJYAL',true);
 const LARAVEL ='Laravel B';


class Person extends PersonA implements Human {
    use info;

    protected const MALE='m';
    const FEMALE='f';

    public $name='faten';//no function 
    protected $gender;
    private $age;
    public static $country;
    public function __construct(){
       // $this->name=time();
       echo __CLASS__;
    }

    public static function setCountry($country){
     //   $this->country=$country;
     parent::setCountry($country);
     self::$country= $country;
     static::$country= $country;

    }
}