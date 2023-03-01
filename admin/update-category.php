<?php include('partials/menu.php');?>

<div class ="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php
        //check whether the id is set or not
if(isset($_GET['id']))
{
    //get the id and all other details 
    //echo"Getting the data";
    $id = $_GET['id'];
    //create a sql query to get the details 
    $sql = "SELECT *FROM category WHERE id=$id";
    //execute the query
    $res= mysqli_query($conn, $sql);
    //count the rows to check whether the id is valid or not 
    $count = mysqli_num_rows($res);
    if($count==1){
        //get all the data 
        $row = mysqli_fetch_assoc($res);
        $restuarent_id=$row['restuarent_id'];
        $title = $row['title'];
        $current_image = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];
    }
    else{
        $_SESSION['no-category-found']=  "<div class='error'>Category not found.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');                                                                  
    }

}
else{
    header('location:'.SITEURL.'admin/manage-category.php');
}



?>

    <form actiion="" method="POST" enctype="multipart/form-data">
        <table class="tbl-full">
            <tr>
                <td>Restuarent Id:</td>
                <td><input type="text" name="restuarent_id" value="<?php echo $restuarent_id;?>" required></td>
            </tr>
            <tr>
                <td>Title:</td>
                <td><input type="text" name="title" value="<?php echo $title;?>"></td>
            </tr>
            <tr>
                <td>Current Image:</td>
                <td>
                    <?php
                    if($current_image !="")
                    {
                    ?>
                        <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>"width="150px">
               
                    <?php
                    }
                    else
                    {
                        echo"<div class='error'>Image not Added.</div>";
                    }
                
                    ?>
               </td> 
            </tr>
            <tr>
                <td>New Image:</td>
                <td><input type="file" name="image" value=""></td>
            </tr>
            <tr>
                <td>Featured:</td>
                <td><input <?php if($featured=="Yes"){echo"checked";}?> type="radio" name="featured" value="Yes">Yes
                <input <?php if($featured=="No"){echo"checked";}?> type="radio" name="featured" value="No">No
                </td>
            </tr>
            <tr>
                <td>Active:</td>
                <td><input <?php if($active=="Yes"){echo"checked";}?> type="radio" name="active" value="Yes">Yes
                <input <?php if($active=="No"){echo"checked";}?> type="radio" name="active" value="No">No
                </td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="submit" value="Update Category" class="btn-secoundary">
                </td>
            </tr>
        </table>
    </form>

<?php

if(isset($_POST['submit']))
{
    //echo "clicked";
    //get all the values from the form
    $id = $_POST['id'];
    $restuarent_id= $_POST['restuarent_id']; 
    $title = $_POST['title'];
    $current_image = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

if(isset($_FILES['image']['name']))
{
    $image_name = $_FILES['image']['name'];
    if($image_name != ""){
        $ext = end(explode('.',$image_name));
        $image_name="food_category_".rand(000,999).'.'.$ext;
        
        $source_path = $_FILES['image']['tmp_name'];
        $destinatio_path ="../images/category/".$image_name;
        $upload = move_uploaded_file($source_path, $destinatio_path );
        if($upload==false)
        {
            $_SESSION['upload']="<div class='error'>failed to uplaod </div>";
            header('location:'.SITEURL.'admin/manage-category.php');
            die();
        }
        if($current_image!=""){
            $remove_path = "../images/category/".$current_image;
        $remove = unlink($remove_path);
        if($remove==false){
            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
            die();
        }

        }
        

    }
    else{
        $image_name = $current_image;
    }
}
else{
    $image_name = $current_image;
}










//update new image
$sql2 ="UPDATE category SET
title='$title',
restuarent_id='$restuarent_id',
image_name='$image_name',
featured='$featured',
active='$active'
WHERE id=$id

";
//execute query
$res2 = mysqli_query($conn,$sql2);
if($res2==true){
$_SESSION['update']="<div class='success'>Category updated successfully</div>";
header('location:'.SITEURL.'admin/manage-category.php');
}
else{
    $_SESSION['update']="<div class='error'>Failed to update</div>";
header('location:'.SITEURL.'admin/manage-category.php');

}



}





?>








</div>
</div>

<?php include('partials/footer.php')?>