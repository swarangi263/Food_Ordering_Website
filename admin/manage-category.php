<?php include('partials/menu.php'); ?>

    <!---Main Section------>
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Category</h1>
            <br />

            <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['no-category'])){
                echo $_SESSION['no-category'];
                unset($_SESSION['no-category']);
            }

            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['failed-remove'])){
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }

            ?>
            <br>

            <!-- Button Add Category-->
            <a href="add-category.php" class="btn-primary text-center">Add Category</a>
            <br /><br />


            <table class="tbl-full">
            <tr>
                <th>Sr.No.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Feature</th>
                <th>Active</th>
            </tr>
            <?php
            $sql = "SELECT * FROM category";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);

            //create serial no assign value as 1
            $sn = 1;
            if ($count > 0) {

                while ($count = $result->fetch_assoc()) {

                    $id = $count['id'];
                    $title = $count['title'];
                    $image = $count['image_name'];
                    $feature = $count['feature'];
                    $active = $count['active'];
            ?>

                    <tr>
                        <td><?php echo $sn++; ?>. </td>
                        <td><?php echo $title; ?></td>

                        <td>
                            <?php
                                //check whether image name available or not
                                if($image!=""){

                                    //display image
                                    ?>
                                    <img src="<?php echo HOME_URL; ?>image/category/<?php
                                    echo $image; ?>" width="150px">

                                    <?php 
                                }

                                else{

                                    //display msg
                                    echo '<div class="error">Image not Added. </div>';
                                }
                            ?>
                        
                        </td>
                        
                        <td><?php echo $feature; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                        <!-- <a href="#">Change Password</a> -->
                            <a href="<?php echo HOME_URL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary text-center">Update Category</a>
                            <a href="<?php echo HOME_URL; ?>admin/delete-category.php?id=<?php echo $id; ?> & image_name=<?php echo $image; ?>" class="btn-danger text-center">Delete Category</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="6"><div class="error">No Category Added. </div></td>
                </tr>
                <?php
            
            }
            ?>

        </table>


        </div>
    </div>

<?php include('partials/footer.php'); ?>

