<?php 
include('partials/header.php');
include('partials/sidebar.php');
?>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Mail</h1>


<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Manage Mail</h1>
<?php 
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>

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
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Mail Date</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Mail Date</th>
                    </tr>
                </tfoot>
                <tbody>

                <?php 
                        //Get all the orders from database
                        $sql = "SELECT * FROM contact_inquiry ORDER BY id DESC"; // DIsplay the Latest Order at First
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //Count the Rows
                        $count = mysqli_num_rows($res);

                        $sn = 1; //Create a Serial Number and set its initail value as 1

                        if($count>0)
                        {
                            //Order Available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Get all the order details
                                $id = $row['id'];
                                $fname = $row['fname'];
                                $lname = $row['lname'];
                                $email = $row['email'];
                                $subject = $row['subject'];
                                $message = $row['message'];
                                $created_at = $row['created_at'];
                                
                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td class="text-gray-900"><?php echo $fname; ?></td>
                                        <td style="padding-right: 40px;"><?php echo $lname; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td style="padding-right: 40px;"><?php echo $subject; ?></td>
                                        <td style="padding-right: 100px;"><?php echo $message; ?></td>
                                        <td><?php echo $created_at; ?></td>
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                            //Order not Available
                            echo "<tr><td colspan='12' class='text-red'>No Emails Recieved Yet</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>














<?php include('partials/footer.php'); ?>