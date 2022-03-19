<?php
$pattern = "/f/";
$replacement = " ";
$text = "The quick brown fox is a clever fox.";
// Replace spaces, newlines and tabs
echo preg_replace($pattern, $replacement, $text);
echo "<br>";
// Replace only spaces
echo str_replace(" ", "-", $text);
?>