<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper"><h1>Add food</h1>
    <br>
    <br>
    <br>



<?php
if(isset($_SESSION['add']))
{
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}
if(isset($_SESSION['upload']))
{
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}
 
?>
<br>

    <form action= ""method="POST" enctype="multipart/form-data">
        <table class="tbl-full">
            
            <tr>
                <td>Title:</td>
                <td><input type="text" name="title" placeholder="Title of the food" required>
                </td>
            </tr>
            <tr>
                <td>Description:</td>
                <td><textarea name ="description" cols="30" rows="5"  placeholder="Description of the food" required></textarea>
                </td>
            </tr>
            <tr>
                <td>Price:</td>
                <td><input type="number" name="price" required>
                </td>
            </tr>
            <tr>
                <td>Select Image:</td>
                <td><input type="file" name="image"required>
                </td>
            </tr>
            <tr>
                <td>Category:</td>
                <td><select name="category" required>
                        <?php
                        $sql = "SELECT * FROM category WHERE active='Yes'";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                ?>
                                <option value="<?php echo $id;?>"><?php echo $title; ?></option>
                                <?php
                            }
                        }
                        else{
                            ?>
                            <option value="0">No Category Found </option>
                        <?php

                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Featured:</td>
                <td><input type="radio" name="featured" value="Yes">Yes
                <input type="radio" name="featured" value="No">No
                </td>
            </tr>
            <tr>
                <td>Active:</td>
                <td><input type="radio" name="active" value="Yes">Yes
                <input type="radio" name="active" value="No">No
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <input type="submit" name="submit" value="Add Food" class="btn-secoundary"  >
                </td>
        </table>
    </form>

<?php
if(isset($_POST['submit']))
{
    
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    if(isset($_POST['featured']))
    {
       $featured=$_POST['featured']; 
    }
    else{
        $featured="No";
    }
    if(isset($_POST['active']))
    {
        $active=$_POST['active'];
    }
    else
    {
        $active="No";
    }
//print_r($_FILES['image']);
//die();
if(isset($_FILES['image']['name'])){
$image_name = $_FILES['image']['name'];
if($image_name!="")
{
    $ext = end(explode('.',$image_name));
    $image_name="food_add_".rand(000,999).'.'.$ext;
    
    $source_path = $_FILES['image']['tmp_name'];
    $destinatio_path ="../images/food/".$image_name;
    $upload = move_uploaded_file($source_path, $destinatio_path );
    if($upload==false)
    {
        $_SESSION['upload']="<div class='error'>failed to uplaod </div>";
        header('location:'.SITEURL.'res1/add-food.php');
        die();
    }
//auto rename

}









}
else{
    $image_name="";
}




$sql="INSERT INTO food SET
restuarent_id='r001',
title='$title',
description='$description',
price=$price,
image_name='$image_name',
category_id=$category,
featured='$featured',
active='$active'

";
$res=mysqli_query($conn, $sql);
    

if($res==true){
$_SESSION['add']="<div class='success'>Food Added Successfully.</div>";
header('location:'.SITEURL.'res1/manage-food.php');
}
else{
    $_SESSION['add']="<div class='error'>Failed to add Food.</div>";
    header('location:'.SITEURL.'res1/manage-food.php');
}

}

?>




</div>
    
    
</div>
<?php include('partials/footer.php')?>

