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

		echo "<div class='grid_5'><p class='right'>[<a href=\"mail.php\"><center>You have $numUnreadMail Unread Mail</center></a>]&nbsp;</p></div>";
	}
	?>
<div class="container">
	<div class="container-fluid">
	  <h1>Logged In</h1>
		<h4 class="text-muted">Welcome <b><?php echo $session->username; ?></b>! You are logged in</h4><br/><br/>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Modules</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="main.php">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="userinfo.php?user=<?php echo $session->username; ?>">My Account <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Add Account</a></li>
            <li><a href="useredit.php">Edit Account</a></li>
            <li><a href="#">Delete Account</a></li>
          </ul>
        </li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 3</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
        <li><a href=\"process.php\"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<?php
   if($session->isAdmin()){
		echo "[<a href=\"admin/admin.php\">Admin Center</a>]&nbsp;";
   }
		echo "[<a href=\"process.php\">Logout</a>]";
?>
<?php
}
else{
?>