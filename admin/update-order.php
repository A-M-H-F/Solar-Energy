<?php 
include('partials/header.php');
include('partials/sidebar.php');
?>

<h1 class="h3 mb-2 text-gray-800">Update Order</h1>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
<?php 
        
            //CHeck whether id is set or not
            if(isset($_GET['id']))
            {
                //GEt the Order Details
                $id=$_GET['id'];

                //Get all other details based on this id
                //SQL Query to get the order details
                $sql = "SELECT * FROM wattco_order WHERE id=$id";
                //Execute Query
                $res = mysqli_query($conn, $sql);
                //Count Rows
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Detail Availble
                    $row=mysqli_fetch_assoc($res);

                    $product = $row['product'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address= $row['customer_address'];
                }
                else
                {
                    //Detail not Available/
                    //Redirect to Manage Order
                    echo("<script>location.href = '".SITEURL."admin/manage-order.php';</script>");
                }
            }
            else
            {
                //REdirect to Manage ORder PAge
                echo("<script>location.href = '".SITEURL."admin/manage-order.php';</script>");
            }
        
        ?>


<form action="" method="POST" enctype="multipart/form-data">
    <h5>Product Name</h5>
    <div class="form-group border-bottom-primary">
        <?php echo $product; ?>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <h5>Price</h5>
    <div class="form-outline border-bottom-primary">
        $ <?php echo $price; ?>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <h5>Quantity</h5>
    <div class="form-group">
        <input value="<?php echo $qty; ?>" type="number" name="qty" id="InputName" class="form-control border-left-primary" aria-describedby="nameHelp" required>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <h5>Status</h5>
    <select name="status" class="custom-select border-left-primary" required>
        <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
        <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
        <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
        <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
    </select>
    <small class="form-text text-muted">Set Order Status.</small>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <h5>Customer Name</h5>
    <div class="form-group">
        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>" id="InputName" class="form-control border-left-primary" aria-describedby="nameHelp" required>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <h5>Customer Contact</h5>
    <div class="form-group">
        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>" id="InputName" class="form-control border-left-primary" aria-describedby="nameHelp" required>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <h5>Customer Email</h5>
    <div class="form-group">
        <input type="email" name="customer_email" value="<?php echo $customer_email; ?>" id="InputName" class="form-control border-left-primary" aria-describedby="nameHelp" required>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <h5>Customer Address</h5>
    
    <div class="form-group">
    <textarea name="customer_address" rows="4" id="textArea" class="form-control border-left-info" required><?php echo $customer_address; ?></textarea>
    </div>

    <div class="form-group">
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
        <label class="form-check-label" for="invalidCheck">
            Agree if you are sure you want to update <strong class="text-red">Order Details</strong>.
        </label>
        <div class="invalid-feedback">
            You must agree before submitting.
        </div>
        </div>
    </div>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="price" value="<?php echo $price; ?>">
    <input type="submit" name="submit" value="Update Order" class="btn btn-primary">
</form>


        <?php 
            //CHeck whether Update Button is Clicked or Not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //Get All the Values from Form
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty;

                $status = $_POST['status'];

                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];

                //Update the Values
                $sql2 = "UPDATE wattco_order SET 
                    qty = $qty,
                    total = $total,
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    WHERE id=$id
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //CHeck whether update or not
                //And REdirect to Manage Order with Message
                if($res2==true)
                {
                    //Updated
                    $_SESSION['update'] = "<h2 class='text-green'>Order Updated Successfully</h2>";
                    echo("<script>location.href = '".SITEURL."admin/manage-order.php';</script>");
                }
                else
                {
                    //Failed to Update
                    $_SESSION['update'] = "<h2 class='text-red'>Failed to Update Order</h2>";
                    echo("<script>location.href = '".SITEURL."admin/manage-order.php';</script>");
                }
            }
        ?>

<br /><br />
<?php include('partials/footer.php'); ?>
