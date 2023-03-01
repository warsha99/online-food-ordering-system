<?php
include('../config/constants.php');
//echo"Delete page";
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //process to delete 
    //echo"Get value and delete";
    //get id and image name 
    $id=$_GET['id'];
    $image_name = $_GET['image_name'];

        //check whether image is available or not and delete only if available 
        if($image_name!="")
        {
            //it has image and need to remove it from folder
            //get the image path
            $path ="../images/food/".$image_name;

            //remove image 
            $remove = unlink($path);

                //check whether image removed or not 
                if($remove==false)
                {
                    //failed to remove
                    $_SESSION['remove']="<div class ='error'>failed to remove image file</div>";
                    //redirect to manage food 
                    header('location:'.SITEURL.'res1/manage-food.php');
                    //stop the process of deleting food 
                    die();
                }
        }

            //delete from database 
            $sql="DELETE FROM food WHERE id=$id";
            //execute the query
            $res=mysqli_query($conn,$sql);

            //check whether query is executed or not check the session message 
            if($res==true)
            {
                $_SESSION['delete']="<div class ='success'>Food Deleted Sucessfully.</div>";
                header('location:'.SITEURL.'res1/manage-food.php');

            }
            else
            {
                //failed to delete food 
                $_SESSION['delete']="<div class ='eroor'>Failed to delete food item.</div>";
                header('location:'.SITEURL.'res1/manage-food.php');
            }
    

}

else{
$_SESSION['unauthorize']="<div class ='error'>Unauthorized access. </div>";
header('location:'.SITEURL.'res1/manage-food.php');
}


?>