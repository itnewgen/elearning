<?php
/**
 * Main.php
 *
 * This is an example of the main page of a website. Here
 * users will be able to login.
 *
 */
include("include/session.php");
$page = "main.php";
?>


</body>
</html>


<?php
/*
----------------------------------------------------------------------------------------------------
Home Page
Author:  ITNEWGEN
Description: Home Page
----------------------------------------------------------------------------------------------------
*/
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>kidsworld - home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
	<script type="text/javascript">
		jQuery(function($){
			<?php
			if(isset($_GET['hash'])){
				$hash = $_GET['hash'];
			} else {
				$hash = '';
			}
			?>
			jp_hash = ('<?php echo $hash; ?>'.length)?'<?php echo $hash; ?>':window.location.hash;
			if(jp_hash){
				$.ajax({
					type: "POST",
					url: 'process.php',
					data: 'login_with_hash=1&hash='+jp_hash,
					success: function(msg){
						if(msg){
							alert(msg);
							window.location.href = "main.php";
						} else {
							alert("Invalid Hash");
						}
					}
				});
			}
		});
	</script>
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }
  </style>
</head>
<body>
<?php include("homenav.php"); ?>

<?php
/**
 * User has already logged in, so display relavent links, including
 * a link to the admin center if the user is an administrator.
 */
if($session->logged_in){
	if(MAIL){
		$q = "SELECT mail_id FROM ".TBL_MAIL." WHERE UserTo = '$session->username' and status = 'unread'";
		$numUnreadMail = $database->query($q) or die(mysql_error());
		$numUnreadMail = mysql_num_rows($numUnreadMail);

		echo "<div class='grid_5'><p class='right'><a href=\"mail.php\"><center>You have $numUnreadMail Unread Mail</center></a>&nbsp;</p></div>";
	}
	?>
<center><?php echo date("l, F d, Y h:i" ,time()); ?> </center>
<br/>
<div class="container">
	<div class="container-fluid">
		<div class="alert alert-success">
  			<strong><h4 class="text-muted"><center>Welcome <b><?php echo $session->username; ?></b>! You are logged in</center></h4></strong>
		</div>
  		<ul class="nav nav-tabs" role="tablist"> 
		    <li class="dropdown">
		    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
		      Admin <span class="caret"></span></a>
		      <ul class="dropdown-menu" role="menu">
		      	<?php
				   if($session->isAdmin()){
		        	echo "
		        		  <li><a href=\"admin/admin.php\">File Maintenance</a></li></ul>
						  <li><a href=\"process.php\">Logout</a></li>";
					include("adminNav.php");
					include("admin/footeradmin.php");
		  		}
		      ?>
		    </li>
		  </ul>
		</div>
<?php
}
else{
?>

<?php
/**
 * User not logged in, display the login form.
 * If user has already tried to login, but errors were
 * found, display the total number of errors.
 * If errors occurred, they will be displayed.
 */
if($form->num_errors > 0){
   echo "<font size=\"2\" color=\"#ff0000\">".$form->num_errors." error(s) found</font>";
}
?>
<div class="container">
	<div class="container-fluid">
	  <h1>e-learning for Kids</h1>
	  <p class="text-primary">Where Learning is PLAY!</p> 
</div>
    
<div class="row">
	<div class="col-md-4">
		<h2 class="text-success">Login</h2><br/>
		<form role="form-group" action="process.php" method="post">
			<div class="form-group">
				<label for="usr">Username:</label>
				<input type="text" class="form-control" name="user" value="<?php echo $form->value("user"); ?>"><?php echo $form->error("user"); ?>
			</div>
			<div class="form-group">
				<label for="pwd">Password:</label>
				<input type="password" class="form-control" name="pass" value="<?php echo $form->value("pass"); ?>"><?php echo $form->error("pass"); ?>
			</div>
			<div class="checkbox">
				<label><input type="checkbox" name="remember" <?php if($form->value("remember") != ""){ echo "checked"; } ?>> Remember me</label>
			</div>
			<tr>
				<input type="hidden" name="sublogin" value="1">
				<th><input type="submit" class="btn btn-success active" name="btnSubmit" value="Log In" /></th>
				<th><input type="button" class="btn btn-warning active" value="Sign Up" onclick="window.open('register.php','popUpWindow','height=550,width=400,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes');"/></a></th>
			</tr>
			<p class="text-muted"><br />[<a href="forgotpass.php">Forgot Password?</a>]</p>
			<p class="lead">Not registered? <a href="register.php">Sign-Up!</a></p>
			<p class="text-success">
			<?php
				if(EMAIL_WELCOME){
					echo "<p>Do you need a Confirmation email? <a href='valid.php'>Send!</a></p>";
				}
			?>
			</p>
		</form>                 
	</div><!-- #login -->
</div>
<?php 
	include("footer.php");
?>
<?php
/**
*    <div class="col-md-4">
*      <h2 class="text-success">Sign Up</h2><br/>
*      <?php include("register.php"); ?>  
*    </div>
*    <div class="col-md-4">
*      <h2 class="text-warning">Forgot Password  </h2><br/>
*      <?php include("forgotpass.php"); ?>      
*    </div>
*/ ?>
<?php
}

/**
 * Just a little page footer, tells how many registered members
 * there are, how many users currently logged in and viewing site,
 * and how many guests viewing site. Active users are displayed,
 * with link to their user information.
 */
?>

</div><!-- #main -->
</body>
</html>