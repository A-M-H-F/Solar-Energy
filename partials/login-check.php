<?php 

    //AUthorization - Access COntrol
    //CHeck whether the user is logged in or not
    if(!isset($_SESSION['user'])) //IF user session is not set
    {
        //User is not logged in
        //REdirect to login page with message
        $_SESSION['no-login-message'] = "<h6 class='text-red text-center'>Please login to access Wattco Admin Panel</h6>";
        //REdirect to Login Page
        header('location:'.SITEURL.'admin/login.php');
    }

?>
<!-- Developed by AMHF @ June . 2022 -->