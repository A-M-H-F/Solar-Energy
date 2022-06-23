<?php 
include('partials/header.php');
include('partials/sidebar.php');
?>

<h1 class="h3 mb-2 text-gray-800">Add New Category</h1>
<?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>
<form action="" method="POST" enctype="multipart/form-data">
    <h5>Category Name</h5>
    <div class="form-group">
        <input type="text" name="title" id="InputName" class="form-control border-left-primary" aria-describedby="nameHelp" placeholder="Enter Category Title" required>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <h5>Select Category Image</h5>
    <input type="file" name="image" />
    <small class="form-text text-muted">You can add category image later</small>

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
                Agree if you are sure you want to add new <strong class="text-red">Category</strong>.
        </label>
        <div class="invalid-feedback">
            You must agree before submitting.
        </div>
        </div>
    </div>
    <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
</form>

        <?php 
        
            //CHeck whether the Submit Button is Clicked or Not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";

                //1. Get the Value from CAtegory Form
                $title = $_POST['title'];

                //For Radio input, we need to check whether the button is selected or not
                if(isset($_POST['featured']))
                {
                    //Get the VAlue from form
                    $featured = $_POST['featured'];
                }
                else
                {
                    //SEt the Default VAlue
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                //Check whether the image is selected or not and set the value for image name accoridingly
                //print_r($_FILES['image']);

                //die();//Break the Code Here

                if(isset($_FILES['image']['name']))
                {
                    //Upload the Image
                    //To upload image we need image name, source path and destination path
                    $image_name = $_FILES['image']['name'];
                    
                    // Upload the Image only if image is selected
                    if($image_name != "")
                    {

                        //Auto Rename our Image
                        //Get the Extension of our image (jpg, png, gif, etc) e.g. "specialproduct1.jpg"
                        $ext = end(explode('.', $image_name));

                        //Rename the Image
                        $image_name = "Wattco_Category_".rand(000, 999).'.'.$ext; // e.g. Wattco_Category_834.jpg
                        

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
                            echo("<script>location.href = '".SITEURL."admin/add-category.php';</script>");
                            //STop the Process
                            die();
                        }

                    }
                }
                else
                {
                    //Don't Upload Image and set the image_name value as blank
                    $image_name="";
                }

                //2. Create SQL Query to Insert CAtegory into Database
                $sql = "INSERT INTO wattco_category SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                //3. Execute the Query and Save in Database
                $res = mysqli_query($conn, $sql);

                //4. Check whether the query executed or not and data added or not
                if($res==true)
                {
                    //Query Executed and Category Added
                    $_SESSION['add'] = "<h2 class='text-green'>Category Added Successfully</h2>";
                    //Redirect to Manage Category Page
                    echo("<script>location.href = '".SITEURL."admin/manage-category.php';</script>");
                }
                else
                {
                    //Failed to Add CAtegory
                    $_SESSION['add'] = "<h2 class='text-red'>Failed to Add Category</h2>";
                    //Redirect to Manage Category Page
                    echo("<script>location.href = '".SITEURL."admin/add-category.php';</script>");
                }
            }
        
        ?>

<br /><br />
<?php include('partials/footer.php'); ?>