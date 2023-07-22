<?php
namespace A;
use A\B\Person;
use function A\B\Person;
use Facade;
use ServiceContainer;

//include __DIR__. '/A/Person.php';
//include __DIR__. '/B/Person.php';
include __DIR__. '/autoload.php';

$person =new Person;
$person->name='fadi';

ServiceContainer::bind('person',$person);

echo Facade::name('fadi','basel');



exit;

//use B\Person;
//use Person;

//use function B\hello;
//use const B\LARAVEL;

//echo LARAVEL;
//hello();

$person=new \A\B\Person;
$person2=new \B\Person;
//$person=new \A\Person;

$person->name='faten';
$person2->name='faten2';

if($person instanceof \B\Human){
    echo 'YESS!';
}

$person->setAge(10);

//$person->age=10
$person::$country='palestine';
$person2::$country='Jordan';

var_dump($person,$person2);
echo B\Person::$country;
echo $person::FEMALE;
?>