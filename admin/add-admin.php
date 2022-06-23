<?php 
include('partials/header.php');
include('partials/sidebar.php');
?>

<h1 class="h3 mb-2 text-gray-800">Add New Admin</h1>
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
    <input type="text" name="full_name" class="form-control border-left-primary" id="InputName" aria-describedby="nameHelp" placeholder="Enter Full Name" required>
    <small id="emailHelp" class="form-text text-muted">Nice to have new admin in <strong class="text-red">Wattco Store</strong></small>
  </div>
  <div class="form-group">
    <label for="InputUsername">Username</label>
    <input type="text" name="username" id="InputUsername" placeholder="Username" class="form-control border-left-success" required>
  </div>
  <div class="form-group">
    <label for="InputPassword">Password</label>
    <input type="password" name="password" class="form-control border-left-danger" id="InputPassword" placeholder="Password" required>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        Agree if you are sure you want to add new <strong class="text-red">admin</strong>.
      </label>
      <div class="invalid-feedback">
        You must agree before submitting.
      </div>
    </div>
  </div>
  <input type="submit" name="submit" value="Add Admin" class="btn btn-primary">
</form>

<?php 
    //Process the Value from Form and Save it in Database

    //Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        // Button Clicked
        //echo "Button Clicked";

        //1. Get the Data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password Encryption with MD5

        //2. SQL Query to Save the data into database
        $sql = "INSERT INTO wattco_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
 
        //3. Executing Query and Saving Data into Datbase
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
        if($res==TRUE)
        {
            //Data Inserted
            //echo "Data Inserted";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<h2 class='text-green'>Admin Added Successfully</h2>";
            //Redirect Page to Manage Admin
            echo("<script>location.href = '".SITEURL."admin/manage-admin.php';</script>");
        }
        else
        {
            //FAiled to Insert DAta
            //echo "Faile to Insert Data";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<h2 class='text-red'>Failed to add new admin</h2>";
            //Redirect Page to Add Admin
            echo("<script>location.href = '".SITEURL."admin/add-admin.php';</script>");
        }

    }
    
?>

<br /><br />
<?php include('partials/footer.php'); ?>