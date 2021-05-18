<?php include('../admin/partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br /><br />

        <?php
        //check id is set or not
        if (isset($_GET['id'])) {
            // get id of and all details

            $id = $_GET['id'];

            $sql = "SELECT * FROM category WHERE id = $id";
            $res = mysqli_query($conn, $sql);

            // check query executed
            if ($res == TRUE) {
                // data is available
                $count = mysqli_num_rows($res);
                // check whether admin data is present or not
                if ($count == 1) {
                    // get the details
                    $row = mysqli_fetch_assoc($res);

                    $title = $row['title'];
                    $curr_image = $row['image_name'];
                    $feature = $row['feature'];
                    $active = $row['active'];
                } else {
                    // redirect with msg
                    $_SESSION['no-category'] = "<div class = 'error'>Category not found</div>";
                    header('location:' . HOME_URL . 'admin/manage-category.php', true, 301);
                }
            }
        } else {
            //redirect to manage category
            header('location:' . HOME_URL . 'admin/manage-category.php', true, 301);
        }

        ?>
        <br /><br />

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($curr_image!= '') {
                            //display image
                        ?>
                            <img src="<?php echo HOME_URL; ?>image/category/<?php echo $curr_image; ?>" width="150px">
                        <?php
                        } else {
                            //display msg
                            echo "<div class = 'error'>Image Not Added. </div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Feature: </td>
                    <td>
                        <input <?php if ($feature == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="feature" value="Yes"> Yes
                        <input <?php if ($feature == "No") {
                                    echo "checked";
                                } ?> type="radio" name="feature" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($feature == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($feature == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="curr_image" value="<?php echo $curr_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
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
    $title = $_POST['title'];
    $curr_image = $_POST['curr_image'];
    $feature = $_POST['feature'];
    $active = $_POST['active'];
    

    //2.updating image if selected
    if (isset($_FILES['image']['name'])) {
        //get image details
        $image_name = $_FILES['image']['name'];

        //image available or not
        if ($image_name!="") {
            //image available

            //1.upload new image
            //auto rename image
            //get the extension of image(jpg, png, gif, etc)
            $ext = end(explode('.', $image_name));

            //rename image
            $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;

            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = "../image/category/".$image_name;

            //Finally upload image
            $upload = move_uploaded_file($source_path, $destination_path);

            //check if uploaded or not
            //if not uploaded then we will stop the process and redirect with error message
            if ($upload == FALSE) {

                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";

                // Redirect
                header('location:' . HOME_URL . 'admin/manage-category.php');
                //stop the process
                die();
            }

            //2. remove old image if available
            if ($curr_image!= '') {
                $remove_path = "../image/category/".$curr_image;

                //remove image
                $remove = unlink($remove_path);

                //if error show msg and stop process
                if ($remove == FALSE) {
                    //set session msg
                    $_SESSION['failed-remove'] = "<div class='error'>Failed to Remove Category Image</div>";
                    //redirect
                    header('location:' . HOME_URL . 'admin/manage-category.php', true, 301);
                    //stop
                    die();
                }
            }

        }
        else{
            $image_name = $curr_image;
        }
    } 
    else {
        $image_name = $curr_image;
    }

    //3.update db
    // create sql query 

    $sql2 = "UPDATE category 
             SET title = '$title', 
             image_name = '$image_name', 
             feature = '$feature', 
             active = '$active'
             WHERE id = '$id' ";
    // execute query

    $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
    //4.check query executed 
    if ($res2 == TRUE) {
        $_SESSION['update'] = "<div class = 'success'>Category Updated</div>";
        header('location:' . HOME_URL . 'admin/manage-category.php', true, 301);
    } else {
        $_SESSION['update'] = "<div class = 'error'>Failed to Update</div>";
        header('location:' . HOME_URL . 'admin/manage-category.php', true, 301);
    }
}
?>


<?php include('partials/footer.php'); ?>