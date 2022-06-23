<?php 
include('partials/header.php');
include('partials/sidebar.php');
?>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Manage Orders</h1>
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
                        <th style="padding-right: 130px;">product</th>
                        <th>Price</th>
                        <th>Qty.</th>
                        <th>Total</th>
                        <th style="padding-right: 130px;">Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>product</th>
                        <th>Price</th>
                        <th>Qty.</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>

                <?php 
                        //Get all the orders from database
                        $sql = "SELECT * FROM wattco_order ORDER BY id DESC"; // DIsplay the Latest Order at First
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
                                $product = $row['product'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address'];
                                
                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td class="text-gray-900"><?php echo $product; ?></td>
                                        <td style="padding-right: 40px;"><?php echo $price; ?></td>
                                        <td style="color: red; font-weight: bold;"><?php echo $qty; ?></td>
                                        <td style="padding-right: 40px;"><?php echo $total; ?></td>
                                        <td><?php echo $order_date; ?></td>

                                        <td>
                                            <?php 
                                                // Ordered, On Delivery, Delivered, Cancelled

                                                if($status=="Ordered")
                                                {
                                                    echo "<label style='color: green; font-weight: bold; padding-right: 40px;'>$status</label>";
                                                }
                                                elseif($status=="On Delivery")
                                                {
                                                    echo "<label style='color: orange; font-weight: bold; padding-right: 40px;'>$status</label>";
                                                }
                                                elseif($status=="Delivered")
                                                {
                                                    echo "<label style='color: green; font-weight: bold; padding-right: 40px;'>$status</label>";
                                                }
                                                elseif($status=="Cancelled")
                                                {
                                                    echo "<label style='color: red; font-weight: bold; padding-right: 40px;'>$status</label>";
                                                }
                                            ?>
                                        </td>

                                        <td style="padding-right: 100px;"><?php echo $customer_name; ?></td>
                                        <td style="padding-right: 60px;"><?php echo $customer_contact; ?></td>
                                        <td style="padding-right: 60px;"><?php echo $customer_email; ?></td>
                                        <td style="padding-right: 130px;"><?php echo $customer_address; ?></td>
                                        <td style="padding-right: 20px;">
                                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn btn-primary" style="width: 130px;">Update Order</a>
                                        </td>
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                            //Order not Available
                            echo "<tr><td colspan='12' class='text-red'>Orders not Available</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>