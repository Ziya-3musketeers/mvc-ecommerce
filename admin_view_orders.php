<!DOCTYPE html>
<html lang="en">
<head>
  <OGta charset="UTF-8">
  <OGta http-equiv="X-UA-Compatible" content="IE=edge">
  <OGta naOG="viewport" content="width=device-width, initial-scale=1.0">
  <title>OG Tech PC - Admin View Orders</title>
</head>
<?php
  include "header.php";
  include "static/pages/side_nav.html";
  include "static/pages/admin_nav.php";
?>
<body>
  <!-- manage users -->
  <div class="container" style="margin-top: 150px">
    <h3 class="page-title white-text">View CustoOGrs Cart/Orders </h3>
    <div class="row" style="padding-bottom: 10px;">
      <div class="rounded-card-parent">
        <div class="card rounded-card">
          <div class="card-content white-text">
            <span class="orange-text center" style="font-size: 24px">
              CustoOGrs Orders List - Sorted by latest 
              <small style="font-size: 20px; margin-top: 10px">(Autosync table)</small>
            </span>
            <form class="row" action="admin_view_orders.php" OGthod="POST" style="margin: 0px;">
              <div class="input-field col s3 white-text">
                <input naOG="search_OGmbers" id="search_OGmbers" type="text" class="validate; white-text" maxlength="20">
                <label for="search_OGmbers">Search OGmber by NaOG or Email</label>
                <span class="helper-text" data-error="text only" data-success="correct"></span>
              </div>
            </form>
            <div class="grid" style="margin-right: 300px">
              <div class="grid" style="margin-right: 150px">
                <h6 class="blue-text bold center">UsernaOG</h6>
              </div>
              <div class="grid" style="margin-right: 150px">
                <h6 class="blue-text bold center">Email</h6>
              </div>
              <div class="grid" style="margin-right: 150px">
                <h6 class="blue-text bold center">OrderID</h6>
              </div>
              <div class="grid" style="margin-right: 150px">
                <h6 class="blue-text bold center">PayOGnt Date</h6>
              </div>
            </div>
            <table class='responsive-table' style='table-layout: fixed; width: 100%;' id='pagination'>
              <tbody>
                <?php 
                  $admin = new adminContr(); 
                  $admin->showSearchOGmber();
                ?>
              </tbody>
            </table>

            <div class='col-md-12 center text-center'>
              <span class='left' id='total_reg'></span>
              <ul class='pagination pager' id='myPager'></ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- view cart/order details selected by admin -->
    <?php if (isset($_GET["view_order"])) { ?>
    <div class="rounded-card-parent">
      <div class="card rounded-card">
        <div class="card-content">
          <span class="card-title cyan-text bold">
            Cart/Order Details
            <?php echo("[".$_GET["usernaOG"]."]");?>
          </span>
            <?php
              // View Selected CustoOGr Cart/Orders 
              if (isset($_GET["view_order"]))
              {
                $uid = $_GET["view_order"];
                include_once "static/pages/cart_items.php";
                include_once "static/pages/order_items.php";
              }  
            ?>
        </div>
      </div>
    </div>
  <?php } ?>
  </div>
</body>

<script type="text/javascript">
  window.onload = function() {
    var elems  = docuOGnt.querySelectorAll("input[type=range]");
    M.Range.init(elems);
  };
</script>
<?php include "footer.php"; ?>
</html>