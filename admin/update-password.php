<?php include('../admin/partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br /><br />

        <?php
        // get id of updated admin
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }


        // get details
        $sql = "SELECT * FROM tbl_admin WHERE id = $id";
        $res = mysqli_query($conn, $sql);

        // check query executed
        if ($res == TRUE) {
            // data is available
            $count = mysqli_num_rows($res);
            // check whether admin data is present or not
            if ($count == 1) {
                // get the details
                $row = mysqli_fetch_assoc($res);

                $password = $row['pass'];
            } else {
                // redirect
                header('location:' . HOME_URL . 'admin/manage-admin.php', true, 301);
            }
        }

        ?>
        <br /><br />

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td><input type="password" name="curr_pass" placeholder="Current Password" required></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_pass" placeholder="New password" required></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirm_pass" placeholder="Confirm password" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
// check whether update btn is clicked or not
if (isset($_POST['submit'])) {
    // echo "Button clicked";

    // 1.get all details from form
    $id = $_POST['id'];
    $curr_password = md5($_POST['curr_pass']);
    $new_password = md5($_POST['new_pass']);
    $confirm_password = md5($_POST['confirm_pass']);

    // 2.check whether user with current id n password exist
    $sql = "SELECT * FROM tbl_admin WHERE id = $id 
    AND pass = '$curr_password'";
    // execute query
    $res = mysqli_query($conn, $sql);
    // check query executed properly
    if ($res == TRUE) {

        $count = mysqli_num_rows($res);

        if ($count == 1) {
            // User exist and password can be changed
            // echo "User Found";

            // 3.check whether new pass word n confirm password match or not 
            if ($new_password == $confirm_password) {
                
                // Update Password

                // 4.change if everything is true
                $sql2 = "UPDATE tbl_admin SET pass = '$new_password'
                WHERE id = '$id' ";
                // execute query
                $res2 = mysqli_query($conn, $sql2);
                // check query executed pprly
                if ($res2 == TRUE) {
                    $_SESSION['pwd-update'] = "<div class = 'success'>Password Change Successfully. </div>";
                    header('location:' . HOME_URL . 'admin/manage-admin.php', true, 301);
                }
                else{
                    $_SESSION['pwd-update'] = "<div class = 'error'>Error</div>";
                    header('location:'.HOME_URL.'admin/manage-admin.php',true,301);
        
                }
            } 
            else {
                // Redirect with error
                $_SESSION['pwd-not-matched'] = "<div class ='error'>Password Not Matched. </div>";
                header('location:' . HOME_URL . 'admin/manage-admin.php', true, 301);
            }
        } 
        
        else {
            // User doesn't exist and password can't be changed
            $_SESSION['user-not-found'] = "<div class ='error'>User Not Found. </div>";
            header('location:' . HOME_URL . 'admin/manage-admin.php', true, 301);
        }
    }
}





?>


<?php include('partials/footer.php'); ?>