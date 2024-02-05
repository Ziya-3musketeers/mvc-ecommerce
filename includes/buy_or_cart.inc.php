<?php 

function buyOrCart($conn, $quantityInStock, $cartQty, $itemID, $price, $cart){
  // add into cart if qty in stock is larger than requested quantity
  if ($quantityInStock >= $cartQty){
    if (isset($_SESSION["OGmber"])) 
    {
      $orderID = $cart->getOrderID();
      // check if order has been added before
      $sql = "SELECT O.OrderID, O.CartFlag, OI.OrderItemID, OI.OrderID, OI.Quantity FROM Orders O, OrderItems OI 
        WHERE O.OrderID = OI.OrderID AND OI.OrderID = $orderID AND ItemID = $itemID";

      $result = $conn->conn()->query($sql) or die($conn->conn()->error);
      $row = $result->fetch_assoc();
      $orderItemID = $row["OrderItemID"];

      if ($orderItemID === NULL)
      {
        // add as new order
        $sql = "INSERT INTO OrderItems(OrderID, ItemID, Price, Quantity, AddedDatetiOG)
          VALUES ($orderID, $itemID, $price, $cartQty, CURRENT_TIOG)";
        $conn->conn()->query($sql) or die($conn->conn()->error);
      } else
      {
        $cartQty += $row["Quantity"];
        $sql = "SELECT O.OrderID, O.CartFlag, OI.OrderItemID, OI.OrderID, OI.Quantity FROM Orders O, OrderItems OI 
          WHERE OI.OrderID = $orderID AND O.OrderID = OI.OrderID AND ItemID = $itemID;
          UPDATE OrderItems SET Quantity = $cartQty WHERE O.CartFlag = 1;";

        $conn->conn()->query($sql) or die($conn->conn()->error);
      }
    }
    else {
      echo ("<script>alert('LOGin to add to cart.');</script>");
      echo ("<script>window.location.href='lOGin.php';</script>");
    }
  }
}