<?php include('partials/menu.php');?>
<?php
if(isset($_GET['id']))
{
    //echo"Getting the data";
    $id = $_GET['id'];
    $sql2 = "SELECT *FROM food WHERE id=$id";
    $res2= mysqli_query($conn, $sql2);
    $count = mysqli_num_rows($res2);
    
    if($count==1){

        $row2 = mysqli_fetch_assoc($res2);
        $restuarent_id=$row2['restuarent_id'];
        $title = $row2['title'];
        $description=$row2['description'];
        $price=$row2['price'];
        $current_image = $row2['image_name'];
        $current_category=$row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    }
    else
    {
    $_SESSION['no-food-found']=  "<div class='error'>food not found.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');                                                                  
    }
}


?>



<div class ="main-content">
    <div class="wrapper">
        <h1>Update Food Item</h1>
        <br><br>
        <form actiion="" method="POST" enctype="multipart/form-data">
            <table class="tbl-full" >
                <tr>
                    <td>Restuarent Id:</td>
                    <td><input type="text" name="restuarent_id" value="<?php echo $restuarent_id?>" required></td>
                </tr>
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title;?>"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name ="description" cols="30" rows="5"><?php echo $description?>"></textarea></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" value="<?php echo $price?>"></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                            if($current_image =="")
                            {
                                //image not available
                                echo"<div class='error'>Image not Added.</div>";                        
                            }
                            else
                            {
                                //image available
                                ?>
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>"width="150px">
                                <?php
                            }                
                        ?>
                    </td>                    
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td><input type="file" name="image" value=""></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                        <?php
                        $sql = "SELECT * FROM category WHERE active='Yes'";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $category_title= $row['title'];
                                $category_id= $row['id'];                                 
                                ?>
                                <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id ;?>"><?php echo $category_title; ?></option>
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
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>">                    
                    <input type="submit" name="submit" value="Update food" class="btn-secoundary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if(isset($_POST['submit']))
            {
                //echo "button clicked";
                //get all the details from the form 
                $id = $_POST['id'];
                $restuarent_id=$_POST['restuarent_id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category=$_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];


                //upload the image if selected 
                //check whether upload button is clicked or not 
                if(isset($_FILES['image']['name']))
                {
                    //upload button clicked 
                    $image_name = $_FILES['image']['name'];// new image name 

                    //check whether file is available or not
                    if($image_name != "")
                    {
                        //image available 
                        //uploading new image 

                        //rename the image 
                        $ext = end(explode('.',$image_name));//gets the extension of the image 

                        $image_name="Food_Name_".rand(000,999).'.'.$ext; //this will be renamed image 

                        //get the source path and destination path
                        $source_path = $_FILES['image']['tmp_name']; //source path
                        $destination_path ="../images/food/".$image_name; //destination path

                        //upload the image 
                        $upload = move_uploaded_file($source_path,$destination_path);

                        //check whether image is uploaded or not 
                        if($upload==false)
                        {
                            //failed to uplaod 
                            $_SESSION['upload']="<div class='error'>failed to uplaod </div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                            //stop the process
                            die();
                        }
                        //remove the image if new image is uploaded and current image exist
                        //remove current image if available 
                        if($current_image!="")
                            {
                                //current image is available 
                                //remove the image
                            $remove_path = "../images/food/".$current_image;
                            $remove = unlink($remove_path);

                            //check whether the image is removed or not 
                            if($remove==false)
                            {
                                //failed to remove current image 
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image</div>";
                                header('location:'.SITEURL.'admin/manage-food.php');
                                die();
                            }
                    

                        }

                    }
                    else
                    {
                        $image_name = $current_image; //default image when image is not selected 
                    }
                }
                else
                {
                    $image_name = $current_image; //default image when button is not clicked
                }

                
                //update the food in database 
                $sql3 ="UPDATE food SET
                restuarent_id='$restuarent_id',
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id='$category',
                featured='$featured',
                active='$active'
                WHERE id=$id
                ";
                //execute the sql query
                $res3 = mysqli_query($conn,$sql3);
                //check whether query executed or not 
                    if($res3==true)
                    {
                        //query executed and food updated 
                        $_SESSION['update']="<div class='success'>Food updated successfully</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                    else
                    {
                        //failed to update
                        $_SESSION['update']="<div class='error'>Failed to update food</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }

            } 
        
        ?>


    </div>
</div>


<?php include('partials/footer.php') ?>