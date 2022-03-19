<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>PHP login system!- HOME</title>
</head>
<body>
<a href="logout.php">Logout</a>



<div class="container mt-4">
    <h3><?php echo "Welcome ". $_SESSION['username']?>! You can now use this website</h3>
    <hr>

</div></body>
</html>
