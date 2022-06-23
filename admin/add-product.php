<?php 
include('partials/header.php');
include('partials/sidebar.php');
?>

<h1 class="h3 mb-2 text-gray-800">Add New product</h1>
<?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
<form action="" method="POST" enctype="multipart/form-data">
    <h5>product Name</h5>
    <div class="form-group">
        <input type="text" name="title" id="InputName" class="form-control border-left-primary" aria-describedby="nameHelp" placeholder="Enter product Title" required>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <h5>product Description</h5>
    <div class="form-group">
    <textarea name="description" rows="4" placeholder="Description of the product" id="textArea" class="form-control border-left-info" required></textarea>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <h5>Price</h5>
    <div class="form-outline">
        <input type="number" name="price" id="typeNumber" class="form-control border-left-primary" min=1 required />
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <h5>Select product Image</h5>
    <div class="form-group">
        <input type="file" name="image" class="form-control-file" id="ControlFile">
        <small class="form-text text-muted">You can add product image later</small>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <h5>Choose Category</h5>
    <select name="category" class="custom-select border-left-primary" required>
        <option selected disabled value="">Select Category</option>
        <?php 
                                //Create PHP Code to display categories from Database
                                //1. CReate SQL to get all active categories from database
                                $sql = "SELECT * FROM wattco_category WHERE active='Yes'";
                                
                                //Executing qUery
                                $res = mysqli_query($conn, $sql);

                                //Count Rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                //IF count is greater than zero, we have categories else we donot have categories
                                if($count>0)
                                {
                                    //WE have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    //WE do not have category
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            

                                //2. Display on Drpopdown
                            ?>
    </select>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Featured -->
    <h5>Featured</h5>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="featured" value="Yes" id="inlineRadio1" required>
        <label class="form-check-label" for="inlineRadio1">Yes</label>
    </div>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="featured" value="No" id="inlineRadio2" required>
    <label class="form-check-label" for="inlineRadio2">No</label>
    </div>
    <small class="form-text text-muted">If yes, it will be added to <strong class="text-red">Wattco Home Page</strong></small>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    
    <!-- Active -->
    <h5>Active</h5>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="active" value="Yes" id="inlineRadio1" checked>
        <label class="form-check-label" for="inlineRadio1">Yes</label>
    </div>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="active" value="No" id="inlineRadio2">
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
    <input type="submit" name="submit" value="Add product" class="btn btn-primary">
</form>

        
        <?php 

            //CHeck whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add the product in Database
                //echo "Clicked";
                
                //1. Get the DAta from Form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //Check whether radion button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; //SEtting the Default Value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; //Setting Default Value
                }

                //2. Upload the Image if selected
                //Check whether the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name']))
                {
                    //Get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    //Check Whether the Image is Selected or not and upload image only if selected
                    if($image_name!="")
                    {
                        // Image is SElected
                        //A. REnamge the Image
                        //Get the extension of selected image (jpg, png, gif, etc.)
                        $ext = end(explode('.', $image_name));

                        // Create New Name for Image
                        $image_name = "product-Name-".rand(0000,9999).".".$ext; //New Image Name May Be "product-Name-657.jpg"

                        //B. Upload the Image
                        //Get the Src Path and DEstinaton path

                        // Source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        //Destination Path for the image to be uploaded
                        $dst = "../images/products/".$image_name;

                        //Finally Upload the product image
                        $upload = move_uploaded_file($src, $dst);

                        //check whether image uploaded of not
                        if($upload==false)
                        {
                            //Failed to Upload the image
                            //REdirect to Add product Page with Error Message
                            $_SESSION['upload'] = "<h2 class='text-red'>Failed to Upload Image</h2>";
                            echo("<script>location.href = '".SITEURL."admin/add-product.php';</script>");
                            //STop the process
                            die();
                        }

                    }

                }
                else
                {
                    $image_name = ""; //SEtting DEfault Value as blank
                }

                //3. Insert Into Database

                //Create a SQL Query to Save or Add product
                // For Numerical we do not need to pass value inside quotes '' But for string value it is compulsory to add quotes ''
                $sql2 = "INSERT INTO wattco_product SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //CHeck whether data inserted or not
                //4. Redirect with MEssage to Manage product page
                if($res2 == true)
                {
                    //Data inserted Successfullly
                    $_SESSION['add'] = "<h2 class='text-green'>Product Added Successfully</h2>";
                    echo("<script>location.href = '".SITEURL."admin/manage-product.php';</script>");
                }
                else
                {
                    //Failed to Insert Data
                    $_SESSION['add'] = "<h2 class='text-red'>Failed to add product - Check</h2>";
                    echo("<script>location.href = '".SITEURL."admin/manage-product.php';</script>");
                }

                
            }

        ?>

<br /><br />
<?php include('partials/footer.php'); ?>