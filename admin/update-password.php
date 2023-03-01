<?php include('partials/menu.php');?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Change password</h1>
            <br>
            <br>
            <br>
                <?php
                if(isset($_GET['id'])){
                $id=$_GET['id'];
                }
                ?>  
            <form action=""method="post">
                <table style="width:30%">
                    <tr>
                        <td>Current Password:</td>
                        <td><input type="password" name="current_password" placeholder="Enter Current Password"></td>
                    </tr>
                    <tr>
                        <td>New Password:</td>
                        <td><input type="password" name="new_password" placeholder="Enter New Password"></td>
                    </tr>
                    <tr>
                        <td>Confirm Password:</td>
                        <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                    </tr>
                    <tr>
                        <td colspan="2">  
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secoundary" style="width:130px;border:none;padding:2%;margin:3%" >
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
<?php

//check whether the submit button is clicked or not 
if(isset($_POST['submit']))
{
    //echo clicked 
    //get the data from the form
    $id=$_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);

    //check whether the user with current id and current password exit or not 
    $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    //execute the query
    $res = mysqli_query($conn, $sql);


        if($res==true){
        
        //check whether the data is available or not 
        $count=mysqli_num_rows($res);
            if($count==1){

                //user exit and password can be changed 
                //echo"user found";

                //check whether the new password and confirm password 
                if($new_password==$confirm_password)
                    {
                    
                    //update the password 
                    //echo"Password match";
                    $sql2 = "UPDATE tbl_admin SET 
                    password='$new_password' 
                    WHERE id=$id";
                    //execute the query
                    $res2 = mysqli_query($conn, $sql2);

                        //check whether the query is executed or not 
                        if($res2==true){

                            //display successfull
                            $_SESSION['change-pwd']="<div class='success'>Password changed successfully.</div>";
                            header('location:'.SITEURL.'admin/account.php');
                
                        }
                        else{
                            //display error 
                            $_SESSION['change-pwd']="<div class='error'>Failed to change password.</div>";
                            header('location:'.SITEURL.'admin/account.php');
                        }

                    }
                else
                {
                //redirect to account.php with error message 
                $_SESSION['pwd-not-match']="<div class='error'>Password Did Not Match.</div>";
                header('location:'.SITEURL.'admin/account.php');
                }
            }
            else
            {
            // user does not exit set message and redirect
            $_SESSION['user-not-found']="<div class='error'>User Not found.</div>";
            header('location:'.SITEURL.'admin/account.php');
            }
        }



}


?>




<?php include('partials/footer.php')?>