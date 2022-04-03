<?php
if($_SERVER["REQUEST_METHOD"]== "POST")
{
    echo $_POST['cars'];
}
?>
<!DOCTYPE html>
<html>
<body>
<form action="" method="POST">
    <label for="cars">Choose a car:</label>

    <select name="cars">
            <option value="0">Volvo</option>
            <option value="1">Bogate</option>
            <option value="2">Chaprigini</option>
    </select>
    <br><br>
    <input type="submit" value="Submit">
</form>

</body>
</html>
