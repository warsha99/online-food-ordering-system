<?php 

include 'config.php';

error_reporting(0);

session_start();



if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);
    $usertype=$_POST['usertype'];

    


	if ($password == $cpassword) {
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO users (username, email, password,usertype)
					VALUES ('$username', '$email', '$password','$usertype')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Wow! User Registration Completed.')</script>";
				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
				include 'test1.php';
			}
		} else {
			echo "<script>alert('Woops! Email Already Exists.')</script>";
			$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			include 'test1.php';
		}
		
	} else {
		echo "<script>alert('Password Not Matched.')</script>";
		$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
		include 'test1.php';
	}
}
$username = "";
$email = "";
$_POST['password'] = "";
$_POST['cpassword'] = "";
if($result){
    include 'test1.php';
}
?>

