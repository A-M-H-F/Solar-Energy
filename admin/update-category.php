<?php 
include('partials/header.php');
include('partials/sidebar.php');
?>

<h1 class="h3 mb-2 text-gray-800">Update Category</h1>

<?php 
        
            //Check whether the id is set or not
            if(isset($_GET['id']))
            {
                //Get the ID and all other details
                //echo "Getting the Data";
                $id = $_GET['id'];
                //Create SQL Query to get all other details
                $sql = "SELECT * FROM wattco_category WHERE id=$id";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count the Rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    //redirect to manage category with session message
                    $_SESSION['no-category-found'] = "<h2 class='text-red'>Category not Found</h2>";
                    echo("<script>location.href = '".SITEURL."admin/manage-category.php';</script>");
                }

            }
            else
            {
                //redirect to Manage CAtegory
                echo("<script>location.href = '".SITEURL."admin/manage-category.php';</script>");
            }
        
        ?>

<form action="" method="POST" enctype="multipart/form-data">
    <h5>Category Name</h5>
    <div class="form-group">
        <input type="text" name="title" value="<?php echo $title; ?>" id="InputName" class="form-control border-left-primary" aria-describedby="nameHelp" required>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <h5>Current Image</h5>
    <?php 
                            if($current_image != "")
                            {
                                //Display the Image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                //Display Message
                                echo "<h5 class='text-red'>Image Not Added</h5>";
                            }
                        ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <h5>Change Image</h5>
    <input type="file" name="image" />

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Featured -->
    <h5>Featured</h5>
    <div class="form-check form-check-inline">
        <input <?php if($featured=="Yes"){echo "checked";} ?> class="form-check-input" type="radio" name="featured" value="Yes" id="inlineRadio1" required>
        <label class="form-check-label" for="inlineRadio1">Yes</label>
    </div>
    <div class="form-check form-check-inline">
    <input <?php if($featured=="No"){echo "checked";} ?> class="form-check-input" type="radio" name="featured" value="No" id="inlineRadio2" required>
    <label class="form-check-label" for="inlineRadio2">No</label>
    </div>
    <small class="form-text text-muted">If yes, it will be added to <strong class="text-red">Wattco Home Page</strong></small>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    
    <!-- Active -->
    <h5>Active</h5>
    <div class="form-check form-check-inline">
        <input <?php if($active=="Yes"){echo "checked";} ?> class="form-check-input" type="radio" name="active" value="Yes" id="inlineRadio1">
        <label class="form-check-label" for="inlineRadio1">Yes</label>
    </div>
    <div class="form-check form-check-inline">
        <input <?php if($active=="No"){echo "checked";} ?> class="form-check-input" type="radio" name="active" value="No" id="inlineRadio2">
        <label class="form-check-label" for="inlineRadio2">No</label>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
            <label class="form-check-label" for="invalidCheck">
                Agree if you are sure you want to add new <strong class="text-red">Category</strong>.
        </label>
        <div class="invalid-feedback">
            You must agree before submitting.
        </div>
        </div>
    </div>
    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="submit" name="submit" value="Update Category" class="btn btn-primary">
</form>


        <?php 
        
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //1. Get all the values from our form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2. Updating New Image if selected
                //Check whether the image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //Get the Image Details
                    $image_name = $_FILES['image']['name'];

                    //Check whether the image is available or not
                    if($image_name != "")
                    {
                        //Image Available

                        //A. UPload the New Image

                        //Auto Rename our Image
                        //Get the Extension of our image (jpg, png, gif, etc) e.g. "specialproduct1.jpg"
                        $ext = end(explode('.', $image_name));

                        //Rename the Image
                        $image_name = "product_Category_".rand(000, 999).'.'.$ext; // e.g. product_Category_834.jpg
                        

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether the image is uploaded or not
                        //And if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            //SEt message
                            $_SESSION['upload'] = "<h2 class='text-red'>Failed to Upload Image</h2>";
                            //Redirect to Add CAtegory Page
                            echo("<script>location.href = '".SITEURL."admin/manage-category.php';</script>");
                            //STop the Process
                            die();
                        }

                        //B. Remove the Current Image if available
                        if($current_image!="")
                        {
                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);

                            //CHeck whether the image is removed or not
                            //If failed to remove then display message and stop the processs
                            if($remove==false)
                            {
                                //Failed to remove image
                                $_SESSION['failed-remove'] = "<h2 class='text-red'>Failed to remove current Image</h2>";
                                echo("<script>location.href = '".SITEURL."admin/manage-category.php';</script>");
                                die();//Stop the Process
                            }
                        }
                        

                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                //3. Update the Database
                $sql2 = "UPDATE wattco_category SET 
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active' 
                    WHERE id=$id
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //4. REdirect to Manage Category with MEssage
                //CHeck whether executed or not
                if($res2==true)
                {
                    //Category Updated
                    $_SESSION['update'] = "<h2 class='text-green'>Category Updated Successfully</h2>";
                    echo("<script>location.href = '".SITEURL."admin/manage-category.php';</script>");
                }
                else
                {
                    //failed to update category
                    $_SESSION['update'] = "<h2 class='text-red'>Failed to Update Category</h2>";
                    echo("<script>location.href = '".SITEURL."admin/manage-category.php';</script>");
                }

            }
        
        ?>

<br /><br />
<?php include('partials/footer.php'); ?>