<?php
// Sample email address
$email = "someone@@example.com";

// Remove all illegal characters from email
$sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

// Validate email address
if($email == $sanitizedEmail && filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "The $email is a valid email address";
} else{
    echo "The $email is not a valid email address";
}
?>