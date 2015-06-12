<?php
/**
 * UserEdit.php
 *
 * This page is for users to edit their account information
 * such as their password, email address, etc. Their
 * usernames can not be edited. When changing their
 * password, they must first confirm their current password.
 *
 */
include("include/session.php");
$page = "useredit.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>kidsworld - Edit User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="main.php">Kidsworld</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="main.php">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"> My Account<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Add Account</a></li>
            <li><a href="useredit.php">Edit Account</a></li>
            <li><a href="#">Delete Account</a></li>
          </ul>
        </li>
        <li><a href="admin/admin.php">Admin</a></li>
        <li><a href="#"></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron">
    
  <h1>Watch and Learn</h1>      
  <p>Real adventure for little geniuses</p>
  <button type="button" class="btn btn-info btn-lg" data-toggle="collapse" data-target="#demo">Search</button>

  <div class="row">
    <div class="col-sm-7">
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-0">
<?php
/**
 * User has submitted form without errors and user's
 * account has been edited successfully.
 */
if(isset($_SESSION['useredit'])){
   unset($_SESSION['useredit']);
   
   echo "<center><h1>User Account Edit Success!</h1></center>";
   echo "<p><center><b>$session->username</b>, your account has been successfully updated. "
       ."<a href=\"main.php\">Main</a></center>.</p>";
}
else{
?>

<?php
/**
 * If user is not logged in, then do not display anything.
 * If user is logged in, then display the form to edit
 * account information, with the current email address
 * already in the field.
 */
if($session->logged_in){
?>

<?php
if($form->num_errors > 0){
   echo "<td><font size=\"2\" color=\"#ff0000\">".$form->num_errors." error(s) found</font></td>";
}
?>
<div class="panel-heading"><h3 class="text-info"><span class="glyphicon glyphicon-pencil"></span>Edit User Account: </h3><h1 class="text-muted"><?php echo $session->username; ?></h1></div>
        <table class="table table-hover">
          <form role="form" action="process.php" method="POST">
			<div class="form group">
	            <label for="user">Name: </label>
	            <input type="text" class="form-control" name="name" placeholder="Enter Name" value="<?php
					if($form->value("name") == ""){
						echo $session->userinfo['name'];
					}else{
						echo $form->value("name");
					}
					?>">
	        </div>
	        <br />
			<?php echo $form->error("name"); ?>
			</p>
			<div class="clear"></div>
			<div class="form group">
	            <label for="current_pass">Current Password: </label>
	            <input type="password" class="form-control" name="curpass" placeholder="Enter Current Password" value="<?php echo $form->value("curpass"); ?>">
	        	<?php echo $form->error("curpass"); ?>
	        </div>
	        <br/>
			<div class="clear"></div>
			<div class="form group">
	            <label for="new_pass">New Password: </label>
	            <input type="password" class="form-control" name="newpass" placeholder="Enter New Password" value="<?php echo $form->value("newpass"); ?>">
	        	<?php echo $form->error("newpass"); ?>
	        </div>
	        <br/>
			<div class="clear"></div>
			<div class="form group">
	            <label for="current_pass">Email: </label>
	            <input type="text" class="form-control" name="email" placeholder="Enter Your Email" value="<?php
			if($form->value("email") == ""){
				echo $session->userinfo['email'];
			}else{
				echo $form->value("email");
			}
			?>">
	        <?php echo $form->error("email"); ?>
	        </div>
	        <br/>
			<div class="clear"></div>
			<div class="row">
            <div class="col-sm-4">
                <tr>
				<input type="hidden" name="subedit" value="1">
				<th><input type="submit" class="btn btn-success active" value="Edit Account" /></th>
				<th><input type="reset" class="btn btn-warning active" value="Clear"></th>
				<th><a </th>
			</tr>
            </div>
            </div>
		</form>
	</div>
<?php
echo "[<a href=\"main.php\">Main</a>] ";
echo "[<a href=\"userinfo.php?user=$session->username\">My Account</a>]&nbsp;";

}
}

?>
</div>
</body>
</html>
