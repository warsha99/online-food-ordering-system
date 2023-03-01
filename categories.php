<?php include('config/constants.php'); ?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" type="image/png" href="images/i.png" />
    <link rel="stylesheet" href="categories.css">
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
    
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                //display all the categories that are active
                $sql="SELECT * FROM category where active='Yes'";

                //Execute the query
                $res=mysqli_query($conn,$sql);

                // count rows to check whether the category is available or not 
                $count = mysqli_num_rows($res);

                //check whether categories available or not
                if($count>0)
                {
                    //categories available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the values like id, title,image_name
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        ?>
                            <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
                                <div class="box-3 float-container">

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
                                             <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                   

                                    <h3 class="float-text text-white"><?php echo $title;?></h3>
                                </div>
                            </a>
                        <?php
                    }
                }
                else
                {
                    //categories not available
                    echo "<div class='error'>No foods available on this category.</div>";
                }
            
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>