<?php include('config/constants.php'); ?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" type="image/png" href="images/i.png" />
    <link rel="stylesheet" href="food-search.css">
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
                <li><a href="<?php echo SITEURL;?>cardPage.php">My Cart</a></li>
                <li><a href="<?php echo SITEURL;?>test1.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>

    
    </section>
    
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php 
            //get the search keyword 
            $search=$_POST['search'];
            
            ?>
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
     <!-- fOOD MEnu Section Starts Here -->
     <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            //get the search keyword 
            $search=$_POST['search'];

            //sql query to foods based on search
            $sql= "SELECT * FROM food where title like '%$search%' or description like '%$search%' ";

            //execute the query
            $res=mysqli_query($conn,$sql);

            //count rows
            $count = mysqli_num_rows($res);

            //check whether food available or not 
            if($count>0)
            {
                //food available 
                //display all the food 
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the details 
                    $id=$row['id'];
                    $title=$row['title'];
                    $description=$row['description'];
                    $price=$row['price'];
                    $image_name=$row['image_name'];

                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                              <?php
                                    //check whether image name is available or not 
                                    if($image_name=="")
                                    {
                                        //image not available
                                        echo "<div class='error'>Image not found.</div>"; 
                                    }
                                    else
                                    {
                                        //image available
                                        ?>
                                            <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>"  alt="Chicke Hawain Momo" class="img-responsive img-curve">
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
                            <a href="cart.html" class="btn btn-primary">Add to Cart</a>
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