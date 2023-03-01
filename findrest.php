<?php include('config/constants.php'); ?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" type="image/png" href="images/i.png" />
    <link rel="stylesheet" href="findrest.css">
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
     <!-- restuarent sEARCH Section Starts Here -->
     <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>rest-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Restaurant Name or Location.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- restuarent sEARCH Section Ends Here -->

    <!-- restuarent  MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Restaurants</h2>

            <?php 
            //getting foods from database that are a active and featured
            //sql query
            $sql="SELECT * FROM restuarents ";

            //execute the query
            $res=mysqli_query($conn,$sql);
            // count rows to check whether the category is available or not 
            $count = mysqli_num_rows($res);

            
                //check whether restuarents are available or not
                if($count>0)
                {
                    //categories available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the values like id, title,image_name
                        $id=$row['id'];
                        $resName=$row['resName'];
                        $location=$row['location'];
                        $description=$row['description'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <img src="images/retuarent/na.png" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $resName;?></h4>
                                <p class="food-price"><?php echo $location;?></p>
                                <p class="food-detail">
                                <?php echo $description;?>
                                </p>
                                <br>
                                <a href="rest-menu.php" class="btn btn-primary">Menu</a>
                            </div>
                        </div>
                        <?php
                        

                        
                            
                    }
                }
                else
                {
                    //categories not available
                    echo "<div class='error'>Restuarent not found.</div>";
                }
            
            ?>

           
            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>