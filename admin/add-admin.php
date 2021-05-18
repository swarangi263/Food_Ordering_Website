<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Full Name" value= "" required></td>
                </tr>
                <tr>
                    <td>User Name:</td>
                    <td><input type="text" name="username" placeholder="Enter Username" value= "" required></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="pass" placeholder="Enter Password" value= "" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php 
// process the value and save it in database
// check whether the button is clicked or not

if(isset($_POST['submit'])){
    // button clicked
    // 1. get data
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['pass']); //pass encrypted with md5
    
    // 2. store data
    $input = "INSERT INTO tbl_admin(full_name,username,pass) VALUES ('$full_name','$username','$password')";

    // 3. execute query and saving data in db

    $result = mysqli_query($conn, $input) or die(mysqli_error($conn));

    // 4. check if data is added and executed query pprly
    if($result==TRUE){
        // Data inserted
        // Create session variable
        $_SESSION['add'] = "<div class= 'success'>Admin Added Successfully. </div>";

        // Redirect
        header('location:'.HOME_URL.'admin/manage-admin.php',true,301);
    }

    // echo($input);
}




?>