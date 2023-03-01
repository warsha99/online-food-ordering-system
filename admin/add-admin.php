<?php include('partials/menu.php');?>

<div class="main-content">
<div class="wrapper">
<h1>Add Restaurant Owner</h1>
</br>
</br>
</br>

<?php 
if(isset($_SESSION['add'])) //checking whether the session is set or not
{
    echo $_SESSION['add']; //displaying session message
    unset($_SESSION['add']); //removing session message
}
if(isset($_SESSION['upload']))
{
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}
?>

<div class="clearfix"></div>
<form action=""method="POST" enctype="multipart/form-data">
    <table style="width:30%">
            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" placeholder="Enter Username" required></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" placeholder="Enter Email" required></td>
            </tr>
            <tr>
            <td>Restuarent ID:</td>
            <td><input type="text" name="restuarent_id" placeholder="Enter Restuarent Id" required></td>
            </tr>
            <tr>
                <td>Select Image:</td>
                <td><input type="file" name="image">
                </td>
            </tr>

            <tr>

                <td colspan="2">
                    <input type="submit" name="submit" value="Add" class="btn-secoundary" >
                </td>
            </tr>
    </table>
</form>

</div>
</div>
<?php include('partials/footer.php')?>
<?php 
// process of saving form details in database
// check whether submit button is clicked or not
if(isset($_POST['submit']))
{
    
    //echo'button clicked';
    //get data from the form
    $username=$_POST['username'];
    $email=$_POST['email'];
    $restuarent_id=$_POST['restuarent_id'];
   
    if(isset($_FILES['image']['name'])){
        $image_name = $_FILES['image']['name'];
        if($image_name!="")
        {
            $ext = end(explode('.',$image_name));
            $image_name="restuarent_add_".rand(000,999).'.'.$ext;
            $source_path = $_FILES['image']['tmp_name'];
            $destinatio_path ="../images/restuarent/".$image_name;
            $upload = move_uploaded_file($source_path, $destinatio_path );
            if($upload==false)
            {
                $_SESSION['upload']="<div class='error'>failed to uplaod </div>";
                header('location:'.SITEURL.'admin/add-admin.php');
                die();
            }
            //auto rename        
        }        
        else
        {
            $image_name="";
        }
    }

    //create sql query to save data in database
    $sql="INSERT INTO tbl_admin set 
    username='$username',
    email='$email',
    restuarent_id='$restuarent_id',
    image_name='$image_name' ";

   //execute query and save data in database 
   $res = mysqli_query($conn, $sql);

   if($res==true)
   {
        //data inserted
        //echo "data inserted";
        //create a session variable to diplay message
        $_SESSION['add'] = "Hooray Restaurant Owner Added Successfully";
        //redirect page to account.php
        header("location:".SITEURL.'admin/account.php');

   }
   else
   {
      //echo "data not inserted";
      //failed to insert
                   //create a session variable to diplay message
                   $_SESSION['add']="Oops Failed to Add Restaurant Owner";
                   //redirect page to add-admin.php
                   header("location:".SITEURL.'admin/add-admin.php');

   }

} 

    


?>

