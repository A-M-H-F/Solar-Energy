<?php 
    //Include Constants File
    include('../config/constants.php');

    //echo "Delete Page";
    //Check whether the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the Value and Delete
        //echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical image file is available
        if($image_name != "")
        {
            //Image is Available. So remove it
            $path = "../images/category/".$image_name;
            //REmove the Image
            $remove = unlink($path);

            //IF failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                //Set the SEssion Message
                $_SESSION['remove'] = "<h2 class='text-red'>Failed to Remove Category Image</h2>";
                //REdirect to Manage Category page
                echo("<script>location.href = '".SITEURL."admin/manage-category.php';</script>");
                //Stop the Process
                die();
            }
        }

        //Delete Data from Database
        //SQL Query to Delete Data from Database
        $sql = "DELETE FROM wattco_category WHERE id=$id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the data is delete from database or not
        if($res==true)
        {
            //SEt Success MEssage and REdirect
            $_SESSION['delete'] = "<h2 class='text-green'>Category Deleted Successfully.</h2>";
            //Redirect to Manage Category
            echo("<script>location.href = '".SITEURL."admin/manage-category.php';</script>");  
        }
        else
        {
            //SEt Fail MEssage and Redirecs
            $_SESSION['delete'] = "<h2 class='text-red'>Failed to Delete Category.</h2>";
            //Redirect to Manage Category
            echo("<script>location.href = '".SITEURL."admin/manage-category.php';</script>");
        }

 

    }
    else
    {
        //redirect to Manage Category Page
        echo("<script>location.href = '".SITEURL."admin/manage-category.php';</script>");  
    }
?>