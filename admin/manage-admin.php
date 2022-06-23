<?php 
include('partials/header.php');
include('partials/sidebar.php');
?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Manage Admin</h1>
<?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; //Displaying Session Message
                        unset($_SESSION['add']); //REmoving Session Message
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }

                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }

                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }

                ?>
<!-- Button to Add Admin -->
<a href="<?php echo SITEURL; ?>admin/add-admin.php" class="btn btn-primary">Add New Admin</a>
<br /><br />
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Available</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                <?php 
                            //Query to Get all Admin
                            $sql = "SELECT * FROM wattco_admin";
                            //Execute the Query
                            $res = mysqli_query($conn, $sql);

                            //CHeck whether the Query is Executed of Not
                            if($res==TRUE)
                            {
                                // Count Rows to CHeck whether we have data in database or not
                                $count = mysqli_num_rows($res); // Function to get all the rows in database

                                $sn=1; //Create a Variable and Assign the value

                                //CHeck the num of rows
                                if($count>0)
                                {
                                    //WE HAve data in database
                                    while($rows=mysqli_fetch_assoc($res))
                                    {
                                        //Using While loop to get all the data from database.
                                        //And while loop will run as long as we have data in database

                                        //Get individual DAta
                                        $id=$rows['id'];
                                        $full_name=$rows['full_name'];
                                        $username=$rows['username'];

                                        //Display the Values in our Table
                                        ?>
                                        
                                        <tr>
                                            <td><?php echo $sn++; ?></td>
                                            <td><?php echo $full_name; ?></td>
                                            <td><?php echo $username; ?></td>
                                            <td>
                                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn btn-warning">Change Password</a> |
                                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn btn-primary">Update Admin</a> |
                                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn btn-danger">Delete Admin</a>
                                            </td>
                                        </tr>

                                        <?php

                                    }
                                }
                                else
                                {
                                    //We Do not Have Data in Database
                                }
                            }

                        ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>