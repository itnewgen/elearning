<?php
/**
 * UserInfo.php
 *
 * This page is for users to view their account information
 * with a link added for them to edit the information.
 *
 */
include("include/session.php");
$page = "userinfo.php";
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
<div class="container">
  <div class="row">
    <div class="col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-0">

<?php
/* Requested Username error checking */
$req_user = trim($_GET['user']);
if(!$req_user || strlen($req_user) == 0 ||
   !preg_match("/^([0-9a-z])+$/i", $req_user) ||
   !$database->usernameTaken($req_user)){
   die("Username not registered");
}

if(MAIL){
 $q = "SELECT mail_id FROM ".TBL_MAIL." WHERE UserTo = '$session->username' and status = 'unread'";
 $numUnreadMail = $database->query($q) or die(mysql_error());
 $numUnreadMail = mysql_num_rows($numUnreadMail);
 
 echo "<div class='grid_5'><p class='right'><a href=\"mail.php\"><center>You have $numUnreadMail Unread Mail</center></a>&nbsp;</p></div>";
 echo "<div class='clear'></div>";
}

/* Logged in user viewing own account */
if(strcmp($session->username,$req_user) == 0){
   echo "<h1>My Account</h1>";
}
/* Visitor not viewing own account */
else{
   echo "<h1>User Info</h1>";
}

/* Display requested user information */
$req_user_info = $database->getUserInfo($req_user);

/* Name */
echo "<p><b>Name: ".$req_user_info['name']."</b><br />";

/* Username */
echo "<p><b>Username: ".$req_user_info['username']."</b><br />";

/* Email */
echo "<b>Email:</b> ".$req_user_info['email']."</p>";

/**
 * Note: when you add your own fields to the users table
 * to hold more information, like homepage, location, etc.
 * they can be easily accessed by the user info array.
 *
 * $session->user_info['location']; (for logged in users)
 *
 * ..and for this page,
 *
 * $req_user_info['location']; (for any user)
 */

/* If logged in user viewing own account, give link to edit */
if(strcmp($session->username,$req_user) == 0){
   echo "<a href=\"useredit.php\">Edit Account Information</a><br><br>";
}

/* Link back to main */
echo "[<a href=\"main.php\">Main</a>] ";


if($session->isAdmin()){
   echo "[<a href=\"admin/admin.php\">Admin Center</a>]&nbsp;";
}



?>
</div>
</body>
</html>
