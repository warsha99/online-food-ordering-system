<?php include('partials/menu.php');?>

<div class="main-content">
<div class="wrapper">
<h1>Manage Restaurant Owners</h1>
<br>
<br>
<br>
<?php
if(isset($_SESSION['add']))
{
    echo $_SESSION['add']; //displaying session message
    unset($_SESSION['add']); //removing session message
}



if(isset($_SESSION['delete']))
{
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}
if(isset($_SESSION['update']))
{
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}

if(isset($_SESSION['user-not-found']))
{
    echo $_SESSION['user-not-found'];
    unset($_SESSION['user-not-found']);
}

if(isset($_SESSION['change-pwd']))
{
    echo $_SESSION['change-pwd'];
    unset($_SESSION['change-pwd']);
}
if(isset($_SESSION['pwd-not-match']))
{
    echo $_SESSION['pwd-not-match'];
    unset($_SESSION['pwd-not-match']);
}

?>
<br>
<br>
<a href="add-admin.php"class="btn-primary">Add Restuarent owner</a>
<br>
<br>
<br>
<table class="tbl-full">
    <tr>
        <th>S.N.</th>
        <th>Username</th>
        <th>Email</th>
        <th>Restuarent ID</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>

<?php
//query to get all admin
$sql ="SELECT * FROM tbl_admin";

// execute the query
$res = mysqli_query($conn, $sql);

//check whether the query is executed or not
if($res==TRUE)
{
    //count rows to check whether we have data in database or not 
    $count = mysqli_num_rows($res); //function to get all the rows in databsase 
    $sn=1;

    //check the num of rows 
    if($count>0)
    {
        // we have data in database
        while($rows=mysqli_fetch_assoc($res)){

            //using while loop to get all the data from database
            //And while loop will run as long as data in database 

            //get individual data
            $id=$rows['id']; 
            $username=$rows['username'];
            $email=$rows['email'];
            $restuarent_id=$rows['restuarent_id'];
            $image_name=$rows['image_name'];
            

            //display the value in our table 
            ?>

            <tr>
                <td><?php echo $sn++;?></td>
                <td><?php echo $username;?></td>
                <td><?php echo $email;?></td>
                <td><?php echo $restuarent_id;?></td>
                <td><?php 
                    if($image_name==""){
                        echo"<div class ='error'>Image not added.</div>";
                    }
                    else{
                        ?>
                    <img src="<?php echo SITEURL;?>images/restuarent/<?php echo $image_name;?>" width="100px"   >

                        <?php
                    }
                    ?>
                <td>
                <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id?>&image_name=<?php echo $image_name;?>"class="btn-secoundary">Update Details</a>
                <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id?>&image_name=<?php echo $image_name;?>"class="btn-delete">Delete Details</a> 

                </td>
            <?php
        }
    }
    else
    {
        //we do not have data in database
    }
}
?>
</table>

<div class="clearfix"></div>

</div>
</div>
<?php include('partials/footer.php')?>
