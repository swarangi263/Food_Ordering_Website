<?php include('../admin/partials/menu.php'); 
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br /><br />

        <?php
            // get id of updated admin
            $id = $_GET['id'];

            // get details
            $sql = "SELECT * FROM tbl_admin WHERE id = $id";
            $res = mysqli_query($conn,$sql);

            // check query executed
            if($res==TRUE){
                // data is available
                $count = mysqli_num_rows($res);
                // check whether admin data is present or not
                if($count==1){
                    // get the details
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else{
                    // redirect
                    header('location:'.HOME_URL.'admin/manage-admin.php',true,301);
                }
            }
        
        ?>
        <br /><br />

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" value= "<?php echo $full_name?>" required></td>
                </tr>
                <tr>
                    <td>User Name:</td>
                    <td><input type="text" name="username" value= "<?php echo $username?>" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
                
            </table>
        </form>
    </div>
</div>

<?php
// check whether update btn is clicked or not
    if(isset($_POST['submit'])){
        // echo "Button clicked";

        // get all details from form
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        // create sql query 

        $sql = "UPDATE tbl_admin SET full_name = '$full_name', username = '$username' 
        WHERE id = '$id' ";
        // execute query
        $res = mysqli_query($conn,$sql);
        // check query executed pprly
        if($res==TRUE){
            $_SESSION['update'] = "<div class = 'success'>Updated</div>";
            header('location:'.HOME_URL.'admin/manage-admin.php',true,301);

        }
        else{
            $_SESSION['update'] = "<div class = 'error'>Error</div>";
            header('location:'.HOME_URL.'admin/manage-admin.php',true,301);

        }
    }
?>


<?php include('partials/footer.php'); ?>