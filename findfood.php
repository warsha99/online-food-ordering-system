
<?php include('config/constants.php'); ?>



<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" type="image/png" href="images/i.png" />
    <link rel="stylesheet" href="findfood.css">
    <link href="https://fonts.googleapis.com/css2?family=Love+Ya+Like+A+Sister&display=swap" rel="stylesheet">
    <title>FIFTY SHADES OF CUSSINE</title>

    <!-- Font Awesome 
   // <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    -->
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
                <li><a href="<?php echo SITEURL;?>cardPage.php">My Cart</a></li>
                <li><a href="<?php echo SITEURL;?>test1.php">Logout</a></li>
                </ul>
                <a class="navbar-brand" href="/">Web</a>
                </div>  
                    <div id="navbar-cart" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                    <li>
                        <a id="cart-popover" class="btn" data-placement="bottom" title="Shopping Cart">
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                        <span class="badge"></span>
                        <span class="total_price">$ 0.00</span>
                        </a>
                    </li>
                    </ul>
                    </div>

               
            </div>
        </div>
               
    </section>
    

     <!-- fOOD sEARCH Section Starts Here -->
     <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            //getting foods from database that are a active 
            //sql query
            $sql="SELECT * FROM food where active='Yes'";

            //execute the query
            $res=mysqli_query($conn,$sql);
            // count rows to check whether the category is available or not 
            $count = mysqli_num_rows($res);

            //check whether food available or not
            if($count>0)
            {
                //food available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get all the values
                    $id=$row['id'];
                    $title=$row['title'];
                    $price=$row['price'];
                    $description=$row['description'];                    
                    $image_name=$row['image_name'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                            //check whether image is available or not
                            if($image_name=="")
                            {
                                //image not available
                                echo "<div class='error'>Image not found.</div>";
                            }
                            else
                            {
                                //image available
                                ?>
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Burger" class="img-responsive img-curve">
                                <?php
                            }
                            ?>
                            
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title;?></h4>
                            <p class="food-price">Rs.<?php echo $price;?></p>
                            <p class="food-detail">
                            <?php echo $description;?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            <a href="<?php echo SITEURL;?>cart.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Add to Cart</a>
                        </div>
                    </div>
                    <?php
                }
            }
            else
            {
                //food not available 
                echo "<div class='error'>Food not available.</div>";
            }

            ?>
            <div class="clearfix"></div>

            

        </div>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>