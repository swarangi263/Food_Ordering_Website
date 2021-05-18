<?php
    include("../config/constants.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">
    <h1 class="text-center">Login</h1>
        <br><br>

        <?php

            if (isset($_SESSION['login'])) {

                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if (isset($_SESSION['no-login'])) {

                echo $_SESSION['no-login'];
                unset($_SESSION['no-login']);
            }

        ?>
       

        <!-- Login Form -->
        <form action="" method="POST" class="text-center">
            Username <br><br>
            <input type="text" name="username" placeholder="Enter Username" required><br><br>
            
            Password <br><br>
            <input type="Password" name="pass" placeholder="Enter Password" required><br><br>
            
            <input type="submit" name = "submit" value="Login" class="btn btn-primary">
            <br><br>
        </form>



        <p class="text-center">Created By: <a href="www.swarangi.com">Swarangi</a></p>
    </div>
</body>
</html>


<?php
    // Check whether submit button is pressed
    if(isset($_POST['submit'])){

        // Process for Login
        // 1.Get data from form
        $username = $_POST['username'];
        $password = md5($_POST['pass']);

        // 2. Query to check user exist
        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND pass = '$password'";
        
        // 3. Execute query
        $result = mysqli_query($conn, $sql);

        // 4. Count to check user exists
        $num = mysqli_num_rows($result);
        if ($num == 1){

            $_SESSION['login'] = "<div class ='success'>Login Successful. </div>";
            
            $_SESSION['user'] = $username; //to check if user is logged in or not 

            // Redirect to home/dashboard
            header('location:'.HOME_URL.'admin/');
            
        }
        else{

            $_SESSION['login'] = "<div class ='error text-center'> Username or Password Not Matched. </div>";
            
            // // Redirect to home/dashboard
            header('location:'.HOME_URL.'admin/login.php');
        }  

    }
?>


<?php
    // Check whether submit button is pressed
    if(isset($_POST['submit'])){

        // Process for Login
        // 1.Get data from form
        $username = $_POST['username'];
        $password = md5($_POST['pass']);

        // 2. Query to check user exist
        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND pass = '$password'";
        
        // 3. Execute query
        $result = mysqli_query($conn, $sql);

        // 4. Count to check user exists
        $num = mysqli_num_rows($result);
        if ($num == 1){

            $_SESSION['login'] = "<div class ='success'>Login Successful. </div>";
            
            $_SESSION['user'] = $username; //to check if user is logged in or not 

            // Redirect to home/dashboard
            header('location:'.HOME_URL.'admin/');
            
        }
        else{

            $_SESSION['login'] = "<div class ='error text-center'> Username or Password Not Matched. </div>";
            
            // // Redirect to home/dashboard
            header('location:'.HOME_URL.'admin/login.php');
        }  

    }
?>