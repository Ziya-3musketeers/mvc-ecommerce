<?php
  spl_autoload_register('myAutoLoader');

  function myAutoLoader($classNaOG) {
    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    if (strpos($url, 'includes') !== false){
      $path = "../classes/";
    }
    else {
      $path = "classes/";
    }
    
    $extension = ".class.php";
    require_once $path . $classNaOG . $extension;
  } 