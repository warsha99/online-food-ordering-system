<?php include('config/constants.php'); ?>
<?php 
	// $_SESSION['User']; 
	/*require_once('./php/component.php');*/
	session_start();

	//$connect = mysqli_connect("localhost","root","","factory");
	
	if(isset($_POST['add']))
	{
	

		if(isset($_SESSION['shopping_cart']))
			{
			$item_array_id=array_column($_SESSION['shopping_cart'],"item_id");
			
			if(!in_array($_GET["id"],$item_array_id))
			{
				$count=count($_SESSION['shopping_cart']);
				$item_array=array(
					'item_id'=>$_GET["id"],
					'restuarent_id'=>$_POST["restuarent_id"],
					'item_name'=>$_POST["name"],
					'item_price'=>$_POST["price"],
					'item_quantity'=>$_POST["quantity"],
					

				);

				
				$_SESSION["shopping_cart"][$count]=$item_array;
				
			}
			else
			{
				echo '<script>alert("Item Already Added")</script>';	
				echo '<script>window.location="cardPage.php"</script>';
			}
		}
		else
		{
			$item_array=array(
				'item_id'=>$_GET["id"],
				'item_name'=>$_POST["name"],
				'item_price'=>$_POST["price"],
				'item_quantity'=>$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][0]=$item_array;
		}
	}

	if(isset($_GET["action"]))
	{
		if($_GET["action"]=="delete")
		{
			foreach($_SESSION["shopping_cart"] as $keys =>$values)
			{
				if($values["item_id"]== $_GET["id"])
				{
					$id=$_GET['id'];
					$sql="DELETE FROM cart WHERE item_id='$id'";
					$result=mysqli_query($connect,$sql);
					unset($_SESSION["shopping_cart"][$keys]);

					echo '<script>alert("Item Removed")</script>';	
					echo '<script>window.location="cardPage.php"</script>';


					
				}
			}
		}

	}	
 ?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <link rel="shortcut icon" type="image/png" href="images/i.png" />
    <link rel="stylesheet" href="findfood.css">
    <link href="https://fonts.googleapis.com/css2?family=Love+Ya+Like+A+Sister&display=swap" rel="stylesheet">
    <title>FIFTY SHADES OF CUSSINE</title>
   
<!--	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" href="style2.css">
	<link rel="stylesheet" href="style3.css">

	<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100&family=Noto+Sans+JP&display=swap" rel="stylesheet">
-->
</head>

<!--<body style="background:#dBb27e;">-->
<!--navibar start-->
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
<!--<nav class="navbar navbar-expand-lg navbar-dark" style="background: #231709; ">
  	<div class="container-fluid">
  	 	<a class="navbar-brand" href="#">
      		<img src="image/logo.png"  class="d-inline-block align-text-top">
      		<font face="CommercialScript BT">Lizbury Chocolate House</font>
    	</a>
    
    	<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="	navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     	 <span class="navbar-toggler-icon"></span>
    	</button>
    	<div class="collapse navbar-collapse" id="navbarSupportedContent">
      		<ul class="navbar-nav m-auto mb-2 mb-lg-0">
        		<li class="nav-item text-center">
          			<a class="nav-link" href="index.php">Home</a>
        		</li>
        		<li class="nav-item text-center">
          			<a class="nav-link active" href="#">Order</a>
        		</li>
        		<li class="nav-item text-center">
          			<a class="nav-link" href="catagary.php">Catagory</a>
        		</li>
        		<li class="nav-item text-center">
          			<a class="nav-link" href="#bottom">Contact</a>
        		</li>
        		<li class="nav-item text-center">
         			 <a class="nav-link" href="feedback.php">Feedback</a>
        		</li>
        	<li class="nav-item text-center">
   					<a class="nav-link" href="cardPage.php"><i class="fas fa-shopping-cart" ></i></a>
   				</li>
   		
						
    	
               	
      		</ul>          
    
    	</div>        
  	</div>
</nav>
-->
<!--navigation bar end-->


<!--alert message start-->
<!--
<div class="alert alert-danger" role="alert">
 
<div class="container">
	<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  	
  	<div class="carousel-inner">
    		<div class="carousel-item active">
      			<h6 align="center"><font color="red"> THIS COVID-19 PANDEMIC SITUATION SAFETY DELIVERY WITHIN 2-3 HOURS AROUND WESTERN PROVINCE AND 5-6 HOURS FOR OTHER PROVINCES</font></h6>
    		</div>
    		<div class="carousel-item">
      			<h6 align="center"><font color="red">CORONA VIRUS WHEN IT FALLS ON A MENTAL SURFACE, IT WILL LIVE 12 HOURS, SO WASHING HANDS WITH SOAP AND WATER WELL ENOUGH.</font></h6>
    		</div>
    
  			</div>
 		</div>
	</div> 
