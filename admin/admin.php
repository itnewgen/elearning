<?php 
/**
 * Admin.php
 *
 * This is the Admin Center page. Only administrators
 * are allowed to view this page. This page displays the
 * database table of users and banned users. Admins can
 * choose to delete specific users, delete inactive users,
 * ban users, update user levels, etc.
 *
 */
include("../include/session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>kidsworld - Admin Center</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php include("adminnav.php");?>
<div class="container">
  <!-- Trigger the modal with a button -->
<br/><br/>
  <button type="button" class="btn btn-default btn-lg" id="myBtn">Admin Center</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Admin</h4>
        </div>
        <div class="modal-body">
          <h2 class="text-primary">Logged in as <b><?php echo $session->username; ?></h2><br><br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
});
</script>
<?php
/**
 * Display Users Table
 */
?>
<br/><br/>
<div class="panel panel-success">
	<div class="panel-heading">Users Table Contents: </div>
		<div class="panel-body">
	      	<?php displayUsers(); ?>
     	</div>
    </div>
<hr>
<?php
/**
 * Add User
 */
?>
<div class="panel panel-info">
	<div class="panel-heading">Add User </div>
		<div class="panel-body">
			<?php echo $form->error("adduser"); ?>
			<form role="form-group" action="adminprocess.php" method="post">
				<div class="form-group">
					<label for="usr">Username:</label>
					<input type="text" class="form-control" name="adduser" value="<?php echo $form->value("subadduser"); ?>"></p>

				</div>
				<div class="form-group">
					<label for="usr">Password</label>
					<input type="text" class="form-control" name="adduser" value="<?php echo $form->value("subadduser"); ?>"></p>
				</div>
				<div class="form-group">
					<label for="usr">Email</label>
					<input type="text" class="form-control" name="adduser" value="<?php echo $form->value("subadduser"); ?>"></p>
				</div>
				<tr>
					<input type="hidden" name="subadduser" value="1">
					<th><input type="submit" class="btn btn-default active" value="Add User" /></th>
				</tr>
			</form>
	</div> <!-- #update -->
</div>

<?php
/**
 * Update User Level
 */
?>
<div class="panel panel-info">
	<div class="panel-heading">Update User Level </div>
		<div class="panel-body">
			<?php echo $form->error("upduser"); ?>
			<form role="form-group" action="adminprocess.php" method="post">
				<div class="form-group">
					<label for="usr">Username:</label>
					<input type="text" class="form-control" name="upduser" value="<?php echo $form->value("upduser"); ?>"></p>
				</div>
				<div class="form-group">
					<label for="lvl">Level:</label>
					<select name="updlevel">
						<option value="1">1</option>
						<option value="5">5</option>
						<option value="9">9</option>
					</select>
				</div>
				<tr>
					<input type="hidden" name="subupdlevel" value="1">
					<th><input type="submit" class="btn btn-default active" value="Update Level" /></th>
				</tr>
			</form>
	</div> <!-- #update -->
</div>
<hr>

<?php
/**
 * Delete User
 */
?>
<div class="panel panel-warning">
	<div class="panel-heading">Delete User </div>
		<div class="panel-body">
			<?php echo $form->error("deluser"); ?>
			<form action="adminprocess.php" method="POST">
				<div class="form-group">
					<label for="usr">Username:</label>
					<input type="text" class="form-control" name="deluser" value="<?php echo $form->value("deluser"); ?>"></p>
				</div>
				<div class="form-group">
					<tr>
						<input type="hidden" name="subdeluser" value="1">
						<th><input type="submit" class="btn btn-default active" value="Delete User" /></th>
					</tr>
				</div>
			</form>
		</div>
	</div>
<hr>
<?php
/**
 * Delete Inactive Users
 */
?>
<div class="panel panel-success">
	<div class="panel-heading">Delete Inactive User </div>
		<div class="panel-body">
			<form action="adminprocess.php" method="POST">
				<div class="form-group">
						This will delete all users (not administrators), who have not logged in to the site
					within a certain time period. You specify the days spent inactive.
					<p class="grid_2">Days: 	
						<select name="inactdays">
							<option value="3">3</option>
							<option value="7">7</option>
							<option value="14">14</option>
							<option value="30">30</option>
							<option value="100">100</option>
							<option value="365">365</option>
						</select>
					</p>			
				</div>
				<div class="form-group">
					<tr>
						<input type="hidden" name="subdelinact" value="1">
						<th><input type="submit" class="btn btn-default active" value="Delete All Inactive User" /></th>
					</tr>
				</div>
			</form>
		</div>
	</div>
<hr>
<?php
/**
 * Ban User
 */
