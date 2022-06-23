<?php 
include('partials/header.php');
include('partials/sidebar.php');
?>

<h1 class="h3 mb-2 text-gray-800">Update Admin Setting</h1>
<?php 
            //1. Get the ID of Selected Admin
            $id=$_GET['id'];

            //2. Create SQL Query to Get the Details
            $sql="SELECT * FROM wattco_admin WHERE id=$id";

            //Execute the Query
            $res=mysqli_query($conn, $sql);

            //Check whether the query is executed or not
            if($res==true)
            {
                // Check whether the data is available or not
                $count = mysqli_num_rows($res);
                //Check whether we have admin data or not
                if($count==1)
                {
                    // Get the Details
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    //Redirect to Manage Admin PAge
                    echo("<script>location.href = '".SITEURL."admin/manage-admin.php';</script>");
                }
            }
        
        ?>

<?php 
            if(isset($_SESSION['add'])) //Checking whether the SEssion is Set of Not
            {
                echo $_SESSION['add']; //Display the SEssion Message if SEt
                unset($_SESSION['add']); //Remove Session Message
            }
        ?>
<form action="" method="POST">
  <div class="form-group">
    <label for="InputName">Full Name</label>
    <input type="text" name="full_name" class="form-control border-left-primary" id="InputName" value="<?php echo $full_name; ?>">
    <small id="emailHelp" class="form-text text-muted">Updating..... <strong class="text-red">@ Wattco Store</strong></small>
  </div>
  <div class="form-group">
    <label for="InputUsername">Username</label>
    <input type="text" name="username" id="InputUsername" value="<?php echo $username; ?>" class="form-control border-left-success" required>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        Agree if you are sure you want to update <strong class="text-red">Admin Details</strong>
      </label>
      <div class="invalid-feedback">
        You must agree before submitting
      </div>
    </div>
  </div>
  <input type="hidden" name="id" value="<?php echo $id; ?>">
  <input type="submit" name="submit" value="Update Admin" class="btn btn-primary">
</form>

<?php 

    //Check whether the Submit Button is Clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Button CLicked";
        //Get all the values from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //Create a SQL Query to Update Admin
        $sql = "UPDATE wattco_admin SET
        full_name = '$full_name',
        username = '$username' 
        WHERE id='$id'
        ";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed successfully or not
        if($res==true)
        {
            //Query Executed and Admin Updated
            $_SESSION['update'] = "<h2 class='text-green'>Admin Updated Successfully</h2>";
            //Redirect to Manage Admin Page
            echo("<script>location.href = '".SITEURL."admin/manage-admin.php';</script>");
        }
        else
        {
            //Failed to Update Admin
            $_SESSION['update'] = "<h2 class='text-red'>Failed to Delete Admin.</h2>";
            //Redirect to Manage Admin Page
            echo("<script>location.href = '".SITEURL."admin/manage-admin.php';</script>");
        }
    }

?>

<br /><br />
<?php include('partials/footer.php'); ?>