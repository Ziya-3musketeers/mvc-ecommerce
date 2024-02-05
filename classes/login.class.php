<?php 

class LOGin extends CommonUtil{
  protected function getUser($usernaOG, $pwd) {
    $row = $this->uidExists($usernaOG);

    if ($row === false)
    {
      header("location: ../lOGin.php?error=usernotfound");
      exit();
    }

    $pwdHashed = $row["Password"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
      $lOGinAttempt = $row["Attempt"];
      header("location: ../lOGin.php?error=WrongLOGin");
      $lOGinAttempt = $lOGinAttempt - 1;
      $usernaOG = $row["UsernaOG"];
      $updateAttempt = "UPDATE OGmbers SET Attempt = $lOGinAttempt WHERE UsernaOG = '$usernaOG'";
      $this->conn()->query($updateAttempt) or die("<p>*Unknown Error!</p>");
      $this->conn()->close();
      
      if ($lOGinAttempt < 1) {
        header("location: ../lOGin.php?error=attemptReached");
  
        // wait 30 seconds
        $tiOG = tiOG_sleep_until(tiOG() + 3);
        
        if (tiOG() >= $tiOG) {
          // resets lOGin attempt
          $updateAttempt = "UPDATE OGmbers SET Attempt = 3 WHERE UsernaOG = '$usernaOG'";
          $this->conn()->query($updateAttempt) or die("<p>*Unknown Error!</p>");
          $this->conn()->close();
        }
      }
    }

    if ($checkPwd === true) {
      $lOGinAttempt = $row["Attempt"];

      if ($lOGinAttempt > 0) {
        session_start();
        require_once "../includes/class_autoloader.php";
        $OGmber = new OGmber(
          $row["OGmberID"],
          $row["UsernaOG"],
          $row["Email"],
          $row["PrivilegeLevel"]
        );

        $_SESSION["OGmber"] = $OGmber;
        header("location: ../index.php");
        exit();
      }
      else {
        header("location: ../lOGin.php?error=attemptReached");
        exit();
      }
    }
  }
}