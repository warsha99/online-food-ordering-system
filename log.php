<?php 

include 'config.php';

session_start();

error_reporting(0);



if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	
   

	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$usertype=$row['usertype'];
    
    if ($result->num_rows > 0) {
		if($usertype=='Customer'){
		
		$_SESSION['username'] = $row['username'];
		header("Location: index.php");
		}
		else{
			$_SESSION['username'] = $row['username'];
		header("Location:res1/manage-category.php");
		}
	} else {
		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
		
		
	}
}
$email = "";
$_POST['password'] = "";

if($result){
    include 'test1.php';
}

?>