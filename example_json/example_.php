<?php
// Assign JSON encoded string to a PHP variable
$json = '{"Peter":65,"Harry":80,"John":78,"Clark":90}';

// Decode JSON data to PHP associative array
$arr = json_decode($json, true);

// Loop through the associative array
foreach($arr as $key=>$value){
    echo $key . "=>" . $value . "<br>";
}
echo "<hr>";
// Decode JSON data to PHP object
$obj = json_decode($json);
?>
