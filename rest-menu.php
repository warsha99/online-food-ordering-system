<?php include('config/constants.php'); ?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" type="image/png" href="images/i.png" />
    <link rel="stylesheet" href="rest-menu.css">
    <link href="https://fonts.googleapis.com/css2?family=Love+Ya+Like+A+Sister&display=swap" rel="stylesheet">
    <title>FIFTY SHADES OF CUSSINE</title>
   
</head>
<body>
   
    <section class="navbar">
        <div class="menu">
            <div class="wrapper">

                <a href="#home"><img src="images/logo.png"></a>
                <ul>
                <li><a href="<?php echo SITEURL;?>">Home</a></li>
                <li><a href="<?php echo SITEURL;?>findfood.php">Find Food</a></li>
                <li><a href="<?php echo SITEURL;?>categories.php">Categories</a></li>
                <li><a href="<?php echo SITEURL;?>findrest.php">Find Restaurants</a></li>
                <li><a href="<?php echo SITEURL;?>findrest.php">My Cart</a></li>
                <li><a href="<?php echo SITEURL;?>test1.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>

    
    </section>
    
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Menu of <a href="#" class="text-white">"Restaurant name"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
     <!-- fOOD MEnu Section Starts Here -->
     <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

        

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/menu-momo.jpg" alt="Chicke Hawain Momo" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Chicken Steam Momo</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>

                    <a href="order.php" class="btn btn-primary">Order Now</a>
                </div>
            </div>
            <div class="clearfix"></div>

            

</div>

</section>
<!-- fOOD Menu Section Ends Here -->


<?php include('partials-front/footer.php'); ?>