<?php
// Create the timestamp for a particular date
echo mktime(15, 20, 12, 5, 10, 2014);

// Get the weekday name of a particular date
echo date('l', mktime(0, 0, 0, 4, 1, 2014));

// Executed at March 05, 2014
$futureDate = mktime(0, 0, 0, date("m")+30, date("d"), date("Y"));
echo date("d/m/Y", $futureDate);
?>