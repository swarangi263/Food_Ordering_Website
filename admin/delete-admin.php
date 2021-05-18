<?php
// include('../admin/partials/menu.php');

    include('../config/constants.php');
// 1. get the id to be deleted

    $id = $_GET['id'];

// 2. create query to delete
    $sql = "DELETE FROM tbl_admin WHERE id = $id";

    $result = mysqli_query($conn,$sql);

    if($result){
        // echo $id.' Deleted';
        // create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted</div>" ;
        header('location:'.HOME_URL.'admin/manage-admin.php',true,301);

    }
    else{
        $_SESSION['delete'] = "<div class='error'>Error in Deleting</div>" ;
        header('location:'.HOME_URL.'admin/manage-admin.php',true,301);
    }
// redirect to manage-admin page with message success/error

    // 
?>
