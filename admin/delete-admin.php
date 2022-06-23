<?php 

    //Include constants.php file here
    include('../config/constants.php');

    // 1. get the ID of Admin to be deleted
    $id = $_GET['id'];

    //2. Create SQL Query to Delete Admin
    $sql = "DELETE FROM wattco_admin WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    // Check whether the query executed successfully or not
    if($res==true)
    {
        //Query Executed Successully and Admin Deleted
        //echo "Admin Deleted";
        //Create SEssion Variable to Display Message
        $_SESSION['delete'] = "<h2 class='text-green'>Admin Deleted Successfully</h2>";
        //Redirect to Manage Admin Page
        echo("<script>location.href = '".SITEURL."admin/manage-admin.php';</script>");  
    }
    else
    {
        //Failed to Delete Admin
        //echo "Failed to Delete Admin";

        $_SESSION['delete'] = "<h2 class='text-red'>Failed To Delete Admin. Try Again</h2>";
        echo("<script>location.href = '".SITEURL."admin/manage-admin.php';</script>");
    }

    //3. Redirect to Manage Admin page with message (success/error)

?>