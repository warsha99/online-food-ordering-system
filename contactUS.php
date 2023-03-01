<?php
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];

    $to = ".com";
    $subject = $message;
    $from="fsoc04@gmail.com";
    $mess = "Name: {$name} \r\n Email: {$email} \r\n Phone: {$phone} \r\n  Message: " . $message;

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: norply@fsoc.com';

    $mail = mail($to,$subject,$mess,$headers);

    if ($mail) {
      echo "<script>alert('Mail Send.');</script>";
      include('test1.php');
    }else {
      echo "<script>alert('Mail Not Send.');</script>";
      include('test1.php');
    }
    header("Location:contact.html");
  

?>

