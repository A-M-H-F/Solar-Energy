<?php 
    //Include COnstants Page
    include('../config/constants.php');

    //echo "Delete product Page";

    if(isset($_GET['id']) && isset($_GET['image_name'])) //Either use '&&' or 'AND'
    {
        //Process to Delete
        //echo "Process to Delete";

        //1.  Get ID and Image NAme
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. Remove the Image if Available
        //CHeck whether the image is available or not and Delete only if available
        if($image_name != "")
        {
            // IT has image and need to remove from folder
            //Get the Image Path
            $path = "../images/products/".$image_name;

            //REmove Image File from Folder
            $remove = unlink($path);

            //Check whether the image is removed or not
            if($remove==false)
            {
                //Failed to Remove image
                $_SESSION['upload'] = "<h2 class='text-red'>Failed to Remove Image</h2>";
                //REdirect to Manage product
                echo("<script>location.href = '".SITEURL."admin/manage-product.php';</script>");
                //Stop the Process of Deleting product
                die();
            }

        }

        //3. Delete product from Database
        $sql = "DELETE FROM wattco_product WHERE id=$id";
        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //CHeck whether the query executed or not and set the session message respectively
        //4. Redirect to Manage product with Session Message
        if($res==true)
        {
            //product Deleted
            $_SESSION['delete'] = "<h2 class='text-green'>product Deleted Successfully</h2>";
            echo("<script>location.href = '".SITEURL."admin/manage-product.php';</script>");
        }
        else
        {
            //Failed to Delete product
            $_SESSION['delete'] = "<h2 class='text-red'>Failed to Delete product</h2>";
            echo("<script>location.href = '".SITEURL."admin/manage-product.php';</script>");
        }

        

    }
    else
    {
        //Redirect to Manage product Page
        //echo "REdirect";
        $_SESSION['unauthorize'] = "<h2 class='text-red'>Unauthorized Access</h2>";
        echo("<script>location.href = '".SITEURL."admin/manage-product.php';</script>");
    }

?>