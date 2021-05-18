<?php
// include('../admin/partials/menu.php');

    include('../config/constants.php');
// 1. get the id to be deleted
    //check whether the id and name is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get the value and delete
        //echo "Get Deleted Value";
        $id = $_GET['id'];
        $image = $_GET['image_name'];

        //remove the physical image file if available
        if($image!= ""){

            //image is available so remove it
            $path = "../image/category/".$image;

            //remove image
            $remove = unlink($path);

            //if error show msg and stop process
            if($remove==FALSE){
                //set session msg
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image</div>" ;
                //redirect
                header('location:'.HOME_URL.'admin/manage-category.php',true,301);
                //stop
                die();
            }
        }

        //delete data from db

        // 2. create query to delete
        $sql = "DELETE FROM category WHERE id = $id";

        $result = mysqli_query($conn,$sql);
        
        //check for query
        if($result==TRUE){
            // echo $id.' Deleted';
            // create session variable to display message
            $_SESSION['delete'] = "<div class='success'>Category Deleted</div>" ;
            header('location:'.HOME_URL.'admin/manage-category.php',true,301);
    
        }
        else{
            $_SESSION['delete'] = "<div class='error'>Error in Deleting</div>" ;
            header('location:'.HOME_URL.'admin/manage-category.php',true,301);
        }
    }
    
    
    else{
        //redirect to manage category
        
        header('location:'.HOME_URL.'admin/manage-category.php',true,301);
    }


?>
