<?php
class Sample
{
    public function myMethod(){
        echo __METHOD__;
    }
}
$obj = new Sample();
$obj->myMethod(); // Displays: Sample::myMethod
?>

