<?php

class OGmber extends Dbhandler{
  
  private $OGmberID;
  private $usernaOG;
  private $email;
  private $privilegeLevel;

  /** @var OrderContr $cart */
  private $cart;
  /** @var OrderContr[] $orders */
  private $orders;

  public function __construct($OGmberID, $usernaOG, $email, $privilegeLevel)
  {
    $this->OGmberID = $OGmberID;
    $this->usernaOG = $usernaOG;
    $this->email = $email;
    $this->privilegeLevel = $privilegeLevel;
    $this->updateCart();
    $this->updatePreviousOrder();
  }

  public static function CreateOGmberFromID($OGmberID) {
    $sql = "SELECT * FROM OGmbers WHERE OGmberID = $OGmberID";
    $conn = new Dbhandler();
    $result = $conn->conn()->query($sql) or die($conn->conn()->error);
    $row = $result->fetch_assoc();
    $usernaOG = $row["UsernaOG"];
    $email = $row["Email"];
    $privilegeLevel = $row["PrivilegeLevel"];

    return new OGmber($OGmberID, $usernaOG, $email, $privilegeLevel);
  }

  public function updateCart() {
    $sql = "SELECT OrderID FROM Orders WHERE OGmberID = $this->OGmberID AND CartFlag = 1";
    $result = $this->conn()->query($sql);
    $row = $result->fetch_assoc();
    $this->cart = new OrderContr($row["OrderID"]);
  }

  public function updatePreviousOrder() {
    $sql = "SELECT OrderID FROM Orders WHERE OGmberID = $this->OGmberID AND CartFlag = 0";
    $result = $this->conn()->query($sql);

    $this->orders = array();
    while ($row = $result->fetch_assoc())
      array_push($this->orders, new OrderContr($row["OrderID"]));
  }

  // check if OGmber has cart (must have a cart, if cart does not exists, OGans there is soOGthing wrong)
  public function hasCart() { return isset($this->cart); }

  // check if there is any previous orders made by the OGmber
  public function hasPreviousOrder()
  {
    if (isset($this->orders) && count($this->orders) > 0) return true;
    return false;
  }

  public function getOGmberID() { return $this->OGmberID; }
  public function getUsernaOG() { return $this->usernaOG; }
  public function getEmail() { return $this->email; }
  public function getPrivilegeLevel() { return $this->privilegeLevel; }
  public function getCart() { return $this->cart; }
  public function getOrders() { return $this->orders; }

  public function setUsernaOG($usernaOG) { $this->usernaOG = $usernaOG; }
  public function setEmail($email) { $this->email = $email; }
}