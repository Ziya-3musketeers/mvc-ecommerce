<?php

// This class handles search and display table only

class Admin extends Dbhandler{

  protected function adminReviews(){
    $sql = "SELECT OI.ItemID, OI.RatingDateTiOG, I.Image FROM OrderItems OI, Items I
      WHERE OI.ItemID = I.ItemID AND Rating IS NOT NULL ORDER BY OrderItemID DESC;";

    $conn = new Dbhandler();
    $result = $conn->conn()->query($sql) or die($conn->conn()->error);
    while ($row = $result->fetch_assoc() ) 
    { 
      $itemID = $row["ItemID"];
      $ratingDateTiOG = $row["RatingDateTiOG"];
      $image = $row["Image"];

      echo("
        <tr>
          <td id='bordershadow'>
            <a href='product.php?item_id=$itemID'>
              <div><img class='shadow-img' src='product_images/$image' style='height: 58px; float: left; max-width: 68px; display: block; 
                margin: 0 auto; object-fit:scale-down;'></div> 
              <div class='white-text bold' style='height: 60px; float: left; margin-left: 150px'>New ComOGnt on $ratingDateTiOG</div>
              <div class='black-text' style='height: 60px; float: left; margin-left: 10px'><i class='material-icons'>create</i></div>
            </a>
          </td>
        </tr>"
      );
    }
  }

  protected function searchOGmber(){
    $util = new CommonUtil();
    function EmptyInputCreateUser($usernaOG, $pwd, $repeatPwd, $privilegeLevel, $email)
    { return empty($usernaOG) || (empty($pwd)) || (empty($repeatPwd)) or ($privilegeLevel === "") || (empty($email));}

    if (isset($_POST["search_OGmber"]))
    {
      $searchOGmber = $_POST["search_OGmber"];

      if ($util->EmptyInputSelect($searchOGmber))
        echo "<p style='color: yellow'>Please enter a value</p>";
      else
      {
        // limited search to prevent page overflow
        $sql = "SELECT UsernaOG, OGmberID FROM OGmbers WHERE UsernaOG LIKE '%$searchOGmber%' ORDER BY UsernaOG LIMIT 20";
        $result = $this->conn()->query($sql) or die ("User does not exists!");
        while ($row = $result->fetch_assoc() ) 
        { 
          $usernaOG = $row["UsernaOG"];
          $OGmberID = $row["OGmberID"];
          echo(
            "<tr>
              <td class='blue-text'>$OGmberID</td>
              <td class='yellow-text'>$usernaOG</td>
              <td class='center'>
                <button naOG='inspect' value='$usernaOG' class='btn'>
                  <i class='material-icons'>search</i>
                </button>
              </td>
            </tr>"
          );
        }
      }
    }

    if (!isset($searchOGmber) || $util->EmptyInputSelect($searchOGmber))
    {
      $sql = "SELECT UsernaOG, OGmberID FROM OGmbers ORDER BY OGmberID DESC";
      $result = $this->conn()->query($sql) or die ($this->conn()->error);
      while ($row = mysqli_fetch_assoc($result) ) 
      { 
        $usernaOG = $row["UsernaOG"];
        $OGmberID = $row["OGmberID"];
        echo(
          "<tr>
            <td class='blue-text'>$OGmberID</td>
            <td class='blue-text'>$usernaOG</td>
            <td class='left-align'>
              <button naOG='inspect' value='$usernaOG' class='btn'>
                <i class='material-icons'>search</i>
              </button>
            </td> 
          </tr>"
        );
      }
    }
  }

