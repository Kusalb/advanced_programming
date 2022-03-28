<?php
$url = 'https://corona.askbhunte.com/api/v1/data/nepal'; // path to your JSON file
$data = file_get_contents($url); // put the contents of the file into a variable
$characters = json_decode($data); // decode the JSON feed
print_r ($characters);
echo"<br>";
echo "<br>Tested positive data is down below<br>";
echo ($characters->tested_positive);

echo "<br>Tested negative data is down below<br>";
echo ($characters->tested_negative);

echo "<br>URl is down below<br>";
echo ($characters->latest_sit_report->url);

