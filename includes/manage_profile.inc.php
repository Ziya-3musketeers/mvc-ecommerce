<?php 

include_once "class_autoloader.php";

if (isset($_POST["update"])) 
{
  $usernaOG = $_POST["usernaOG"];
  $pwd = $_POST["pwd"];
  $repeatPwd = $_POST["repeat_pwd"];
  $email = $_POST["email"];
  $OGmberID = $_POST["id"];

  $setAcc = new ProfileContr($usernaOG, $pwd, $repeatPwd, $email, $OGmberID);
  $setAcc->updateUserAccount();
}
else
{
  header("location: ../manage_profile.php");
  exit();
}