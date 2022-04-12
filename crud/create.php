<?php
require_once "../config.php";

// Define variables and initialize with empty values
$first_name= $last_name = $email = "";
$first_name_err = $last_name_err = $email_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Validate first name
    $input_first_name = trim($_POST["first_name"]);
    if (empty($input_first_name)) {
        $first_name_err = "Please enter a first name.";
        echo "Please enter a first name.";

    } elseif (!filter_var($input_first_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $first_name_err = "Please enter a valid first name.";
        echo "Please enter a valid first name.";

    } else {
        $first_name = $input_first_name;
    }

// Validate last name
    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Please enter a email.";
        echo "Please enter a email";
    } else {
        $email = $input_email;
    }

// Validate last name
    $input_last_name = trim($_POST["last_name"]);
    if (empty($input_last_name)) {
        $last_name_err = "Please enter a last name.";
        echo "Please enter a last name.";
    } elseif (!filter_var($input_last_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $last_name_err = "Please enter a valid last name.";
        echo "Please enter a valid last name.";
    } else {
        $last_name = $input_last_name;
    }



    if (empty($first_name_err_err) && empty($last_name_err) && empty($email_err)) {
// Prepare an insert statement

        $temp_name=$_FILES['image']['tmp_name'];
        $filename=$_FILES['image']['name'];
        $folder = "upload/".$filename;
        if (move_uploaded_file($temp_name, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
        }

        $sql = "INSERT INTO persons (first_name, last_name, email, image) VALUES (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $first_name, $last_name, $email, $filename);

            // Set parameters
            $first_name = trim($_POST['first_name']);
            $last_name = trim($_POST['last_name']);
            $email = trim($_POST['email']);
            $filename=$_FILES['image']['name'];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                header("location: retrieve_to.php");
            } else {
                echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
            }
        } else {
            echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
        }

// Close statement
        mysqli_stmt_close($stmt);

// Close connection
        mysqli_close($conn);
    }
}
?>
<?php include "header.php" ?>


<div class="container mt-3">
    <h2>Create page</h2>
    <div class="row">
    <form action="create.php" method="post" enctype="multipart/form-data">
            <input type="file" id="image" name="image" class="form-control"><br>
            <input type="text" id="first_name" placeholder="Enter First name" name="first_name" class="form-control"><br>
            <input type="text" id="last_name" placeholder="Enter last name" name="last_name" class="form-control"><br>
         <input type="email" id="email" placeholder="Enter email" name="email" class="form-control"><br>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
<?php include "footer.php"?>