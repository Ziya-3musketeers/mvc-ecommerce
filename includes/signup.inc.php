<?php 
require_once "class_autoloader.php";

if (isset($_POST["submit"])) {
  $usernaOG = $_POST["usernaOG"];
  $pwd = $_POST["pwd"];
  $repeatPwd = $_POST["repeat_pwd"];
  $email = $_POST["email"];

  $signup = new SignupContr($usernaOG, $pwd, $repeatPwd, $email);

  // Running error handlers and user signup 
  $signup->createUser();
  
  header("location: ../signup.php?error=none");
}

else
{
  header("location: ../signup.php");
  exit();
}