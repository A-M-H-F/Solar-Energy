<?php 
include('partials/header.php');
include('partials/sidebar.php');
?>

<h1 class="h3 mb-2 text-gray-800">Update Admin Password</h1>
<?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>






<form action="" method="POST">

    <div class="form-group">
        <label for="InputPassword">Current Password</label>
        <input type="password" name="current_password" placeholder="Current Password" class="form-control border-left-danger" id="InputPassword" required>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="form-group">
        <label for="InputPassword">New Password</label>
        <input type="password" name="new_password" placeholder="New Password" class="form-control border-left-danger" id="InputPassword" required>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="form-group">
        <label for="InputPassword">Confirm Password</label>
        <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control border-left-danger" id="InputPassword" required>
    </div>

    <div class="form-group">
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
        <label class="form-check-label" for="invalidCheck">
            Agree if you are sure you want to change <strong class="text-red">Admin Password</strong>
        </label>
        <div class="invalid-feedback">
            You must agree before submitting
        </div>
        </div>
    </div>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="submit" name="submit" value="Change Password" class="btn btn-primary">
</form>

<?php 

            //CHeck whether the Submit Button is Clicked on Not
            if(isset($_POST['submit']))
            {
                //echo "CLicked";

                //1. Get the DAta from Form
                $id=$_POST['id'];
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);


                //2. Check whether the user with current ID and Current Password Exists or Not
                $sql = "SELECT * FROM wattco_admin WHERE id=$id AND password='$current_password'";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    //CHeck whether data is available or not
                    $count=mysqli_num_rows($res);

                    if($count==1)
                    {
                        //User Exists and Password Can be CHanged
                        //echo "User FOund";

                        //Check whether the new password and confirm match or not
                        if($new_password==$confirm_password)
                        {
                            //Update the Password
                            $sql2 = "UPDATE wattco_admin SET 
                                password='$new_password' 
                                WHERE id=$id
                            ";

                            //Execute the Query
                            $res2 = mysqli_query($conn, $sql2);

                            //CHeck whether the query exeuted or not
                            if($res2==true)
                            {
                                //Display Succes Message
                                //REdirect to Manage Admin Page with Success Message
                                $_SESSION['change-pwd'] = "<h2 class='text-green'>Password Changed Successfully</div>";
                                //Redirect the User
                                echo("<script>location.href = '".SITEURL."admin/manage-admin.php';</script>");
                            }
                            else
                            {
                                //Display Error Message
                                //REdirect to Manage Admin Page with Error Message
                                $_SESSION['change-pwd'] = "<h2 class='text-red'>Failed to Change Password</h2>";
                                //Redirect the User
                                echo("<script>location.href = '".SITEURL."admin/manage-admin.php';</script>");
                            }
                        }
                        else
                        {
                            //REdirect to Manage Admin Page with Error Message
                            $_SESSION['pwd-not-match'] = "<h2 class='text-red'>Password Did not Patch</h2>";
                            //Redirect the User
                            echo("<script>location.href = '".SITEURL."admin/manage-admin.php';</script>");
                        }
                    }
                    else
                    {
                        //User Does not Exist Set Message and REdirect
                        $_SESSION['user-not-found'] = "<h2 class='text-red'>User Not Found</h2>";
                        //Redirect the User
                        echo("<script>location.href = '".SITEURL."admin/manage-admin.php';</script>");
                    }
                }

                //3. CHeck Whether the New Password and Confirm Password Match or not

                //4. Change PAssword if all above is true
            }

?>


<?php include('partials/footer.php'); ?>