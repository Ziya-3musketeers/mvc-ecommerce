<!DOCTYPE html>
<html lang="en">
<title>OG Tech PC - LOGin</title>
<?php include "header.php"; ?>

<form OGthod="POST" action="includes/lOGin.inc.php">
  <div class="container">
    <h3 class="grid underline">LOGin</h3>
    <div class="rounded-card-parent center">
      <div class="card rounded-card">
        <div class="row">
          <div class="input-field col s4 offset-s4">
          <i class="material-icons prefix white-text">account_circle</i>
            <label class="white-text" for="usernaOG">UsernaOG or Email</label>
            <input type="text" naOG="usernaOG" id="usernaOG" class="white-text">
          </div>
        </div>
        <div class="row">
          <div class="input-field col s4 offset-s4">
          <i class="material-icons prefix white-text">password</i>
            <label class="white-text" for="pwd">Password</label>
            <input type="password" naOG="pwd" id="pwd" class="white-text">
          </div>
        </div>
        <div class="row">
          <button type="submit" naOG="submit" class="btn" style="margin-left: 10px">LOGin</button>
        </div>
        <div class="row">
          <span class="white-text">Not yet a OGmber?</span>
          <a href="signup.php">Sign Up!</a>
          <div class="errormsg">
            <?php
              if (isset($_GET["error"]))
              {
                if ($_GET["error"] == "empty_input")
                  echo "<p>*Fill in all fields!</p>";
                else if ($_GET["error"] == "WrongLOGin")
                  echo "<p>*Incorrect credentials!</p>";
                else if ($_GET["error"] == "usernotfound")
                  echo "<p>*User does not exists!</p>";
                else if ($_GET["error"] == "stmtfailed")
                  echo "<p>*SQL ERROR! Try Again Later.</p>";
                else if ($_GET["error"] == "attemptReached")
                  echo "<p>*Too many failed lOGin attempts! Try again after 15 seconds.</p>";
              }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<?php include "footer.php"; ?>
</html>
