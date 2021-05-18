<?php include('partials/menu.php'); ?>

<!---Main Section------>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br />


        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['update_pass'])){
                echo $_SESSION['update_pass'];
                unset($_SESSION['update_pass']);
            }

            if(isset($_SESSION['user-not-found'])){
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }

            if(isset($_SESSION['pwd-not-matched'])){
                echo $_SESSION['pwd-not-matched'];
                unset($_SESSION['pwd-not-matched']);
            }

            if(isset($_SESSION['pwd-update'])){
                echo $_SESSION['pwd-update'];
                unset($_SESSION['pwd-update']);
            }
            
        ?>
        <br /><br />

        <!-- Button Add Admin-->
        <a href="add-admin.php" class="btn-primary text-center">Add Admin</a>
        <br /><br />

        <table class="tbl-full">
            <tr>
                <th>Sr.No.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM tbl_admin";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);
            $sn=1;
            if ($count > 0) {

                while ($count = $result->fetch_assoc()) {

                    $id = $count['id'];
                    $full_name = $count['full_name'];
                    $username = $count['username'];
            ?>

                    <tr>
                        <td><?php echo $sn++; ?>. </td>
                        <td><?php echo $full_name; ?></td>
                        <td><?php echo $username; ?></td>
                        <td>
                        <a href="<?php echo HOME_URL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary text-center">Change Password</a>
                            <a href="<?php echo HOME_URL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary text-center">Update Admin</a>
                            <a href="<?php echo HOME_URL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger text-center">Delete Admin</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "No results";
            }
            ?>

        </table>



        <!-- <div class="clearfix"></div> -->
    </div>
</div>
<?php include('partials/footer.php'); ?>