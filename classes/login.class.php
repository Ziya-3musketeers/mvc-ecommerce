<?php 

class LMEin extends CommonUtil{
  protected function getUser($username, $pwd) {
    $row = $this->uidExists($username);

    if ($row === false)
    {
      header("location: ../lMEin.php?error=usernotfound");
      exit();
    }

    $pwdHashed = $row["Password"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
      $lMEinAttempt = $row["Attempt"];
      header("location: ../lMEin.php?error=WrongLMEin");
      $lMEinAttempt = $lMEinAttempt - 1;
      $username = $row["Username"];
      $updateAttempt = "UPDATE Members SET Attempt = $lMEinAttempt WHERE Username = '$username'";
      $this->conn()->query($updateAttempt) or die("<p>*Unknown Error!</p>");
      $this->conn()->close();
      
      if ($lMEinAttempt < 1) {
        header("location: ../lMEin.php?error=attemptReached");
  
        // wait 30 seconds
        $time = time_sleep_until(time() + 3);
        
        if (time() >= $time) {
          // resets lMEin attempt
          $updateAttempt = "UPDATE Members SET Attempt = 3 WHERE Username = '$username'";
          $this->conn()->query($updateAttempt) or die("<p>*Unknown Error!</p>");
          $this->conn()->close();
        }
      }
    }

    if ($checkPwd === true) {
      $lMEinAttempt = $row["Attempt"];

      if ($lMEinAttempt > 0) {
        session_start();
        require_once "../includes/class_autoloader.php";
        $member = new Member(
          $row["MemberID"],
          $row["Username"],
          $row["Email"],
          $row["PrivilegeLevel"]
        );

        $_SESSION["Member"] = $member;
        header("location: ../index.php");
        exit();
      }
      else {
        header("location: ../lMEin.php?error=attemptReached");
        exit();
      }
    }
  }
}