<?php 
include('partials/header.php');
include('partials/sidebar.php');
?>

<h1 class="h3 mb-2 text-gray-800">Update product</h1>

<?php 
    //CHeck whether id is set or not 
    if(isset($_GET['id']))
    {
        //Get all the details
        $id = $_GET['id'];

        //SQL Query to Get the Selected product
        $sql2 = "SELECT * FROM wattco_product WHERE id=$id";
        //execute the Query
        $res2 = mysqli_query($conn, $sql2);

        //Get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        //Get the Individual Values of Selected product
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];

    }
    else
    {
        //Redirect to Manage product
        echo("<script>location.href = '".SITEURL."admin/manage-product.php';</script>");
    }
?>

<form action="" method="POST" enctype="multipart/form-data">
    
    <h5>Product Name</h5>
    <div class="form-group">
        <input value="<?php echo $title; ?>" type="text" name="title" id="InputName" class="form-control border-left-primary" aria-describedby="nameHelp" required>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <h5>Product Description</h5>
    <div class="form-group">
    <textarea name="description" rows="4" placeholder="Description of the product" id="textArea" class="form-control border-left-info" required><?php echo $description; ?></textarea>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <h5>Price</h5>
    <div class="form-outline">
        <input value="<?php echo $price; ?>" type="number" name="price" id="typeNumber" class="form-control border-left-primary" min=1 required />
    </div>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <h5>Current Image</h5>
    <div class="form-group">
    <?php 
                        if($current_image == "")
                        {
                            //Image not Available 
                            echo "<h2 class='text-red'>Image not Available.</h2>";
                        }
                        else
                        {
                            //Image Available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/products/<?php echo $current_image; ?>" width="150px">
                            <?php
                        }
                    ?>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <h5>Change Image</h5>
    <div class="form-group">
        <input type="file" name="image" class="form-control-file" id="ControlFile">
        <small class="form-text text-muted">Add new image.</small>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <h5>Choose Category</h5>
    <select name="category" class="custom-select border-left-primary" required>
        <?php 
                            //Query to Get ACtive Categories
                            $sql = "SELECT * FROM wattco_category WHERE active='Yes'";
                            //Execute the Query
                            $res = mysqli_query($conn, $sql);
                            //Count Rows
                            $count = mysqli_num_rows($res);

                            //Check whether category available or not
                            if($count>0)
                            {
                                //CAtegory Available
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];
                                    
                                    //echo "<option value='$category_id'>$category_title</option>";
                                    ?>
                                    <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                //CAtegory Not Available
                                echo "<option value='0'>Category Not Available</option>";
                            }

                        ?>
    </select>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Featured -->
    <h5>Featured</h5>
    <div class="form-check form-check-inline">
        <input <?php if($featured=="Yes") {echo "checked";} ?> class="form-check-input" type="radio" name="featured" value="Yes" id="inlineRadio1" required>
        <label class="form-check-label" for="inlineRadio1">Yes</label>
    </div>
    <div class="form-check form-check-inline">
    <input <?php if($featured=="No") {echo "checked";} ?> class="form-check-input" type="radio" name="featured" value="No" id="inlineRadio2" required>
    <label class="form-check-label" for="inlineRadio2">No</label>
    </div>
    <small class="form-text text-muted">If yes, it will be added to <strong class="text-red">Wattco Home Page</strong></small>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    
    <!-- Active -->
    <h5>Active</h5>
    <div class="form-check form-check-inline">
        <input <?php if($active=="Yes") {echo "checked";} ?> class="form-check-input" type="radio" name="active" value="Yes" id="inlineRadio1">
        <label class="form-check-label" for="inlineRadio1">Yes</label>
    </div>
    <div class="form-check form-check-inline">
    <input <?php if($active=="No") {echo "checked";} ?> class="form-check-input" type="radio" name="active" value="No" id="inlineRadio2">
    <label class="form-check-label" for="inlineRadio2">No</label>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="form-group">
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
        <label class="form-check-label" for="invalidCheck">
            Agree if you are sure you want to add new <strong class="text-red">product</strong>.
        </label>
        <div class="invalid-feedback">
            You must agree before submitting.
        </div>
        </div>
    </div>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
    <input type="submit" name="submit" value="Update product" class="btn btn-primary">
</form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                //echo "Button Clicked";

                //1. Get all the details from the form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];

                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2. Upload the image if selected

                //CHeck whether upload button is clicked or not
                if(isset($_FILES['image']['name']))
                {
                    //Upload BUtton Clicked
                    $image_name = $_FILES['image']['name']; //New Image NAme

                    //CHeck whether th file is available or not
                    if($image_name!="")
                    {
                        //IMage is Available
                        //A. Uploading New Image

                        //REname the Image
                        $ext = end(explode('.', $image_name)); //Gets the extension of the image

                        $image_name = "product-Name-".rand(0000, 9999).'.'.$ext; //THis will be renamed image

                        //Get the Source Path and DEstination PAth
                        $src_path = $_FILES['image']['tmp_name']; //Source Path
                        $dest_path = "../images/products/".$image_name; //DEstination Path

                        //Upload the image
                        $upload = move_uploaded_file($src_path, $dest_path);

                        /// CHeck whether the image is uploaded or not
                        if($upload==false)
                        {
                            //FAiled to Upload
                            $_SESSION['upload'] = "<h2 class='text-red'>Failed to Upload new Image</h2>";
                            //REdirect to Manage product 
                            echo("<script>location.href = '".SITEURL."admin/manage-product.php';</script>");
                            //Stop the Process
                            die();
                        }
                        //3. Remove the image if new image is uploaded and current image exists
                        //B. Remove current Image if Available
                        if($current_image!="")
                        {
                            //Current Image is Available
                            //REmove the image
                            $remove_path = "../images/products/".$current_image;

                            $remove = unlink($remove_path);

                            //Check whether the image is removed or not
                            if($remove==false)
                            {
                                //failed to remove current image
                                $_SESSION['remove-failed'] = "<h2 class='text-red'>Failed to remove current image.</h2>";
                                //redirect to manage product
                                echo("<script>location.href = '".SITEURL."admin/manage-product.php';</script>");
                                //stop the process
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image; //Default Image when Image is Not Selected
                    }
                }
                else
                {
                    $image_name = $current_image; //Default Image when Button is not Clicked
                }

                

                //4. Update the product in Database
                $sql3 = "UPDATE wattco_product SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

                //Execute the SQL Query
                $res3 = mysqli_query($conn, $sql3);

                //CHeck whether the query is executed or not 
                if($res3==true)
                {
                    //Query Exectued and product Updated
                    $_SESSION['update'] = "<h2 class='text-green'>Product Updated Successfully.</h2>";
                    echo("<script>location.href = '".SITEURL."admin/manage-product.php';</script>");
                }
                else
                {
                    //Failed to Update product
                    $_SESSION['update'] = "<h2 class='text-red'>Failed to Update product</h2>";
                    echo("<script>location.href = '".SITEURL."admin/manage-product.php';</script>");
                }

                
            }
        
        ?>
<br /><br />
<?php include('partials/footer.php'); ?>