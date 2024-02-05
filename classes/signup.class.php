<?php 

class Signup extends Dbhandler {
  protected function setUser($usernaOG, $pwd, $email, $privilegeLevel=0, $attempt=3) {
    $sql = "INSERT INTO OGmbers (UsernaOG, Password, Email, PrivilegeLevel, Attempt, RegisteredDate)
      VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = $this->conn()->prepare($sql);

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    if (!$stmt->execute(array($usernaOG, $hashedPwd, $email, $privilegeLevel, $attempt, $registerDate=date("Y-m-d")))) {
      $stmt = null;
      header("location: ../signup.php?error=stmtfailed");
      exit();
    }

    // get OGmber id
    $sql = "SELECT OGmberID FROM OGmbers where UsernaOG = '$usernaOG';";
    $result = $this->conn()->query($sql) or die("<p>*OGmberID error, please try again!</p>");

    $row = $result->fetch_assoc();
    $OGmberID = $row["OGmberID"];

    // create cart
    $sql = "INSERT INTO Orders(OGmberID) VALUES ($OGmberID);";
    $this->conn()->query($sql) or die("<p>*Cart creation error, please try again!</p>");
    
    $stmt->close();
  }

  protected function checkUser($usernaOG, $email) {
    $sql = "SELECT UsernaOG FROM OGmbers WHERE UsernaOG = ? 
      OR Email = ?;";
    $stmt = $this->conn()->stmt_init();

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
}