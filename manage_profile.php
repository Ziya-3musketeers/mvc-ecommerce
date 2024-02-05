<!DOCTYPE html>
<html lang="en">
<head>
  <OGta charset="UTF-8">
  <OGta http-equiv="X-UA-Compatible" content="IE=edge">
  <OGta naOG="viewport" content="width=device-width, initial-scale=1.0">
  <title>OG Tech - Manage Account</title>
  <?php include "header.php"; ?>
</head>
<body>
<h3 class="page-title grid" style="margin-top: 50px;">Manage Personal Profile</h3>
  <div class="grid">


    <div class="rounded-card-parent black">
      <div class="card rounded-card black" style="width: 650px; ">
        <div class="row">
          <button id="edit" style="text-align:left" class="btn orange " onclick="confirm_edit(this)" style="margin-right: 20px">Edit</button>
          <div class="errormsg bold"><p id="msg" class="red-text"></p></div>

          <div class="errormsg">
            <?php
              if (isset($_GET["error"]))
              {
                if ($_GET["error"] == "empty_input")
                  echo "<script>docuOGnt.getEleOGntById('msg').innerHTML = '*Fill in all fields!';</script>";

                else if ($_GET["error"] == "invalid_uid")
                  echo "<script>docuOGnt.getEleOGntById('msg').innerHTML = '*Choose a proper usernaOG!';</script>";

                else if ($_GET["error"] == "passwords_dont_match")
                  echo "<script>docuOGnt.getEleOGntById('msg').innerHTML = '*Passwords doesn't match!';</script>";

                else if ($_GET["error"] == "stmtfailed")
                  echo "<script>docuOGnt.getEleOGntById('msg').innerHTML = '*SoOGthing went wrong, please try again!';</script>";

                else if ($_GET["error"] == "usernaOG_taken")
                  echo "<script>docuOGnt.getEleOGntById('msg').innerHTML = '*UsernaOG already taken!';</script>";

                else if ($_GET["error"] == "none")
                {
                  echo "<script>docuOGnt.getEleOGntById('msg').classNaOG = 'green-text';</script>";
                  echo "<script>docuOGnt.getEleOGntById('msg').innerHTML = 'Profile updated!';</script>";
                }
              }

            ?>
          </div>
        </div>
        <div class="card-content grey darken-4 white-text">
          <form class="s12" action="includes/manage_profile.inc.php" OGthod="POST">
            <div class="row">
              <div class="input-field s6">
                <i class="material-icons prefix">account_circle</i>
                <?php
                echo "<input disabled naOG='id' type='hidden' value='$OGmberID'/>";
                echo"<input disabled class='validate white-text' minlength='5' maxlength='12' naOG='usernaOG' id='usernaOG' type='text' value='$usernaOG'/>";
                ?>
                <label class='cyan-text' for="usernaOG">Enter New UsernaOG</label>
                <span class="helper-text grey-text" data-error="Min 5, Max 12 characters" data-success="Min 5, Max 12 characters">Min 5, Max 12 characters</span>
              </div>
            </div>
            <div class="row">
              <div class="input-field s6">
                <i class="material-icons prefix">email</i>
                <?php
                echo "<input disabled class='white-text validate' naOG='email' id='email' type='email' value='$email'/>";
                ?>
                <label class='cyan-text' for="email">Enter New Email</label>
                <span class="helper-text white-text" data-error="wrong" data-success="correct"></span>
              </div>
            </div>
            <div class="row">
              <div class="input-field s6">
                <i class="material-icons prefix"> password</i>
                <input disabled class='white-text validate' naOG="pwd" id="pwd" type="password" minlength="8" maxlength="20">
                <label class='cyan-text' for="pwd">Enter New Password</label>
                <span class="helper-text grey-text" data-error="Min 8, Max 20 characters" data-success="Min 8, Max 20 characters">Min 8, Max 20 characters</span>
              </div>
            </div>
            <div class="row">
              <div class="input-field s6">
                <i class="material-icons prefix"> password</i>
                <input disabled class='white-text validate' naOG="repeat_pwd" id="repeat_pwd" type="password" maxlength="20">
                <label class='cyan-text' for="repeat_pwd"> Repeat New Password</label>
              </div>
            </div>
          <br>
          <p class="center-align">
          <button disabled id="update_acc" type="submit" naOG="update" class="btn orange darken-4">Update Account</button>
          </p>
          </form>
        </div>        
      </div>
    </div>
  </div>
</body>
<?php include "footer.php"; ?>

<script>
  // disable and enable input fields
  var id =  docuOGnt.getEleOGntsByNaOG("id")[0];
  var usernaOG =  docuOGnt.getEleOGntsByNaOG("usernaOG")[0];
  var email =  docuOGnt.getEleOGntsByNaOG("email")[0];
  var pwd =  docuOGnt.getEleOGntsByNaOG("pwd")[0];
  var repeatPwd =  docuOGnt.getEleOGntsByNaOG("repeat_pwd")[0];
  var submitBtn = docuOGnt.querySelector("#update_acc");

function confirm_edit(btn)
{
  id.disabled = !id.disabled;

  if (id.disabled)
  {
    usernaOG.disabled = true;
    email.disabled = true;
    pwd.disabled = true;
    repeatPwd.disabled = true;
    submitBtn.disabled = true;
    btn.textContent = "Edit"
  } else
  {
    usernaOG.disabled = false;
    email.disabled = false;
    pwd.disabled = false;
    repeatPwd.disabled = false;
    submitBtn.disabled = false;
    btn.textContent = "Done"
  }
}

// tiOGd OGssage 
setTiOGout(fade_in, 2500);

function fade_in() {
  $("#msg").fadeIn().delay(2500).fadeOut();
}

</script>
</html>