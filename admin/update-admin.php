<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Restaurant Owner Details</h1>
        <br>
        <br>
        <br>
    

<?php 
    // get the id of the admin to be delted 
    $id=$_GET['id'];

    //create sql query to get the details 
    $sql ="SELECT * FROM tbl_admin WHERE id=$id";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //check whether the query is executed or not 
    if($res==true)
    {
        //check whether the data is available or not 
        $count = mysqli_num_rows($res);
        //check whether we have admin or not 
        if($count==1)
        { 
            //get the details 
            $row=mysqli_fetch_assoc($res);
            $username=$row['username'];
            $email=$row['email'];
            $restuarent_id=$row['restuarent_id'];
            $current_image = $row['image_name'];
        }
        else
        {
            //redirect to account.php  
            header('location:'.SITEURL.'admin/account.php');
        }
    }


?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-full" style="width:30%">
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" value="<?php echo $username;?>" ></td>
   
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" value="<?php echo $email;?>" ></td>
                </tr>
                <tr>
                    <td>Restuarent ID:</td>
                    <td><input type="text" name="restuarent_id" value="<?php echo $restuarent_id;?>" ></td>
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
                                <img src="<?php echo SITEURL;?>images/restuarent/<?php echo $current_image;?>"width="150px">
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
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>" class="btn-secoundary">
                        <input type="submit" name="submit" value="update" class="btn-secoundary">
                </tr>
            </table>
        </form>
    </div>
</div>
<?php

    //check whether the submit button is clicked or not 
    if(isset($_POST['submit']))
    {
        //get all the values from the form to update 
        $id=$_POST['id'];
        $username=$_POST['username'];
        $email=$_POST['email'];
        $restuarent_id=$_POST['restuarent_id'];
        $current_image = $_POST['current_image'];

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

                        $image_name="Restuarent_Name_".rand(000,999).'.'.$ext; //this will be renamed image 

                        //get the source path and destination path
                        $source_path = $_FILES['image']['tmp_name']; //source path
                        $destination_path ="../images/restuarent/".$image_name; //destination path

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
                            $remove_path = "../images/restuarent/".$current_image;
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



        //create a sql query to update admin
        $sql = "UPDATE tbl_admin SET
        username='$username',
        email='$email',
        image_name='$image_name',
        restuarent_id='$restuarent_id' 
        WHERE id ='$id' ";
    

        //execute the query 
        $res = mysqli_query($conn, $sql);

        //check whether the query executed successfully or not 
        if($res==true)
        {
            //query executed and admin updated
            $_SESSION['update']="<div class='success'>updated successfully</div>";
            //redirect to account.php
            header('location:'.SITEURL.'admin/account.php');
        }
        else
        {
            //failed to update admin
            $_SESSION['update']="<div class='error'>failed to update</div>";
            header('location:'.SITEURL.'admin/account.php');

        }
    }


?>











<?php include('partials/footer.php')?>