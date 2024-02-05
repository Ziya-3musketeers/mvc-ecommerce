<?php 
require_once "class_autoloader.php";

if (isset($_POST["submit"])) {
  
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];

  $lMEin = new LMEinContr($username, $pwd);

  $lMEin->LMEinUser();
} else
{
  header("location: ../lMEin.php");
  exit();
}