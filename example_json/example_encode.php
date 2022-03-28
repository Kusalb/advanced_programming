<?php
// An associative array
$marks = array("Peter"=>65, "Harry"=>80, "John"=>78, "Clark"=>90);
// An indexed array
$colors = array("Red", "Green", "Blue", "Orange", "Yellow");

echo json_encode($marks);
echo json_encode($marks["Peter"]);
echo json_encode($colors, JSON_FORCE_OBJECT);
?>

