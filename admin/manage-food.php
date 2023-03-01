<?php include('partials/menu.php');?>
<div class="main-content">
<div class="wrapper">
<h1>Manage Food</h1>
</br>
</br>
</br>
<a href="<?php echo SITEURL; ?>admin/add-food.php"class="btn-primary">Add Food Item</a>
</br>
</br>
</br>

<?php

if(isset($_SESSION['add'])){
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}
if(isset($_SESSION['delete'])){
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}
if(isset($_SESSION['remove'])){
    echo $_SESSION['remove'];
    unset($_SESSION['remove']);
}
if(isset($_SESSION['unauthorize'])){
    echo $_SESSION['unauthorize'];
    unset($_SESSION['unauthorize']);
}
if(isset($_SESSION['update'])){
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}

?>
<table class="tbl-full">
    <tr>
        <th>S.N.</th>
        <th>Restuarent Id</th>
        <th>Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
</tr>
<?php

$sql = "SELECT * FROM food";//create query to get all food
$res = mysqli_query($conn, $sql);//execute quesry
$count = mysqli_num_rows($res);
$sn=1;

if($count>0){
    while($row=mysqli_fetch_assoc($res)){
        $id = $row['id'];
        $restuarent_id=$row['restuarent_id'];
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];
        ?>

        
<tr>
    <td><?php echo $sn++;?></td>
    <td><?php echo $restuarent_id;?></td>
    <td><?php echo $title;?></td>
    <td><?php echo $price;?></td>
    <td><?php 
    if($image_name==""){
        echo"<div class ='error'>Image not added.</div>";
    }
    else{
        ?>
       <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" width="100px"   >

        <?php
    }
    ?>
    </td>
    <td><?php echo $featured;?></td>
    <td><?php echo $active;?></td>
    <td>
    <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id?>&image_name=<?php echo $image_name;?>"class="btn-secoundary">Update Food</a>
    <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id?>&image_name=<?php echo $image_name;?>"class="btn-delete">Delete Food</a> 


    </td>
</tr>





        <?php
    }


}
else{
    echo"<tr><td colspan='8' class='error'>Food not added yet.</td></tr>";
}










?>














</table>


<div class="clearfix"></div>

</div>
</div>
<?php include('partials/footer.php')?>