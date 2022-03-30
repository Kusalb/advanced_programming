<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "nilgiri");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$sql = "SELECT * FROM `role`";
$role = mysqli_query($link,$sql);
$sql = "SELECT * FROM `department`";
$department = mysqli_query($link,$sql);
if($_SERVER["REQUEST_METHOD"] == "POST"){
// Prepare an insert statement
$sql = "INSERT INTO employees (name, role_id, department_id) VALUES (?, ?, ?)";

if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "sii", $full_name, $role_id, $department_id);

    // Set parameters
    $full_name = $_REQUEST['full_name'];
    $role_id = $_REQUEST['role_id'];
    $department_id = $_REQUEST['department_id'];

    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        echo "Records inserted successfully.";
    } else{
        echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
    }
} else{
    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
}

// Close statement
mysqli_stmt_close($stmt);

// Close connection
mysqli_close($link);
}
?>

<html>
<form action="" method="POST">
    <input type="text" name="full_name" placeholder="Enter Name">
    <select name="role_id">
        <?php foreach ($role as $r){?>
            <option value="<?php echo $r["role_id"];?>"><?php echo $r["role"]?></option>
        <?php } ?>
    </select>
    <select name="department_id">
        <option value=""></option>
        <?php foreach ($department as $d){?>
            <option value="<?php echo $d["department_id"];?>"><?php echo $d["department_name"]?></option>
        <?php } ?>
    </select>
    <input type="submit" value="Submit">
</form>
</html>
