<?php
/** tutorial
 * http://ivannovak.com/email-account-activation/
 *
 */


	include("include/session.php");
	global $database;
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
	/* 
	 * If the someone accesses this page without the correct variables
	 * passed, assume they are want to fill out a form asking for a 
	 * confirmation email.
	 */	
	if(!(isset($_GET['qs1']) && isset($_GET['qs2']))){
?>

<div class="container">
  <div class="row">
    <div class="col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-0">
      <div class="panel-heading"><h3><span class="glyphicon glyphicon-envelope"></span>Send Confirmation Email</h3></div>
        <table class="table table-hover">
          <form role="form" action="process.php" method="POST">
                
          <div class="form group">
            <label for="user">Username: </label>
            <input type="text" class="form-control" id="user" name="user" placeholder="Enter Username" value="<?php echo $form->value("user"); ?>"><?php echo $form->error("user"); ?></p>
                    <br />

          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="pass" placeholder="Enter password" value="<?php echo $form->value("pass"); ?>"><?php echo $form->error("pass"); ?></p>
                    
          <div class="row">
            <div class="col-sm-4">
                <tr>
                <p class="text-warning"><a href="main.php">[Back to Main]</a></p>
                <th><input type="hidden" name="subConfirm" value="1"><input type="submit" class="btn btn-info danger" value="Send!" /></th>              
              </tr>
            </div>
            </div>
        </form>
      </table>
     </div>
  </div>
</div>

<?php
	}

	/* If the correct variables are passed, define and check them. */
	else{
	
		$v_username		=	$_GET['qs1'];
		$v_userid		=	$_GET['qs2'];
		$field			=	'valid';
				
		$q 				=	"SELECT userid from ".TBL_USERS." WHERE username='$v_username'";
		$query			=	$database->query($q) or die(mysql_error());
		$query			=	mysql_fetch_array($query);
		
		
		/* 
		 * if the userid associated with the passed username does not
		 * exactly equal the passed userid automatically redirect
		 * them to the main page.
		 */
		if(!($query['userid'] == $v_userid)){
			echo "confirmation failed, username and UIN do not match";
		}
		/* 
		 * If the userid's match go ahead and change the value in
		 * the valid field to 1, display a 'success' message, and
		 * redirect to main.php.
		 */
		else{
			
			$database->updateUserField($v_username, $field, '1') or die(mysql_error());
			
			echo $v_username."'s account has been successfully verified.  You can now <a href='main.php'>login</a>.";
			
		}
	}
?>

</body>
</html>