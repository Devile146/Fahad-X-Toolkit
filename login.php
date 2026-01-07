<?php
session_start();

if(!isset($_POST['action'])){
  exit;
}

if($_POST['action']=="send"){
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "Invalid email address";
    exit;
  }

  $otp = rand(100000,999999);
  $_SESSION['otp'] = $otp;

  $subject = "YOUR FAHAD-X TOOLKIT 'S LOGIN OTP";
  $message = "Your Login OTP is: $otp";
  $headers = "From: Fahad-X <no-reply@".$_SERVER['HTTP_HOST'].">";

  if(mail($email,$subject,$message,$headers)){
    echo "OTP sent to your email";
  }else{
    echo "Email sending failed";
  }
  exit;
}

if($_POST['action']=="verify"){
  if(isset($_SESSION['otp']) && $_POST['otp']==$_SESSION['otp']){
    unset($_SESSION['otp']);
    echo "success";
  }else{
    echo "Wrong OTP";
  }
  exit;
}
