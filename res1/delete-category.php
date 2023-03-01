<?php
include('../config/constants.php');
//echo"Delete page";
//check whether the id and image name value is set or not 
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //echo"Get value and delete";
    $id=$_GET['id'];
    $image_name = $_GET['image_name'];

    //remove the physical image file is available
    if($image_name!="")
    {
        //image is available. so remove it
        $path ="../images/category/".$image_name;
        //remove the imageaw
        $remove = unlink($path);

        //if failed remove image then add an error message
        if($remove==false)
        {
            $_SESSION['remove']="<div class ='error'>failed to remove category</div>";
            header('location:'.SITEURL.'res1/manage-category.php');
            die();
        }
    }



            //delete dat from database
            //sql query to delete data from database
            $sql="DELETE FROM category WHERE id=$id";
            $res=mysqli_query($conn,$sql);

            //check whether the data is deleted from database or not
            if($res==true)
            {
                    $_SESSION['delete']="<div class ='success'></div>";
                    header('location:'.SITEURL.'res1/manage-category.php');

            }
            else
            {
                $_SESSION['delete']="<div class ='eroor'>Category Deleted Sucessfully..</div>";
                header('location:'.SITEURL.'res1/manage-category.php');
            
            }
    

}

else
{
header('location:'.SITEURL.'res1/manage-category.php');
}


?>