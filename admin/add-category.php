<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>
        <!-- Add  -->

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="CategoryTitle" required></td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Feature:</td>
                    <td>
                        <input type="radio" name="feature" value="Yes">Yes
                        <input type="radio" name="feature" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>

                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        // process the value and save it in database
        // check whether the button is clicked or not

        if (isset($_POST['submit'])) {
            // button clicked
            // 1. get data
            $title = $_POST['title'];

            //2For radio input check whether button is selected or not
            if (isset($_POST['feature'])) {
                //Get value from form
                $feature = $_POST['feature'];
            } else {
                //set default value
                $feature = "No";
            }

            if (isset($_POST['active'])) {
                //Get value from form
                $active = $_POST['active'];
            } else {
                //set default value
                $active = "No";
            }

            //check whether image is selected or not and set the value for image name acc
            //print_r($_FILES['image']);
            //die();

            if (isset($_FILES['image']['name'])) {

                //Upload image
                //to upload we need image name, source path and destination path
                $image_name = $_FILES['image']['name'];

                //upload the image only if image is selected
                if ($image_name != '') {


                    //auto rename image
                    //get the extension of image(jpg, png, gif, etc)
                    $ext = end(explode('.', $image_name));

                    //rename image
                    $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../image/category/" . $image_name;

                    //Finally upload image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //check if uploaded or not
                    //if not uploaded then we will stop the process and redirect with error message
                    if ($upload == FALSE) {

                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";

                        // Redirect
                        header('location:' . HOME_URL . 'admin/add-category.php');
                        //stop the process
                        die();
                    }
                }
            } else {
                //don't upload image and set name as blank

                $image_name = "";
            }

            //2.query to insert into db

            $input = "INSERT INTO category(title,feature,active,image_name) VALUES ('$title','$feature','$active', '$image_name')";

            // 3. execute query and saving data in db

            $result = mysqli_query($conn, $input) or die(mysqli_error($conn));

            // 4. check if data is added and executed query
            if ($result == TRUE) {
                // Data inserted
                // Create session variable
                $_SESSION['add'] = "<div class= 'success'>Category Added Successfully. </div>";

                // Redirect
                header('location:' . HOME_URL . 'admin/manage-category.php');
            } else {

                $_SESSION['add'] = "<div class= 'error'>Failed to Add Category. </div>";

                // Redirect
                header('location:' . HOME_URL . 'admin/add-category.php');
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>