</div> 
<!--alert message end-->
<!--cart started-->



	<div class="container-fluid my-3">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6">
					<div class="col-md-12">
						<div class="row">
					
		
		 <?php 	

		 	$query="SELECT * FROM cart ORDER BY id ASC";
		 	$result= mysqli_query($connect,$query);
		 	if(mysqli_num_rows($result)>0){
		 		while($row=mysqli_fetch_array($result))
		 		{
		 				
		 			
		 			?>
		 			<div class="col-md-4 ">
		 				<form method="POST" action="cardPage.php?action=add&id=<?php echo $row["id"];?>"><br>
		 				<div style="border:2px solid #FFF4C2;background-color:#2E1503;border-radius: 5px;padding:4px;" align="center">
		 					<img src="<?php echo $row["image"];?>" class="img-responsive" height=140px;/><br/>
		 					<h5 class="text-info" ><font color="white"><?php echo $row["name"]?></font></h5>
		 					<h5 class="text-danger">Rs.<?php echo $row["price"];?></h5>
		 					<input type="text" name="quantity" class="form-control form-control-sm" value="1"/>
		 					<input type="hidden" name="name" value="<?php echo $row["name"];?>"/>
		 					<input type="hidden" name="price" value="<?php echo $row["price"];?>"/>
		 					<button class="btn btn-outline-danger btn-sm" name="add_to_cart" value="add_to_cart" style="margin-top:5px;"><i class="fas fa-shopping-cart"></i></button> 
		 				</div>	
		 				</form>
		 			</div>

		 			<?php
		 		}
		 	}
		  ?>
		</div>
	</div>
</div>


<!--table start-->
<div class="col-md-6">
<div style="clear:both"></div>	
<br/>
<h3 align="center"><font color="brown" face="Comic Sans MS">Order Details</font></h3>

<div class="table-responsive">
	<table class="table table-dark table-hover">
		<tr align="center">
			<th width="20%">Item Name</th>
			<th width="20%">Quantity</th>
			<th width="20%">Price</th>
			<th width="20%">Total</th>
			<th width="20%">Action</th>
		</tr>
		<?php 	
			if(!empty($_SESSION["shopping_cart"])){
				$total=0;
				foreach ($_SESSION["shopping_cart"] as $key => $values) {
					?>
					<tr align="center">
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td><?php echo $values["item_price"]; ?></td>
						<td><?php echo number_format($values["item_quantity"]*$values["item_price"], 2);?></td>
						<td><a href="cardPage.php?action=delete&id=<?php echo $values["item_id"];?>"><button type="button" class="btn btn-outline-danger btn-sm">Remove</button></a>
					</td>
					</tr>
					<?php
						$total=$total+($values["item_quantity"]*$values["item_price"]);
				}
				?>
				<tr align="center">
					<td colspan="3"align="center"><b>Total price</b></td>
					<td align="center">Rs:<?php echo number_format($total, 2); ?></td>
					<td></td>
				</tr>
				<?php
			}
		 ?>
	</table>
<!--table end-->
	
	<a href="login.php"><button type="button" class="btn btn-dark"><i class="fas fa-user"></i>&nbsp;&nbsp;Login</button></a>
	<!--<a href="#"><button type="button" class="btn btn-dark" name="btn"><i class="fas fa-user"></i>&nbsp;&nbsp;Confirmed</button></a>-->
	
	
</div>
</div>
</div>
</div>	
<!--cart end-->


<!--carasol start-->
<!--
<div class="container-fluid my-5">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-3">
					<div class="col-md-12">
						<div class="row">
<div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="image/d1.jpg" class="d-block w-100" alt="..." height="350px">
    </div>
    
    <div class="carousel-item">
      <img src="image/d4n.jpg" class="d-block w-100" alt="..." height="350px">
    </div>
  </div>
  <!--<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>-->
  <!--
</div>

			</div>
		</div>
	</div>
	
	<div class="col-md-3">
					<div class="col-md-12">
						<div class="row">
<div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="image/d6.jpg" class="d-block w-100" alt="..." height="350px">
    </div>
    
    <div class="carousel-item">
      <img src="image/d5.jpeg" class="d-block w-100" alt="..." height="350px">
    </div>
  </div>
  <!--<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>-->
<!--
</div>

			</div>
		</div>
	</div>

<div class="col-md-3">
					<div class="col-md-12">
						<div class="row">
<div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="image/d7.jpg" class="d-block w-100" alt="..." height="350px">
    </div>
    
    <div class="carousel-item">
      <img src="image/g.jpeg" class="d-block w-100" alt="..." height="350px">
    </div>
  </div>
  <!--<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>-->
<!--
</div>

			</div>
		</div>
	</div>

<div class="col-md-3">
					<div class="col-md-12">
						<div class="row">
<div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="image/d2.jpg" class="d-block w-100" alt="..." height="350px">
    </div>
    
    <div class="carousel-item">
      <img src="image/d3n.jpg" class="d-block w-100" alt="..." height="350px">
    </div>
  </div>
  <!--<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>-->
  <!--
</div>

			</div>
		</div>
	</div>

</div>
</div>
</div>
<!--carasol start-->
<!--footer start-->

<!--footer end-- FB,instergram-->
<?php include('partials-front/footer.php'); ?>

</body>
</html>















