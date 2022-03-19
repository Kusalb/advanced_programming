<?php
// Sample website url
$url = "http:://www.example.com";

// Remove all illegal characters from url
$sanitizedUrl = filter_var($url, FILTER_SANITIZE_URL);

// Validate website url
if($url == $sanitizedUrl && filter_var($url, FILTER_VALIDATE_URL)){
    echo "The $url is a valid website url";
} else{
    echo "The $url is not a valid website url";
}
?>