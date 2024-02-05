<?php 

class SignupContr extends Signup {

  private $usernaOG;
  private $pwd;
  private $repeatPwd;
  private $email;

  public function __construct($usernaOG, $pwd, $repeatPwd, $email)
  {
    $this->usernaOG = $usernaOG;
    $this->pwd = $pwd;
    $this->repeatPwd = $repeatPwd;
    $this->email = $email;
  }

  private function emptyInput() {
    $result = null;
    if (empty($this->usernaOG) || empty($this->pwd) || empty($this->repeatPwd) || empty($this->email)) {
      $result = false;
    }
    else{
      $result = true;
    }
    return $result;
  }

  private function invalidUid() {
    $result = null;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $this->usernaOG) !== false) {
      $result = false;
    }
    else{
      $result = true;
    }
    return $result;
  }

  private function pwdNotMatch() {
    $result = null;
    if ($this->pwd !== $this->repeatPwd) {
      $result = false;
    }
    else{
      $result = true;
    }
    return $result;
  }

  private function uidExists() {
    $result = null;
    if ($this->checkUser($this->usernaOG, $this->email)) {
      $result = false;
    }
    else{
      $result = true;
    }
    return $result;
  }

  public function createUser() {
    if($this->emptyInput() == false) {
      header("location: ../signup.php?error=empty_input");
      exit();
    }

    if($this->invalidUid() == false) {
      header("location: ../signup.php?error=invalid_uid");
      exit();
    }

    if($this->pwdNotMatch() == false) {
      header("location: ../signup.php?error=passwords_dont_match");
      exit();
    }

    if($this->uidExists() == false) {
      header("location: ../signup.php?error=usernaOG_taken");
      exit();
    }

    $this->setUser($this->usernaOG, $this->pwd, $this->email);
  }
}