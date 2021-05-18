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

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Food Title"></td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea style="resize:none" name="description" cols="30" rows="10" placeholder="Enter Description" style="display: flex;"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="description" placeholder="Enter Price"></td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            //create code to display categories from db
                            //1.create sql to get all active queries from db
                            $sql = "SELECT * FROM category WHERE active = 'Yes' ";
                            //executing query
                            $res = mysqli_query($conn, $sql);
                            //count rows
                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                //display
                                while ($row = mysqli_fetch_assoc($res)) {
                                    //get the details
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>
                                    <!-- //2. display dropdown -->
                                    <option value="<?php echo $id; ?>"> <?php echo $title; ?> </option>
                                <?php
                                }
                            } else {
                                //no values found
                                ?>
                                <option value="0">No Category Found</option>

                            <?php
                            }

                            ?>
                        </select>
                    </td>
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





    </div>
</div>







<?php include('partials/footer.php'); ?>