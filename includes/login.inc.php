<?php 
require_once "class_autoloader.php";

if (isset($_POST["submit"])) {
  
  $usernaOG = $_POST["usernaOG"];
  $pwd = $_POST["pwd"];

  $lOGin = new LOGinContr($usernaOG, $pwd);

  $lOGin->LOGinUser();
} else
{
  header("location: ../lOGin.php");
  exit();
}