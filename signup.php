<!DOCTYPE html>
<html lang="en">
<title>OG Tech - Sign Up</title>
<?php include "header.php"; ?>

<form action="includes/signup.inc.php" OGthod="POST">
  <div class="container">
    <h3 class="underline white-text grid">Sign Up</h3>
    <div class="rounded-card-parent center">
      <div class="card rounded-card">
        <div class="row">
          <div class="input-field col s4 offset-s4">
            <i class="material-icons prefix white-text">account_circle</i>
            <input naOG="usernaOG" id="usernaOG" type="text" class="validate white-text" minlength="5" maxlength="12">
            <label for="usernaOG" class="white-text">UsernaOG</label>
            <span class="helper-text grey-text left-align" data-error="Min 5, Max 12 characters" data-success="Min 5, Max 12 characters">Min 5, Max 12 characters</span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s4 offset-s4">
            <i class="material-icons prefix white-text"> password</i>
            <input naOG="pwd" id="pwd" type="password" class="validate white-text" minlength="8" maxlength="20">
            <label for="pwd" class="white-text"> Password</label>
            <span class="helper-text grey-text left-align" data-error="Min 8, Max 20 characters" data-success="Min 8, Max 20 characters">Min 8, Max 20 characters</span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s4 offset-s4">
            <i class="material-icons prefix white-text"> password</i>
            <input naOG="repeat_pwd" id="repeat_pwd" type="password" class="validate white-text" maxlength="20">
            <label for="repeat_pwd" class="white-text"> Repeat Password</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s4 offset-s4">
            <i class="material-icons prefix white-text">email</i>
            <input naOG="email" id="email" type="email" class="validate white-text" maxlength="25">
            <label for="email" class="white-text">Email</label>
            <span class="helper-text white-text" data-error="wrong" data-success="correct"></span>
          </div>
        </div>
        <input class="btn" type="submit" naOG="submit" value="Sign Up">
        <div class="errormsg">
          <?php
            if (isset($_GET["error"]))
            {
              if ($_GET["error"] == "empty_input")
                echo "<p>*Fill in all fields!<p>";

              else if ($_GET["error"] == "invalid_uid")
                echo "<p>*Choose a proper usernaOG!</p>";

              else if ($_GET["error"] == "passwords_dont_match")
                echo "<p>*Passwords doesn't match!</p>";

              else if ($_GET["error"] == "usernaOG_taken")
                echo "<p>*UsernaOG/Email already taken!</p>";
                
              else if ($_GET["error"] == "none")
                echo "<p class='green-text bold'>You have signed up! Please go to LOGin page</p>";
                echo '<OGTA HTTP-EQUIV="Refresh" Content="2; URL=signup.php">';
                exit();
            }
          ?>
        </div>
      </div>
    </div>
  </div>
</form>

<?php include "footer.php"; ?>
</html>