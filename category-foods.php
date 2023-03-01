<?php include('config/constants.php'); ?>
<?php 
//check whether id is passed or not
if(isset($_GET['category_id']))
{
    //category id is set and get the id 
    $category_id=$_GET['category_id'];
    //get the category title based on sql query
    $sql="SELECT title from category where id=$category_id";

    //execute the query
    $res=mysqli_query($conn,$sql);

    //count rows
    $row=mysqli_fetch_assoc($res);

    //get the title 
    $category_title=$row['title'];
}
else
{
    //category not passed 
    // redirect to homepage 
    header('location:'.SITEURL);
}

?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" type="image/png" href="images/i.png" />
    <link rel="stylesheet" href="category-foods.css">
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
            
        <h2 class="text-white">Foods on <a href="#" class="text-white">"<?php echo $category_title;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            //create a sql query to get foods based on category
            $sql2="SELECT * FROM food where category_id=$category_id";

            $res2=mysqli_query($conn,$sql2);

            $count2=mysqli_num_rows($res2);

            if($count2>0)
            {
                //food is available
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $id=$row2['id'];
                    $title=$row2['title'];
                    $description=$row2['description'];
                    $price=$row2['price'];
                    $image_name=$row2['image_name'];

                    ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
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
                //food is not availables
                echo "<div class='error'>food not available on this category.</div>";
            }

            
            ?>

            <div class="clearfix"></div>

            

</div>

</section>
<!-- fOOD Menu Section Ends Here -->


<?php include('partials-front/footer.php'); ?>