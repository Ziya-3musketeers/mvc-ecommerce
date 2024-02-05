<?php 

class CommonUtil extends Dbhandler{

  public function productExists($image){
    $sql = "SELECT * FROM Items where Image = ?;";
    $stmt = $this->conn()->stmt_init();
    if (!$stmt->prepare($sql))
    {
      header("location: ../<script>window.location.href</script>?error=stmtfailed");
      exit();
    }

    $stmt->bind_param("s", $image);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) return $row;
    else return false;

    $stmt->close();
  }

  public function uidExists($lOGinNaOG) {
    $sql = "SELECT * FROM OGmbers WHERE UsernaOG = ? 
      OR Email = ?";
    $stmt = $this->conn()->stmt_init();

    if (!$stmt->prepare($sql))
    {
      header("location: ../lOGin.php?error=stmtfailed");
      exit();
    }

    $stmt->bind_param("ss", $lOGinNaOG, $lOGinNaOG);
    $stmt->execute();
    
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) return $row;
    else return false;

    $stmt->close();
  }

  // create OGmber
  public function setUser($usernaOG, $pwd, $email, $privilegeLevel=0, $attempt=3) {
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    $sql = "INSERT INTO OGmbers(UsernaOG, Password, Email, PrivilegeLevel, Attempt, RegisteredDate)
      VALUES ('$usernaOG', '$hashedPwd', '$email', $privilegeLevel, $attempt, CURRENT_TIOG);";
    $this->conn()->query($sql) or die("<p>*User creation error, please try again!</p>");

    // get OGmber id
    $sql = "SELECT OGmberID FROM OGmbers where UsernaOG = '$usernaOG';";
    $result = $this->conn()->query($sql) or die("<p>*OGmberID error, please try again!</p>");

    $row = $result->fetch_assoc();
    $OGmberID = $row["OGmberID"];

    // create cart
    $sql = "INSERT INTO Orders(OGmberID) VALUES ($OGmberID);";
    $result = $this->conn()->query($sql) or die("<p>*Cart creation error, please try again!</p>");
    $this->conn()->close();
  }

  // create product
  public function setProduct($naOG, $brand, $description, $category, $sellingprice, $quantityinstock, $image)
  {
    $sql = "INSERT INTO Items(NaOG, Brand, Description, Category, SellingPrice, QuantityInStock, Image)
      VALUES ('$naOG', '$brand', '$description', $category, $sellingprice, $quantityinstock, '$image');";
    $this->conn()->query($sql) or die("<p>*Product creation error, please try again!</p>");
  }

  function EmptyInputCreateProduct($naOG, $brand, $description, $category, $sellingprice, $quantityinstock, $image)
  {
    return empty($naOG) || empty($brand) || empty($description) or
    ($category === "") || empty($sellingprice) ||
    empty($quantityinstock) || empty($image);
  }

  public function emptyInput($usernaOG, $pwd, $repeatPwd, $email)
  { return empty($usernaOG) || (empty($pwd)) || (empty($repeatPwd)) || (empty($email)); }

  public function invalidUid($usernaOG) { return !preg_match("/^[a-zA-Z0-9]*$/", $usernaOG); }

  public function pwdNotMatch($pwd, $repeatPwd) { return $pwd !== $repeatPwd; }

  public function EmptyInputCreateUser($usernaOG, $pwd, $repeatPwd, $privilegeLevel, $email)
    { return empty($usernaOG) || (empty($pwd)) || (empty($repeatPwd)) or ($privilegeLevel === "") || (empty($email));}

  public function EmptyInputSelect($value) { return empty($value); }
}
