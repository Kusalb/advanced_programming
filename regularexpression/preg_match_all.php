<?php
//$string = "PHP is the web scripting php language of my choice.";
    $string = "PHP is the web scripting php language  522 of my choice. 455";

//$exp = preg_match_all("/php|web|the/i", $string, $array);
//$exp = preg_match_all("/w|o|t/i", $string, $array);
//$exp = preg_match_all("/522|888|the/i", $string, $array);
//$exp = preg_match_all("/[^wot]/i", $string, $array);
// charated set, ^- caret operator
//$exp = preg_match_all("/[a-j]/i", $string, $array);

// \ w   \d , \D, \s, \bi\b,       . single caracter

//. ? ( [ + * $ ^ ] | )
$exp = preg_match_all("/[A-J]/", $string, $array);
$exp = preg_match_all("/[a-jA-J]/", $string, $array);
$exp = preg_match_all("/[0-9]/", $string, $array);
$exp = preg_match_all("/[^0-5]/", $string, $array);
$exp = preg_match_all("/[a-j0-5]/i", $string, $array);

if($exp){
    echo "A match was found.";
}else{
    echo "A match was not found.";
}
echo "<pre>";
print_r($array);
echo "</pre>";

echo $array[0][1];