<?php 
include('partials/header.php');
include('partials/sidebar.php');
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                ?>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Total Categories -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <?php 
                                //Sql Query 
                                $sql = "SELECT * FROM wattco_category";
                                //Execute Query
                                $res = mysqli_query($conn, $sql);
                                //Count Rows
                                $count = mysqli_num_rows($res);
                            ?>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <a href="<?php echo SITEURL; ?>admin/manage-category.php">Categories</a>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total products -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <?php 
                                //Sql Query 
                                $sql2 = "SELECT * FROM wattco_product";
                                //Execute Query
                                $res2 = mysqli_query($conn, $sql2);
                                //Count Rows
                                $count2 = mysqli_num_rows($res2);
                            ?>
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    <a href="<?php echo SITEURL; ?>admin/manage-product.php">products</a>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count2; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <?php 
                                //Sql Query 
                                $sql3 = "SELECT * FROM wattco_order";
                                //Execute Query
                                $res3 = mysqli_query($conn, $sql3);
                                //Count Rows
                                $count3 = mysqli_num_rows($res3);
                            ?>
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                <a href="<?php echo SITEURL; ?>admin/manage-order.php">Total Orders</a>
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $count3; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings-->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <?php 
                                //Creat SQL Query to Get Total Revenue Generated
                                //Aggregate Function in SQL
                                $sql4 = "SELECT SUM(total) AS Total FROM wattco_order WHERE status='Delivered'";

                                //Execute the Query
                                $res4 = mysqli_query($conn, $sql4);

                                //Get the VAlue
                                $row4 = mysqli_fetch_assoc($res4);
                                
                                //GEt the Total REvenue
                                $total_revenue = $row4['Total'];

                            ?>
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Earnings (Annual)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$<?php echo $total_revenue; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('partials/charts.php'); ?>
        </div>

<?php include('partials/footer.php') ?>