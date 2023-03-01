<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper"><h1>Manage Category</h1>
    <br>
<br>
<br>
<?php
if(isset($_SESSION['add']))
{
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}
if(isset($_SESSION['remove']))
{
    echo $_SESSION['remove'];
    unset($_SESSION['remove']);
}
if(isset($_SESSION['delete']))
{
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}
if(isset($_SESSION['no-category-found']))
{
    echo $_SESSION['no-category-found'];
    unset($_SESSION['no-category-found']);
}
if(isset($_SESSION['update']))
{
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}
if(isset($_SESSION['upload']))
{
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}

if(isset( $_SESSION['failed-remove']))
{
    echo  $_SESSION['failed-remove'];
    unset( $_SESSION['failed-remove']);
}





?>
<br>
<br>





<a href="<?php echo SITEURL;?>admin/add-category.php"class="btn-primary">Add Category</a>
<br>
<br>
<br>
<table class="tbl-full">
    <tr>
        <th>S.N.</th>
        <th>Restuarent Id</th>
        <th>Title</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
</tr>
<?php

//query to get all the categories from the database 
$sql="SELECT * FROM category";

//execute the query 
$res = mysqli_query($conn, $sql);

//count rows 
$count = mysqli_num_rows($res);
$sn=1;

//check whether we have data in database or not 
if ($count>0){

    //we have data in database 
    //get data
while($row=mysqli_fetch_assoc($res))
{
    $id = $row['id'];
    $restuarent_id = $row['restuarent_id'];
    $title = $row['title'];
    $image_name=$row['image_name'];
    $featured=$row['featured'];
    $active=$row['active'];

?>







<tr>
    <td><?php echo $sn++;?></td>
    <td><?php echo $restuarent_id;?></td>
    <td><?php echo $title;?></td>
    

    <td>
        
    <?php 
    
    //image name availability
    if($image_name!=""){
        ?>
        <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" width="100px"   >


        <?php

    }
    else{
        echo "<div class='error'>Image not Added.</div>";
    }
    
    
    
    ?>



</td>

    <td><?php echo $featured;?></td>
    <td><?php echo $active;?></td>
    <td>
    <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id?>&image_name=<?php echo $image_name;?>"class="btn-secoundary">Update Category</a>
    <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id?>&image_name=<?php echo $image_name;?>"class="btn-delete">Delete Category</a> 

    </td>
</tr>



<?php








}


}
else{
    ?>
<tr>
    <td colspan="7"><div class="error">No Category Added</td>
</tr>





<?php
}







?>






</table>






</div>
    
    
</div>
<?php include('partials/footer.php')?>