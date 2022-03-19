<?php
// Include config file
require_once "../config.php";

//Define variables and initialize with empty values
$first_name = $last_name = $email = "";
$first_name_err = $last_name_err = $email_err = "";
// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    echo "1";

// Get hidden input value
    $id = $_POST["id"];
    $temp_name = $_FILES['image']['tmp_name'];
    $filename = $_FILES['image']['name'];
    $folder = "upload/" . $filename;


//Validate first name
    $input_first_name = trim($_POST["first_name"]);
    if (empty($input_first_name)) {
        $first_name_err = "Please enter a first name";
        echo "Please enter a first name.";
    } elseif (!filter_var($input_first_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $first_name_err = "Please enter a valid first name";
        echo "Please enter a valid first name";
    } else {
        $first_name = $input_first_name;
    }

//Validate last name
    $input_last_name = trim($_POST["last_name"]);
    if (empty($input_last_name)) {
        $last_name_err = "Please enter a last name";
        echo "Please enter a last name.";
    } elseif (!filter_var($input_last_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $last_name_err = "Please enter a valid last name";
        echo "Please enter a valid last name";

    } else {
        $last_name = $input_last_name;
    }
//Validation of email
    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Please enter a email";
        echo "Please enter a email";
    } else {
        $email = $input_email;
    }

// Check input errors before inserting in database
    if (empty($first_name_err) && empty($last_name_err) && empty($email_err)) {
        echo "2";
        // Prepare an update statement
        if ($filename == "") {
            echo "3";

            $sql = "UPDATE persons SET first_name=?, last_name=?, email=? WHERE id=?";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sssi", $param_first_name, $param_last_name, $param_email, $param_id);
                echo "4";

                // Set parameters
                $param_first_name = $first_name;
                $param_last_name = $last_name;
                $param_email = $email;
                $param_id = $id;
            }
        } else {
            $sql = "UPDATE  persons SET first_name=?, last_name=?, email=?, image=? WHERE id=?";
            if ($stmt = mysqli_prepare($conn, $sql)) {

                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssssi", $param_first_name, $param_last_name, $param_email, $filename, $param_id);
                // Set parameters
                $param_first_name = $first_name;
                $param_last_name = $last_name;
                $param_email = $email;
                $filename = $_FILES['image']['name'];
                $param_id = $id;
            }
        }
        if (move_uploaded_file($temp_name, $folder)) {
            $msg = "Image uploaded successfully";
        } else {
            $msg = "Failed to upload image";
        }
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            echo "7";

            // Records updated successfully. Redirect to landing page
            header("location: retrieve_to.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }


// Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($conn);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id = trim($_GET["id"]);
        echo "8";

        // Prepare a select statement
        $sql = "SELECT * FROM persons WHERE id = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            echo "9";

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                echo "10";

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result);

                    // Retrieve individual field value
                    $first_name = $row["first_name"];
                    $last_name = $row["last_name"];
                    $email = $row["email"];
                    $image = $row["image"];

                } else {
                    echo "11";

                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($conn);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
<html>
<head>
    <title>Edit Data</title>
</head>
<body>
<a href="retrieve_to.php">Home</a>
<br><br>
<form method="post" action="" enctype="multipart/form-data">
    <input type="text" name="first_name" value="<?php echo $first_name; ?>"<br><br>
    <input type="text" name="last_name" value="<?php echo $last_name; ?>"<br><br>
    <input type="email" name="email" value="<?php echo $email; ?>" <br><br>
    <input type="file" name="image"><br><br><?php echo $image; ?><br>
    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
    <input type="submit" value="update">
</form>

</body>
</html>