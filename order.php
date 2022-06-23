
<?php include('partials-front/menu.php'); ?>

    <?php 
        //CHeck whether product id is set or not
        if(isset($_GET['product_id']))
        {
            //Get the product id and details of the selected product
            $product_id = $_GET['product_id'];

            //Get the DEtails of the SElected product
            $sql = "SELECT * FROM wattco_product WHERE id=$product_id";
            //Execute the Query
            $res = mysqli_query($conn, $sql);
            //Count the rows
            $count = mysqli_num_rows($res);
            //CHeck whether the data is available or not
            if($count==1)
            {
                //WE Have DAta
                //GEt the Data from Database
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                //product not Availabe
                //REdirect to Home Page
                echo("<script>location.href = '".SITEURL."';</script>");
            }
        }
        else
        {
            //Redirect to homepage
            echo("<script>location.href = '".SITEURL."';</script>");
        }
    ?>

    <!-- product sEARCH Section Starts Here -->
    <section class=""> <!-- class background img -->
        <div class="container">
            
            <h2 class="text-center text-black">Fill This Form To Confirm Your Order</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected product</legend>

                    <div class="product-menu-img">
                        <?php 
                        
                            //CHeck whether the image is available or not
                            if($image_name=="")
                            {
                                //Image not Availabe
                                echo "<h5 class='text-red'>Image not Available</h5>";
                            }
                            else
                            {
                                //Image is Available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/products/<?php echo $image_name; ?>" alt="Wattco" class="img-responsive img-curve">
                                <?php
                            }
                        
                        ?>
                        
                    </div>
    
                    <div class="product-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="product" value="<?php echo $title; ?>">

                        <p class="product-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Shipping Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Ali Rahme" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="+961....." class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="admin@wattco.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-danger">
                </fieldset>

            </form>

            <?php 

                //CHeck whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    // Get all the details from the form

                    $product = $_POST['product'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty; // total = price x qty 

                    $order_date = date("Y-m-d h:i:sa"); //Order DAte

                    $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];


                    //Save the Order in Databaase
                    //Create SQL to save the data
                    $sql2 = "INSERT INTO wattco_order SET 
                        product = '$product',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    //echo $sql2; die();

                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);

                    //Check whether query executed successfully or not
                    if($res2==true)
                    {
                        //Query Executed and Order Saved
                        $_SESSION['order'] = "<h3 class='text-green text-center order-padding'>Product Ordered Successfully</h3>";
                        echo("<script>location.href = '".SITEURL."';</script>");
                    }
                    else
                    {
                        //Failed to Save Order
                        $_SESSION['order'] = "<h3 class='text-red text-center'>Failed to Order Product</h3>";
                        echo("<script>location.href = '".SITEURL."';</script>");
                    }

                }
            
            ?>

        </div>
    </section>
    <!-- product sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>