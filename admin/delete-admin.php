<?php
//include constants.php file 
include('../config/constants.php');

//get the id of the admin to be deleted
$id = $_GET['id'];

//createe sql query to delete admin
$sql = "DELETE FROM tbl_admin where id=$id";

// execute the query
$res = mysqli_query($conn, $sql);

//check whether query is executed successfully or not
if($res==true)
{
    // query executed successfully and admin deleted 
    //echo "deteted";
    // create session variable to display message
    $_SESSION['delete']="<div class='success'>Admin Deleted Successfully.</div>";
    //redirected to account.php
    header("location:".SITEURL.'admin/account.php');
}
else{
     // query not executed successfully and failed to delete admin
    $_SESSION['delete']="<div class='error'>failed to delete admin.</div>";
    header("location:".SITEURL.'admin/account.php');

}


//redirect to manage admin page with message






?>