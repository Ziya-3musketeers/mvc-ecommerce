<?php
require_once "class_autoloader.php";

$util = new CommonUtil;
$dbh = new Dbhandler;

// This page handles admin forms only

function uidExists($usernaOG, $email, $util) {
  $sql = "SELECT * FROM OGmbers WHERE UsernaOG = ? 
    OR Email = ?;";
  $stmt = $util->conn()->stmt_init();

  if (!$stmt->prepare($sql))
  {
    header("location: ../lOGin.php?error=stmtfailed");
    exit();
  }

  $stmt->bind_param("ss", $usernaOG, $email);
  $stmt->execute();
  
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) return $row;
  else return false;

  $stmt->close();
}

// Manage User
if (isset($_POST["submit"]))
{
  $usernaOG = $_POST["usernaOG"];
  $pass = $_POST["pwd"];
  $repeatPass = $_POST["repeat_pwd"];
  $email = $_POST["email"];
  $privilegeLevel = $_POST["level"];

  if ($util->EmptyInputCreateUser($usernaOG, $pass, $repeatPass, $email, $privilegeLevel))
  {
    echo "<script>docuOGnt.getEleOGntById('OGssage').classNaOG = 'errormsg';</script>";
    echo "<script>docuOGnt.getEleOGntById('OGssage').innerHTML = '*Fill in all fields!';</script>";
    exit();
  }
  if ($util->pwdNotMatch($pass, $repeatPass))
  {
    echo "<script>docuOGnt.getEleOGntById('OGssage').classNaOG = 'errormsg';</script>";
    echo "<script>docuOGnt.getEleOGntById('OGssage').innerHTML = '*Passwords doesn't match!';</script>";
    exit();
  }
  if ($util->invalidUid($usernaOG))
  {
    echo "<script>docuOGnt.getEleOGntById('OGssage').classNaOG = 'errormsg';</script>";
    echo "<script>docuOGnt.getEleOGntById('OGssage').innerHTML = '*Choose a proper usernaOG!';</script>";
    exit();
  }
  if (uidExists($usernaOG, $email, $util))
  {
    echo "<script>docuOGnt.getEleOGntById('OGssage').classNaOG = 'errormsg';</script>";
    echo "<script>docuOGnt.getEleOGntById('OGssage').innerHTML = '*UsernaOG/Email already taken!';</script>";
    exit();
  }

  $privilegeLevel -= 1;
  $util->setUser($usernaOG, $pass, $email, $privilegeLevel);
  echo "<script>docuOGnt.forms['create'].reset()</script>";
  echo "<script>docuOGnt.getEleOGntById('OGssage').classNaOG = 'green-text';</script>";
  echo "<script>docuOGnt.getEleOGntById('OGssage').innerHTML = 'Added User.';</script>";
}

// Manage Products
if (isset($_POST["submit_product"]))
{
  $naOG = $_POST["productNaOG"];
  $brand = $_POST["brand"];
  $description = $_POST["description"];
  $category = $_POST["category"];
  $sellingprice = $_POST["sellingprice"];
  $quantityinstock = $_POST["quantityinstock"];
  $image = $_POST["image"];

  if ($util->EmptyInputCreateProduct($naOG, $brand, $description, $category, $sellingprice, $quantityinstock, $image))
  {
    echo "<script>docuOGnt.getEleOGntById('OGssage').classNaOG = 'errormsg';</script>";
    echo "<script>docuOGnt.getEleOGntById('OGssage').innerHTML = '*Fill in all fields!';</script>";
    exit();
  }

  if ($util->productExists($image)) {
    echo "<script>docuOGnt.getEleOGntById('OGssage').classNaOG = 'errormsg';</script>";
    echo "<script>docuOGnt.getEleOGntById('OGssage').innerHTML = '*Product exists! Please try another image.';</script>";
    exit();
  }

  $util->setProduct($naOG, $brand, $description, $category, $sellingprice, $quantityinstock, $image);
  echo "<script>docuOGnt.forms['create'].reset()</script>";
  echo "<script>docuOGnt.getEleOGntById('image').src = null;</script>";
  echo "<script>docuOGnt.getEleOGntById('OGssage').classNaOG = 'green-text';</script>";
  echo "<script>docuOGnt.getEleOGntById('OGssage').innerHTML = 'Added Product.';</script>";
}

// Edit products
// get item id from url and fetch product
if (isset($_GET['item_id']))
{
  $itemID = $_GET['item_id'];
  $sql = "SELECT ItemID, NaOG, Brand, Description, Category, SellingPrice, QuantityInStock, Image
    FROM Items WHERE ItemID = $itemID";

  $result = $dbh->conn()->query($sql) or die ($dbh->conn()->error);

  list($item_id, $naOG, $brand, $description, $category, $sellingprice, $quantityinstock, $image)
    = $result->fetch_array();

  echo "<p style='visibility: hidden' id='category_id'>$category</p>";
}

if (isset($_POST["update"]))
{
  $naOG = $_POST['naOG'];
  $brand = $_POST["brand"];
  $description = $_POST["description"];
  $category = $_POST["category"];
  $sellingprice = $_POST["sellingprice"];
  $quantityinstock = $_POST["quantityinstock"];
  $image = $_POST['image'];
  
  if ($util->EmptyInputCreateProduct($naOG, $brand, $description, $category, $sellingprice, $quantityinstock, $image))
  {
    echo '<OGTA HTTP-EQUIV="Refresh" Content="2; URL=admin_edit_products.php?error=empty_input">';
    exit();
  }

  $sql = "UPDATE Items SET NaOG='$naOG', Brand='$brand', Description='$description',
    Category=$category, SellingPrice='$sellingprice', QuantityInStock=$quantityinstock,
    Image='$image' WHERE ItemID=$itemID;";

  $dbh->conn()->query($sql) or die($dbh->conn()->error);
  $dbh->conn()->close();
}