?>
<div class="panel panel-info">
	<div class="panel-heading">Ban User </div>
		<div class="panel-body">
			<?php echo $form->error("banuser"); ?>
			<form action="adminprocess.php" method="POST">
				<div class="form-group">
					<label for="usr">Username:</label>
					<input type="text" class="form-control" name="banuser" value="<?php echo $form->value("banuser"); ?>"></p>
				</div>
				<div class="form-group">
					<tr>
						<input type="hidden" name="subbanuser" value="1">
						<th><input type="submit" class="btn btn-default active" value="Ban User" /></th>
					</tr>
				</div>
			</form>
		</div>
	</div>
<hr>
<?php
/**
 * Display Banned Users Table
 */
?>
<div class="panel panel-warning">
	<div class="panel-heading">Banned Users Table Contents: </div>
		<div class="panel-body">
			<div class="form-group">
				<?php displayBannedUsers(); ?>
			</div>
		<div class="form-group">				
	</div>
</div>
<hr>
<?php
/**
 * Delete Banned User
 */
?>
<div class="panel panel-success">
	<div class="panel-heading">Delete Banned Users: </div>
		<div class="panel-body">
			<?php echo $form->error("delbanuser"); ?>
			<form action="adminprocess.php" method="POST">
				<div class="form-group">
					<label for="usr">Username:</label>
					<input type="text" class="form-control" name="delbanuser" value="<?php echo $form->value("delbanuser"); ?>"></p>
				</div>
				<div class="form-group">
					<tr>
						<input type="hidden" name="subdelbanned" value="1">
						<th><input type="submit" class="btn btn-default active" value="Delete Banned User" /></th>
					</tr>
				</div>
			</form>				
		</div>
	</div>
</div>
<?php
	if($form->num_errors > 0){
		echo "<font size=\"4\" color=\"#ff0000\">"."!*** Error with request, please fix</font><br><br>"; }
?>
<?php
/**
 * displayUsers - Displays the users database table in
 * a nicely formatted html table.
 */
function displayUsers(){
   global $database;
   $q = "SELECT username,userlevel,email,timestamp "
       ."FROM ".TBL_USERS." ORDER BY userlevel DESC,username";
   $result = $database->query($q);
   /* Error occurred, return given name by default */
   $num_rows = mysql_numrows($result);
   if(!$result || ($num_rows < 0)){
      echo "Error displaying info";
      return;
   }
   if($num_rows == 0){
      echo "Database table empty";
      return;
   }
   /* Display table contents */
   echo "<table id='display'>";
   echo "<tr class='title'><td colspan='2'>Username</td><td>Level</td><td colspan='2'>Email</td><td colspan='2'>Last Active</td></tr>";
   echo "<div class='clear'></div>";
   for($i=0; $i<$num_rows; $i++){
      $uname  = mysql_result($result,$i,"username");
      $ulevel = mysql_result($result,$i,"userlevel");
      $email  = mysql_result($result,$i,"email");
      $time   = mysql_result($result,$i,"timestamp");

      echo "<tr><td colspan='2'>".$uname."</td><td>".$ulevel."</td><td colspan='2'>".$email."</td><td colspan='2'>".$time."</td></tr>";
   }
   echo "</table>";
}

/**
 * displayBannedUsers - Displays the banned users
 * database table in a nicely formatted html table.
 */
function displayBannedUsers(){
   global $database;
   $q = "SELECT username,timestamp "
       ."FROM ".TBL_BANNED_USERS." ORDER BY username";
   $result = $database->query($q);
   /* Error occurred, return given name by default */
   $num_rows = mysql_numrows($result);
   if(!$result || ($num_rows < 0)){
      echo "Error displaying info";
      return;
   }
   if($num_rows == 0){
      echo "<p class='grid_12'>Database table empty</p>";
      return;
   }
   /* Display table contents */
   echo "<table id='display'>";
   echo "<tr class='title'><tr colspan='2'>Username</td><td colspan='2'>Time Banned</td></tr>";
   for($i=0; $i<$num_rows; $i++){
      $uname = mysql_result($result,$i,"username");
      $time  = mysql_result($result,$i,"timestamp");

      echo "<tr><td colspan='2'>".$uname."</td><td colspan='2'>".$time."</td></tr>";
   }
   echo "</table>";
}
   
/**
 * User not an administrator, redirect to main page
 * automatically.
 */
if(!$session->isAdmin()){
   header("Location: ../main.php");
}
else{
/**
 * Administrator is viewing page, so display all
 * forms.
 */
?>
			<div class="panel panel-default">
			  <div class="panel-body">Back to [<a href="../main.php">Main Page</a>]</p></div>
			</div>
		</div>
	</body>
</html>
<?php
}
?>
<?php include("footeradmin.php");?>