<?php include('partials-front/menu.php'); ?>
<?php
   
    include('header.php');
    ?>



     <!-- fOOD sEARCH Section Starts Here -->
     <section class="food-search text-left">
        <div class="container">
            
            <h2 class="text-left">WELCOME TO FIFTY SHADES OF CUSSINE</h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
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
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                // create sql query to display categories from database 
                $sql="SELECT * FROM category where active='Yes' and featured='Yes' limit 3";

                //Execute the query
                $res=mysqli_query($conn,$sql);
                // count rows to check whether the category is available or not 
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //categories are available
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
                                   //display the message 
                                   echo "<div class='error'>image not available</div>";
                               }
                               else
                               {
                                    //display image 
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
                    echo "<div class='error'> Category not added. </div>";
                }
            ?>





            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            //getting foods from database that are a active and featured
            //sql query
            $sql2="SELECT * FROM food where active='Yes' and featured='Yes' limit 6";

            //execute the query
            $res2=mysqli_query($conn,$sql2);
            // count rows to check whether the category is available or not 
            $count2 = mysqli_num_rows($res2);

            //check whether food available or not
            if($count2>0)
            {
                //food available
                while($row=mysqli_fetch_assoc($res2))
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
                            <button class="btn btn-primary" id="add_to_cart_modal"><i class="fa fa-cart-plus"></i>Add to cart </button>
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

        <p class="text-center">
            <a href="findfood.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->
    
   
<!-- fOOD Menu Section Ends Here -->
<?php include('partials-front/footer.php'); ?>
<style>
	#uni_modal_right .modal-footer{
		display: none;
	}
</style>

<script>
	$('#qty-minus').click(function(){
		var qty = $('input[name="qty"]').val();
		if(qty == 1){
			return false;
		}else{
			$('input[name="qty"]').val(parseInt(qty) -1);
		}
	})
	$('#qty-plus').click(function(){
		var qty = $('input[name="qty"]').val();
			$('input[name="qty"]').val(parseInt(qty) +1);
	})
	$('#add_to_cart_modal').click(function(){
		start_load()
		$.ajax({
			url:'admin/ajax.php?action=cart',
			method:'POST',
			data:{pid:'<?php echo $_GET['id'] ?>',qty:$('[name="qty"]').val()},
			success:function(resp){
				if(resp == 1 )
					alert_toast("Order successfully added to cart");
					$('.item_count').html(parseInt($('.item_count').html()) + parseInt($('[name="qty"]').val()))
					$('.modal').modal('hide')
					end_load()
			}
		})
	})
</script>

