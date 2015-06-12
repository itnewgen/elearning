<?php
/**
 * ForgotPass.php
 *
 * This page is for those users who have forgotten their
 * password and want to have a new password generated for
 * them and sent to the email address attached to their
 * account in the database. The new password is not
 * displayed on the website for security purposes.
 *
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

<?php
/**
 * Forgot Password form has been submitted and no errors
 * were found with the form (the username is in the database)
 */
if(isset($_SESSION['forgotpass'])){
   /**
    * New password was generated for user and sent to user's
    * email address.
    */
   if($_SESSION['forgotpass']){
      echo "<h1>New Password Generated</h1>";
      echo "<p>Your new password has been generated "
          ."and sent to the email <br>associated with your account. "
          ."<a href=\"main.php\">Main</a>.</p>";
   }
   /**
    * Email could not be sent, therefore password was not
    * edited in the database.
    */
   else{
      echo "<h1>New Password Failure</h1>";
      echo "<p>There was an error sending you the "
          ."email with the new password,<br> so your password has not been changed."
          ."<a href=\"main.php\">Main</a>.</p>";
   }
       
   unset($_SESSION['forgotpass']);
}
else{

/**
 * Forgot password form is displayed, if error found
 * it is displayed.
 */
?>

<div class="container">
  <div class="row">
    <div class="col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-0">
  <div class="panel-heading"><h1></span> Forgot Password</h1></div>
      
<p class="text-warning">A new password will be generated for you and sent to the email address<br>
          associated with your account, all you have to do is enter your
          username.
</p>
<?php echo $form->error("user"); ?>

<div class="container">
  <form role="form-group" action="process.php" method="post">
          <div class="form-group">
              <label for="usr">Username:</label>
              <input type="text" class="form-control" name="user" value="<?php echo $form->value("user"); ?>">
            </div>

          <tr>
            <th><input type="hidden" class="btn btn-success active" name="subforgot" value="1" /></th>
            <th><input type="submit" class="btn btn-warning active" value="Get New Password">
            <th><a href="main.php"><input type="button" class="btn btn-success active" value="Back"></a></th>
        </form>                 
</div>
<br/>
<br/>
<p><a href="main.php">[Back to Main]</a></p>

<?php
}
?>
</div>
</body>
</html>
