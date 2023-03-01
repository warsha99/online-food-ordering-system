<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper"><h1>Add Category</h1>
    <br>
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
<br>
    <form action= "" method="POST" enctype="multipart/form-data">
        <table class="tbl-full">
            <tr>
                <td>Restuarent Id:</td>
                <td><input type="text" name="restuarent_id" placeholder="Restuarent Id" required></td>
            </tr>
            <tr>
                <td>Title:</td>
                <td><input type="text" name="title" placeholder="Category Title" required></td>
            </tr>
            <tr>
                <td>Select Image:</td>
                <td><input type="file" name="image" required></td>
            </tr>
            <tr >
                <td>Featured:</td>
                <td>
                    <input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured" value="No">No
                </td>
            </tr>
            <tr>
                <td>Active:</td>
                <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <input type="submit" name="submit" value="Add category" class="btn-secoundary"  >
                </td>
            </tr>
        </table>
    </form>

    <?php

    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        // get the value from the category form
        $restuarent_id = $_POST['restuarent_id']; 
        $title = $_POST['title'];
        

            //for radion buttons we need to check whether button is selected or not
            if(isset($_POST['featured']))
            {
                //get the value from form 
                $featured=$_POST['featured']; 
            }
            else
            {
                //set the default value 
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
                
            //check whether the image is selected or not and set the value for image name accordingly
            //print_r($_FILES['image']);
            //die(); // breake the code here 
            if(isset($_FILES['image']['name'])){

                //upload the image
                //to upload the image we need image name, source path, and destination path
                $image_name = $_FILES['image']['name'];

                
                
                if($image_name!="")
                {
                    //auto rename the image
                    //get the extension of the image (jpg,png,gif) e.g. food1.jpg
                    $ext = end(explode('.',$image_name));

                    //rename the image
                    $image_name="food_category_".rand(000,999).'.'.$ext; // e.g. food_category_34.jpg
                    $source_path = $_FILES['image']['tmp_name'];
                    $destinatio_path ="../images/category/".$image_name;

                    //upload the image
                    $upload = move_uploaded_file($source_path, $destinatio_path );

                    //check whether the image is uploaded or not
                    //if the image image is not uploaded we will stop the process and redirect with error message
                    if($upload==false)
                    {
                        //set message
                        $_SESSION['upload']="<div class='error'>failed to uplaod </div>";
                        header('location:'.SITEURL.'admin/add-category.php');
                        //stop the process
                        die();
                    }

                }
            }
            else
            {
                //dont upload the image and image name set to blank
                $image_name="";
            }



        //create sql query to insert category into database 
            $sql="INSERT INTO category SET
            restuarent_id='$restuarent_id',
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'

            ";
        //execute the query and save data in the database 
            $res=mysqli_query($conn, $sql);
    
        //check whether the query executed or not and data set added or not 
        if($res==true)
        {
            //query executed and category added 
            $_SESSION['add']="<div class='success'>Category Added Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //failed to add category
            $_SESSION['add']="<div class='error'>Failed to add category.</div>";
            header('location:'.SITEURL.'admin/add-category.php');
        }

    }

?>




</div>
    
    
</div>
<?php include('partials/footer.php')?>



















