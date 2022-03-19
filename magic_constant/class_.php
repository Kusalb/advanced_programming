<?php
class MyClass
{
    public function getClassName(){
        return __CLASS__;
    }
}
$obj = new MyClass();
echo $obj->getClassName(); // Displays: MyClass
?>