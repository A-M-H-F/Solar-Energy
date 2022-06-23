    <?php include('partials-front/menu.php'); ?>

    <!-- product sEARCH Section Starts Here -->
    <section class="product-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>product-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for product.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!-- product sEARCH Section Ends Here -->

    <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Categories</h2>

            <?php 
                //Create SQL Query to Display CAtegories from Database
                $sql = "SELECT * FROM wattco_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                //Execute the Query
                $res = mysqli_query($conn, $sql);
                //Count rows to check whether the category is available or not
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //CAtegories Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the Values like id, title, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        
                        <a href="<?php echo SITEURL; ?>category-products.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    //Check whether Image is available or not
                                    if($image_name=="")
                                    {
                                        //Display MEssage
                                        echo "<h5 class='text-red'>Image not Available</h5>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image_name; ?>" alt="Watcco" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                

                                <h3 class="text-black"><?php echo $title; //class="float-text" ?></h3>
                                
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    //Categories not Available
                    echo "<h3 class='text-red'>Category not Added.</h3>";
                }
            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <!-- product MEnu Section Starts Here -->
    <section class="product-menu">
        <div class="container">
            <h2 class="text-center">Products</h2>

            <?php 
            
            //Getting products from Database that are active and featured
            //SQL Query
            $sql2 = "SELECT * FROM wattco_product WHERE active='Yes' AND featured='Yes' LIMIT 6";

            //Execute the Query
            $res2 = mysqli_query($conn, $sql2);

            //Count Rows
            $count2 = mysqli_num_rows($res2);

            //CHeck whether product available or not
            if($count2>0)
            {
                //product Available
                while($row=mysqli_fetch_assoc($res2))
                {
                    //Get all the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="product-menu-box">
                        <div class="product-menu-img">
                            <?php 
                                //Check whether image available or not
                                if($image_name=="")
                                {
                                    //Image not Available
                                    echo "<h5 class='text-red'>Image not available.</h5>";
                                }
                                else
                                {
                                    //Image Available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/products/<?php echo $image_name; ?>" alt="Watcco" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            
                        </div>

                        <div class="product-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="product-price">$<?php echo $price; ?></p>
                            <p class="product-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?product_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>

                    <?php
                }
            }
            else
            {
                //product Not Available 
                echo "<h3 class='text-red'>Product not available.</h3>";
            }
            
            ?>

            

 

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="./products.php">See All products</a>
        </p>
    </section>
    <!-- product Menu Section Ends Here -->

    
    <?php include('partials-front/footer.php'); ?>