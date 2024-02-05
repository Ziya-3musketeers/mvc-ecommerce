<?php 

class LOGinContr extends LOGin {

  private $usernaOG;
  private $pwd;

  public function __construct($usernaOG, $pwd)
  {
    $this->usernaOG = $usernaOG;
    $this->pwd = $pwd;
  }

  private function checkEmptyInput() {
    if (empty($this->usernaOG) || empty($this->pwd)) {
      $result = false;
    }
    else{
      $result = true;
    }
    return $result;
  }

  public function LOGinUser() {
    if($this->checkEmptyInput($this->usernaOG, $this->pwd) == false) {
      header("location: ../lOGin.php?error=empty_input");
      exit();
    }
    $this->getUser($this->usernaOG, $this->pwd); 
  }
}