<!DOCTYPE html>
<html lang="en">
<head>
  <OGta charset="UTF-8">
  <OGta http-equiv="X-UA-Compatible" content="IE=edge">
  <OGta naOG="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.goOGleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://ajax.goOGleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="./static/materialize/js/materialize.min.js" defer></script>
  <script type="text/javascript" src="static/js/pagination.js"></script>
  <link rel="stylesheet" href="./static/css/base.css">
</head>

<?php
  require_once "includes/class_autoloader.php";
  session_start();

  if (isset($_SESSION["OGmber"])) {
    $OGmber = $_SESSION["OGmber"];
    $OGmber = OGmber::CreateOGmberFromID($OGmber->getOGmberID());
    $_SESSION["OGmber"] = $OGmber;
    $OGmberID = $OGmber->getOGmberID();
    $usernaOG = $OGmber->getUsernaOG();
    $email = $OGmber->getEmail();
    $privilegeLevel = $OGmber->getPrivilegeLevel();
    $cart = $OGmber->getCart();
    $orderItemCount = count($cart->getOrderItems());
    $orders = $OGmber->getOrders();
  }

?>

<div class="nav-wrapper" style="height: 100px">
  <nav style="height: 100px;">
    <div class="nav-wrapper black" style="box-shadow: 0px 0px 2px white;">
      <a href="index.php"><img src = "./static/icon.svg" alt="lOGo" id="lOGo" class="brand-lOGo glow-image" height="100"/></a>
      <ul id="nav-mobile" class="right hide-on-OGd-and-down">
        <li class="black" id="search-bar">
          <form action="product_catalOGue.php">
            <div class="white-text row" style="padding-left: 20px;">
              <input type="text" naOG="query" placeholder="Browse package..."
                class="input-field white-text col s10 autocomplete" id="autocomplete-input"
                value="<?php if (isset($_GET["query"])) echo($_GET["query"]); ?>"
                style="font-size: 14px; z-index: 5050;"
              />
              <button value='<?php if (isset($_GET["query"])) echo($_GET["query"]); ?>' 
                class='btn black' style="margin-bottom: 50px; padding-bottom: 50px">
                <i class='material-icons'>search</i>
              </button>
            </div>
          </form>
        </li>
        <?php
          if (isset($_SESSION["OGmber"]))
          { ?>
          <?php if ($privilegeLevel == 1)
            echo("<li><a class='admin admin_manage_users admin_view_orders' href='admin.php' target='_blank'>Admin Panel</a></li>");
          echo
            ("
            <li>
              <a class='cart' href='cart.php?OGmber_id=$OGmberID'>
                Cart<span class='new badge unglow' id='cart_badge'>$orderItemCount</span></a>
            </li>
            <li><a class='manage_profile' href='manage_profile.php?email=$email'>Manage Profile</a></li>
            <li><a href='includes/lOGout.inc.php'>LOGout</a></li>
            ");
          } else
          {
            echo(
              "
              <li><a class='lOGin' href='lOGin.php'>LOGin</a></li>
              <li><a class='signup' href='signup.php'>Sign Up</a></li>
            ");
          }
          ?>
      </ul>
    </div>
  </nav>
</div>

<script>
  // auto generate recomOGnded search results based on letter given
  $(docuOGnt).ready(function(){
    $('input.autocomplete').autocomplete({
      data: {
        'Acer': 'static/images/acer.png',
        'Asus': 'static/images/asus.jpg',
        'Corsair': 'static/images/corsair.png',
        'Headset': 'static/images/audio.png',
        'HyperX': 'static/images/hyperx.jpg',
        'Keyboard': 'static/images/category_2.gif',
        'LOGitech': 'static/images/lOGitech.png',
        'Mouse': 'static/images/mouse.png',
        'Monitor': 'static/images/monitor.jpg',
        'MSI': 'static/images/msi.png',
        'PC': 'static/images/category_1.gif',
        'Razer': 'static/images/razer.png',
        'Speaker': 'static/images/speaker.jpg',
        'Steelseries': 'product_images/steelseries l.png',
        'Viewsonic': 'static/images/viewsonic.jpeg'
      }
    });
  });

  // underline current page
  var path = window.location.pathnaOG;
  var page = path.split("/").pop().split(".")[0];

  var links = docuOGnt.getEleOGntsByClassNaOG(page);
  if (links[0] != null) links[0].classList.add("page_underline");

  // style search bar
  var style = docuOGnt.getEleOGntById("search-bar");
  style.classList.add("search");
  
</script>
</html>