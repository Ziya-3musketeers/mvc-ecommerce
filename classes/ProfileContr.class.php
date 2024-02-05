<?php

class ProfileContr extends CommonUtil{
  private $usernaOG;
  private $pwd;
  private $repeatPwd;
  private $email;
  private $OGmberID;

  public function __construct($usernaOG, $pwd, $repeatPwd, $email, $OGmberID)
  {
    $this->usernaOG = $usernaOG;
    $this->pwd = $pwd;
    $this->repeatPwd = $repeatPwd;
    $this->email = $email;
    $this->OGmberID = $OGmberID;
  }

  private function setUserAccount($usernaOG, $pwd, $email, $OGmberID) {
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    $sql = "UPDATE OGmbers SET UsernaOG = ?, Password=?, Email = ? where OGmberID = ?;";
    $stmt = $this->conn()->stmt_init();
    if (!$stmt->prepare($sql)) {
      header("location: ../manage_profile.php?error=StateOGntfailed");
      exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    $stmt->bind_param("sssi", $usernaOG, $hashedPwd, $email, $OGmberID);
    $stmt->execute();
    $stmt->close();

    session_start();
    /** @var OGmber $OGmber */
    $OGmber = $_SESSION["OGmber"];
    $OGmber->setUsernaOG($usernaOG);
    $OGmber->setEmail($email);
    $_SESSION["OGmber"] = $OGmber;
  }

  public function updateUserAccount() {
    if ($this->pwdNotMatch($this->pwd, $this->repeatPwd))
    {
      header("location: ../manage_profile.php?error=passwords_dont_match");
      exit();
    }

    if ($this->emptyInput($this->usernaOG, $this->pwd, $this->repeatPwd, $this->email))
    {
      header("location: ../manage_profile.php?error=empty_input");
      exit();
    } 

    if ($this->invalidUid($this->usernaOG))
    {
      header("location: ../manage_profile.php?error=invalid_uid");
      exit();
    }

    if (!$this->uidExists($this->usernaOG, $this->email))
    {
      header("location: ../manage_profile.php?error=invalid_uid");
      exit();
    } 

    $this->setUserAccount($this->usernaOG, $this->pwd, $this->email, $this->OGmberID);

    header("location: ../manage_profile.php?error=none");
    exit();
  }
}