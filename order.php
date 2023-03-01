<?php include('config/constants.php'); ?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" type="image/png" href="images/i.png" />
    <link rel="stylesheet" href="order.css">
    <link href="https://fonts.googleapis.com/css2?family=Love+Ya+Like+A+Sister&display=swap" rel="stylesheet">
    <title>FIFTY SHADES OF CUSSINE</title>
</head>
<body>
    <div class="menu">
        <div class="wrapper">

            <a href=""><img src="images/logo.png"></a>
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
    <?php

    //check whether foodID is set or not
    if(isset($_GET['food_id']))
    {
        //Get the food ID and details of the selected food
        $food_id = $_GET['food_id'];

        //Get the details of the selected food
        $sql = "SELECT * FROM food WHERE id=$food_id";
        //Execute the query
        $res = mysqli_query($conn, $sql);
        //Count the rows
        $count = mysqli_num_rows($res);
        //check whether the data is available or not 
        if($count==1)
        {
            //We have data
            //Get the data from database
            $row = mysqli_fetch_assoc($res);
            $rest_id=$row['restuarent_id'];
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name']; 
        }
        else
        {
            //Food not available
            //Redirect to homepage
            header('location:'.SITEURL);
        }
    }
    else
    {
         //Food not available
        //Redirect to homepage
        header('location:'.SITEURL);
    }
    ?>

    <section class="food-search">
        <div class="container">


            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                     <div class="food-menu-img">
                     <?php 
                
                        //Check whether the image is available or not
                        if($image_name=="")
                        {
                            //image not available
                            echo "<div class='error'>Image not Available.</div>";
                        }
                        else{
                            //Image is available
                            ?>
                            <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Chicken Hawaian Pizza" class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                        
                    </div>

                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">Rs.<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <input type="hidden" name="rest_id" value="<?php echo $rest_id; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" min="1" class="input-responsive" value="1" required>

                    </div>

                </fieldset>

                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label"></div>
                    <input type="text" name="full-name" placeholder="Full Name" class="input-responsive" required>

                    <div class="order-label"></div>
                    <input type="tel" name="contact" placeholder="Phone Number" class="input-responsive" required>

                    <div class="order-label"></div>
                    <input type="email" name="email" placeholder="E-mail" class="input-responsive" required>

                    <div class="order-label"></div>
                    <textarea name="address" rows="2" placeholder="Deliver Address" class="input-responsive" required></textarea>
                    <br>
                    <br>

                    <input type="submit" name="submit" value="Confirm Order" class="btn-primary">
                    <br>
                    <br>
                </fieldset>

            </form>
            <?php 
            // Check whether submit button is clicked or not
            if(isset($_POST['submit']))
            {
                // Get all the details from the form

                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $rest_id=$_POST['rest_id']; 

                $total = $price * $qty;//total = price * qty
                $order_date = date("Y-m-d h:i:sa");//order date
                $status = "Ordered"; //ordered, on delivery, delivered cancelled
                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                //Save the order in database
                //create sql to save the data
                $sql2 = "INSERT INTO orders SET
                restuarent_id='$rest_id',
                food = '$food',                
                price = $price,
                qty = $qty,
                total= $total,
                order_date = '$order_date',
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'  " ;

                    //echo $sql2; die():

                    //Execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    //check whether query executed successfully or not
                    if($res2==true)
                    {
                        //query executed and order saved
                        $_SESSION['order']="<div class= 'success'>Food Order Successful</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        //failed to save order
                        $_SESSION['order']="<div class= 'error'>Failed to order food</div>";
                        header('location:'.SITEURL);
                    }

            
            }
            ?>

        </div>
        <div class="o"> <img src="images/t.png"></div>
       
    </section>
 <?php include('partials-front/footer.php'); ?>