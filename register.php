<?php
/**
 * Register.php
 * 
 * Displays the registration form if the user needs to sign-up,
 * or lets the user know, if he's already logged in, that he
 * can't register another name.
 */
include("include/session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>kidsworld - signup</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-0">
      <div class="panel-heading"><h3><span class="glyphicon glyphicon-user"></span>Register</h3></div>
        <table class="table table-hover">
          <form role="form" action="process.php" method="post">
                
          <div class="form group">
            <label for="user">Username: </label>
            <input type="text" class="form-control" id="user" name="user" placeholder="Enter Username" value="<?php echo $form->value("user"); ?>"<?php echo $form->error("user"); ?>>
          </div>
                    <br />
            <div class="form group">
            <label for="firstName">First Name: </label>
            <input type="" class="form-control" id="firstName" name="name" placeholder="Enter first name" value="<?php echo $form->value("name"); ?>"<?php echo $form->error("name"); ?>>
          </div>
                    <br />
          <div class="form group">
            <label for="email">Email: </label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo $form->value("email"); ?>"<?php echo $form->error("email"); ?>>
          </div>
                    <br />
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="pass" placeholder="Enter password" value="<?php echo $form->value("pass"); ?>"<?php echo $form->error("pass"); ?></p>
          </div>
                    
          <span class="help-block">Sign  Up for free.</span>
          <div class="row">
            <div class="col-sm-4">
                <tr>
                <th><input type="submit" class="btn btn-info danger" name="subjoin" value="Join" /></th>
                <th><a href="main.php"><input type="button" class="btn btn-warning active" value="Back"></a></th>
                <p class="text-warning"><a href="main.php">[Back to Main]</a></p>
              </tr>
            </div>
            </div>
        </form>
      </table>
     </div>
  </div>
</div>

</body>
</html>

<?php
/**
 * The user is already logged in, not allowed to register.
 */

if($session->logged_in){
   echo "<h1>Registered</h1>";
   echo "<p>We're sorry <b>$session->username</b>, but you've already registered. "
       ."<a href=\"main.php\">Main</a>.</p>";
}
/**
 * The user has submitted the registration form and the
 * results have been processed.
 */
else if(isset($_SESSION['regsuccess'])){
   /* Registration was successful */
   if($_SESSION['regsuccess']){
      echo "<h1>Registered!</h1>";
      if(EMAIL_WELCOME){
         echo "<p>Thankyou <b>".$_SESSION['reguname']."</b>, you have been sent a confirmation email which should be arriving shortly.  Please confirm your registration before you continue.<br />Back to <a href='main.php'>Main</a></p>";
      }else{
      echo "<p>Thank you <b>".$_SESSION['reguname']."</b>, your information has been added to the database, "
          ."you may now <a href=\"main.php\">log in</a>.</p>";
      }
   }
   /* Registration failed */
   else{
      echo "<h1>Registration Failed</h1>";
      echo "<p>We're sorry, but an error has occurred and your registration for the username <b>".$_SESSION['reguname']."</b>, "
          ."could not be completed.<br>Please try again at a later time.</p>";
   }
   unset($_SESSION['regsuccess']);
   unset($_SESSION['reguname']);
}
/**
 * The user has not filled out the registration form yet.
 * Below is the page with the sign-up form, the names
 * of the input fields are important and should not
 * be changed.
 */
else{
?>

<?php
if($form->num_errors > 0){
   echo "<td><font size=\"2\" color=\"#ff0000\">".$form->num_errors." error(s) found</font></td>";
}
?>
<?php
}
?>


