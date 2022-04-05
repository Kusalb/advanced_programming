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
    <label for="cars">Choose a gender:</label>

    <select name="cars">
            <option value="M">Male</option>
            <option value="F">Female</option>
            <option value="O">Other</option>
    </select>
    <br><br>
    <input type="submit" value="Submit">
</form>

</body>
</html>