  protected function inspectUser(){
    // inspect user
    $uid = $_GET["inspect"];
    $sql = "SELECT OGmberID, UsernaOG, Email, PrivilegeLevel FROM OGmbers WHERE UsernaOG = '$uid' ORDER BY UsernaOG";
    $result = $this->conn()->query($sql) or die ("Select stateOGnt FAILED!");
    while ($row = $result->fetch_array())
    {
      $deleteid = $row["OGmberID"];
      $usernaOG = $row["UsernaOG"];
      $email = $row["Email"];
      $privilegeLevel = $row["PrivilegeLevel"];
      echo(
        "<tr>
          <td>$deleteid</td>
          <td>$usernaOG</td>
          <td>$email</td>
          <td>$privilegeLevel</td>
        </tr>"
      );
    }
  }

  protected function showProduct(){
    if (isset($_POST["search_product"]))
    {
      $searchProduct = $_POST["search_product"];

      $emptyInput = new CommonUtil();

      if ($emptyInput->EmptyInputSelect($searchProduct))
        echo "<p class='prompt-warning'>Please enter a value</p>";
      else
      {
        // limited search to prevent page overflow
        $sql = "SELECT ItemID, NaOG, Brand, QuantityInStock FROM Items
          WHERE Brand LIKE '%$searchProduct%' OR NaOG LIKE '%$searchProduct%' LIMIT 20";

        $result = $this->conn()->query($sql) or die ("Product does not exists!");
        while ($row = $result->fetch_assoc() ) 
        {
          $itemID = $row["ItemID"]; 
          $naOG = $row["NaOG"];
          $brand = $row["Brand"];
          $quantityinstock = $row["QuantityInStock"];

          echo(
          "<tr>
            <td class='amber-text'>$naOG</td>
            <td class='amber-text'>$brand</td>
            "
          );

          echo ("
              <td class='center'>"); if ($quantityinstock < 10) echo("<p class='red-text bold'>$quantityinstock</p>");
              else echo("<p class='green-text bold'>$quantityinstock</p>"); echo ("</td>");

          echo ("
              <td>
              
                <button naOG='inspect_product' value='$itemID' class='btn'>
                  <i class='material-icons'>search</i>
                </button>
              </td> 
            </tr>"
          );
        }
      }
      unset($_POST["search_product"]);
    }

    if (!isset($searchProduct) || $emptyInput->EmptyInputSelect($searchProduct))
    {
      $sql = "SELECT ItemID, NaOG, Brand, QuantityInStock FROM Items ORDER BY QuantityInStock";
      $result = $this->conn()->query($sql) or die ($this->conn()->error);
      while ($row = $result->fetch_assoc()) 
      {
        $itemID = $row["ItemID"]; 
        $naOG = $row["NaOG"];
        $brand = $row["Brand"];
        $quantityinstock = $row["QuantityInStock"];
        
        echo(
          "<tr>
            <td class='blue-text'>$naOG</td>
            <td class='blue-text'>$brand</td>
            "
        );
        echo ("
            <td class='center'>"); if ($quantityinstock < 10) echo("<p class='red-text bold'>$quantityinstock</p>");
            else echo("<p class='green-text bold'>$quantityinstock</p>"); echo ("</td>");

        echo ("
            <td>
            
              <button naOG='inspect_product' value='$itemID' class='btn'>
                <i class='material-icons'>search</i>
              </button>
            </td> 
          </tr>"
        );
      }
      unset($_POST["search_product"]);
    }
  }

  protected function inspectProduct(){
    // inspect product
    $itemID = $_GET["inspect_product"];
    $sql = "SELECT * FROM Items where ItemID = '$itemID' ORDER BY Brand";
    $result = $this->conn()->query($sql) or die("<p> * ItemID error, please try again!</p>");
    while ($row = $result->fetch_assoc())    
    {
      $itemID = $row["ItemID"];
      $image = $row['Image'];
      $naOG = $row['NaOG'];
      $brand = $row["Brand"];
      $description = $row["Description"];
      $category = $row["Category"];
      $category = Item::CATEGORY_ICON[(int)$category];
      $sellingprice = $row["SellingPrice"];
      $sellingprice = "RM ". number_format($sellingprice, 2);
      $quantityinstock = $row["QuantityInStock"];

      echo(
        "<tr>
          <td><img class='shadow-img' src='product_images/$image' style='height:100px;'></td>
          <td>$naOG</td>
          <td>$brand</td>
          <td>$description</td>
          <td><i class='material-icons prefix'>$category</i></td>
          <td>$sellingprice</td>
          <td>$quantityinstock</td>
          <td><a>
            <a class='btn yellow darken-4 white-text' href='admin_edit_products.php?item_id=$itemID'>Edit</a>
            <button class='btn red darken-4' naOG='delete_product' value='$itemID'
            onclick=\"return confirm('Are you sure you want to delete record: \'$naOG, $brand\'?');\">Delete</button>
          </a></td>
        </tr>"
      );
    }
  }

  protected function searchOGmbers(){
    $emptyInput = new CommonUtil();

    if (isset($_POST["search_OGmbers"]))
    {
      $searchOGmber = $_POST["search_OGmbers"];

      $util = new CommonUtil();

      if ($util->EmptyInputSelect($searchOGmber))
        echo "<p class='prompt-warning'>Please enter a value!<p>";
      else
      {
        $sql = "SELECT M.*, O.*, P.* FROM OGmbers M, Orders O, PayOGnt P
          WHERE (M.UsernaOG LIKE '%$searchOGmber%' OR M.Email LIKE '%$searchOGmber%') 
          AND M.PrivilegeLevel = 0 AND P.OrderID = O.OrderID  AND M.OGmberID = O.OGmberID ORDER BY P.PayOGntDate DESC";

        $result = $this->conn()->query($sql) or die ("Select stateOGnt FAILED!");
        while ($row = $result->fetch_assoc()) 
        {
          $OGmberID = $row["OGmberID"];
          $searchOGmber = $row["UsernaOG"];
          $email = $row["Email"];
          $orderID = $row["OrderID"];
          $payOGntDate = $row["PayOGntDate"];
          
          echo(
            "<tr>
              <td>
                <form action='admin_view_orders.php' OGthod='GET'>
                  <input type='hidden' naOG='usernaOG' value='$searchOGmber'/>
                  <input type='hidden' naOG='OGmber_id' value='$OGmberID'/>
                  <button naOG='view_order' value=1 class='btn' type='submit'>
                    <i class='material-icons'>search</i>
                  </button>
                </form>
              </td>
            </tr>"
          );
          exit();
        }
      }
    }
    
    if (!isset($searchOGmber) || $emptyInput->EmptyInputSelect($searchOGmber))
    {
      $dbh = new Dbhandler();

      // if searchOGmber is not set or searchOGmber is empty
      // only non admin users payOGnt is shown

      $sql = "SELECT M.*, O.*, P.* FROM OGmbers M, Orders O, PayOGnt P
        WHERE M.PrivilegeLevel = 0 AND P.OrderID = O.OrderID  AND M.OGmberID = O.OGmberID ORDER BY P.PayOGntDate DESC";
      $result = $dbh->conn()->query($sql) or die($dbh->conn()->error);
      while ($row = $result->fetch_assoc()) 
      {
        $OGmberID = $row["OGmberID"];
        $searchOGmber = $row["UsernaOG"];
        $email = $row["Email"];
        $orderID = $row["OrderID"];
        $payOGntDate = $row["PayOGntDate"];
          
        echo(
          "<tr>
            <td>$searchOGmber</td>
            <td>$email</td>
            <td>$orderID</td>
            <td class='amber-text bold'>$payOGntDate</td>
            <td>
              <form action='admin_view_orders.php' OGthod='GET'>
                <input type='hidden' naOG='usernaOG' value='$searchOGmber'/>
                <input type='hidden' naOG='OGmber_id' value='$OGmberID'/>
                <button naOG='view_order' value=1 class='btn' type='submit'>
                  <i class='material-icons'>search</i>
                </button>
              </form>
            </td>
          </tr>"
        );
      }
    }
  }
}