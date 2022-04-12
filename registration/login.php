<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['username']))
{
    header("location: welcome.php");
    exit;
}
require_once "../config.php";

$username = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username and password";
        echo $err;
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


    if(empty($err))
    {
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;

        // Try to execute this statement
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1)
            {
                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                if(mysqli_stmt_fetch($stmt))
                {
                    if(password_verify($password, $hashed_password))
                    {
                        // this means the password is corrct. Allow user to login
                        session_start();
                        $_SESSION["username"] = $username;
                        $_SESSION["id"] = $id;
                        $_SESSION["loggedin"] = true;

                        //Redirect user to welcome page
                        header("location: welcome.php");

                    }
                }

            }

        }
    }


}
?>


<!--   <h1>Php Login System</h1>-->
<!--    <a href="register.php">Register</a>-->
<!--    <a href="login.php">Login</a>-->
<!---->
<!---->
<!--<div class="container mt-4">-->
<!--    <h3>Please Login Here:</h3>-->
<!--    <hr>-->
<!---->
<!--    <form action="login.php" method="post">-->
<!--            <label for="email">Username:</label>-->
<!--            <input type="text" name="username" id="email" placeholder="Enter Username">-->
<!--            <label for="password">Password:</label>-->
<!--            <input type="password" name="password" id="password" placeholder="Enter Password">-->
<!--        <button type="submit" >Submit</button>-->
<!--    </form>-->
<!---->
<!--</div>-->
<?php include "../registration/header.php"?>
   <main class="form-signin">
       <form action="login.php" method="post">
<!--           <img class="mb-4" src="/docs/5.1/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">-->
           <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

           <div class="form-floating">
               <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username">
               <label for="floatingInput">Email address</label>
           </div>
           <div class="form-floating">
               <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
               <label for="floatingPassword">Password</label>
           </div>

           <div class="checkbox mb-3">
               <label>
                   <input type="checkbox" value="remember-me"> Remember me
               </label>
           </div>
           <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
           <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
       </form>
   </main>

</body>
</html>


