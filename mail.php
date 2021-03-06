<?php
	
/**
 * tutorial
 * 
 * http://ivannovak.com/email-account-activation/
 */
	
	
	include("include/session.php");
	
	if(!$session->logged_in){
		header("Location: ".$session->referrer);
	}
	
	if($_POST){
	   $_POST = $session->cleanInput($_POST);
	}
	
//	$result1=$database->query("SELECT * FROM ".TBL_USERS." WHERE username='$username'") or die(mysql_error());
//	$row100 = mysql_fetch_array($result1);

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
<?php include("admin/adminnav.php"); ?>
<div class="container">
  <div class="row">
    <div class="col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-0">
      <div class="panel-heading"><h2><span class="glyphicon glyphicon-pencil"></span>User Message System</h2></div>
	<form method="post" action="mail.php">
		<input type="submit" name="mailAction" value="Compose" /><input type="submit" name="mailAction" value="Inbox" />
	</form>

<?php

	if(!empty($_POST['mailAction']) && isset($_POST['mailAction'])){
		$action = $_POST['mailAction'];
	} else {
		$action = 'Inbox';
	}



	if(($action == 'Compose') || ($action == 'Reply')) {
	
		if(isset($_POST['mailSubject']) && !empty($_POST['mailSubject'])){
			$mailSubject = 'Re: '.$_POST['mailSubject'];
		} else {
			$mailSubject = "";
		}
		
		if(isset($_POST['mailFrom']) && !empty($_POST['mailFrom'])){
			$mailTo = $_POST['mailFrom'];
		} else {
			$mailTo = "";
		}
		
		
		?>
			<form action="mail.php" method='post'>
				<div id="compose">
					<p class="textinput">To:</p><p class="grid_2"><input type='text' name='mailTo' size='20' value='<?php echo $mailTo; ?>'></p>
					<div class="clear"></div>
					<p class="textinput">Subject:</p><p class="grid_2"><input type='text' name='mailSubject' size='20' value='<?php echo $mailSubject; ?>'></p>
					<div class="clear"></div>
					<p class="textinput">Message:</p><p class="grid_4"><textarea rows='16' cols='45' name='mailMessage'></textarea></p>
					<div class="clear"></div>
					<p class="grid_1"><input type="submit" name="mailAction" value="Send" /></p>
				</div>
			</form>
		<?php
	}
	
	
	if($action == 'Send') {
			
		if(empty($_POST['mailSubject']) || !isset($_POST['mailSubject'])){
			echo "Subject Blank";
		} else {
			$subject = $_POST['mailSubject'];
		}
		
		if(empty($_POST['mailTo']) || !isset($_POST['mailTo'])){
			echo "To Blank";
		} else {
			$mailTo = $_POST['mailTo'];
		}
		
		if(empty($_POST['mailMessage']) || !isset($_POST['mailMessage'])){
			echo "Message Blank";
		} else {
			$message = $_POST['mailMessage'];
		}
		
		$date = date('m/d/Y')." at ".date('g:i.s')." ".date('a');
		
		$q = sprintf("INSERT INTO mail (UserTo, UserFrom, Subject, Message, SentDate, status) VALUES ('%s','$session->username','%s','%s','%s','unread')", 
               mysql_real_escape_string($mailTo),
               mysql_real_escape_string($subject),
               mysql_real_escape_string($message),
               mysql_real_escape_string($date));
		if(!($send = $database->query($q))){
			echo "A letter could not be sent to ".$mailTo."!";
		} else {
			echo "Message Sent to ".$mailTo."!";
		}
		
	}
	
	
	if($action == "Inbox") {
	
		$user = $session->username;
		$q = sprintf("SELECT * FROM mail WHERE UserTo = '%s' ORDER BY SentDate DESC",
		      mysql_real_escape_string($user));
		$getMail = $database->query($q) or die(mysql_error());

		echo "<div id='inbox'>";
		
		if(mysql_num_rows($getMail) == 0){
			echo "<p>you have no mail</p><br /><br />";
		} else {			
			?>
			<table>
				<tr class="title">
					<td colspan="2" align="center">Action</td>
					<td>Status</td>
					<td>From</td>
					<td>Subject</td>
					<td>Time</td>
				</tr>
			</div>
			<?php
			echo "<form action='mail.php' method='post'>";
			while($mail = mysql_fetch_array($getMail)){
				?>
					<tr>
						<input type="hidden" name="mail_id" value="<?php echo $mail['mail_id']; ?>" />
						<td align="center"><input type="submit" name="mailAction" value='View' /></td>
						<td align="center"><input type="submit" name="mailAction" value="Delete" /></td>
						<td><?php echo $mail['status']; ?></td>
						<td><?php echo $mail['UserFrom']; ?></td>
						<td><?php echo $mail['Subject']; ?></td>
						<td><?php echo $mail['SentDate']; ?></td>
					</tr>
				<?php
			}

			echo "</form>";
		}			
		echo "</table>";
	
	}
	
	
	if($action == "View") {
	
		
		$mail_id = $_POST['mail_id'];
		$user = $session->username;
		$q = sprintf("SELECT * FROM mail WHERE UserTo = '%s' AND mail_id = '%s'",
		      mysql_real_escape_string($user),
		      mysql_real_escape_string($mail_id));
		$result = $database->query($q) or die (mysql_error());
		$row = mysql_fetch_array($result);
		
		
		if($row['UserTo'] != $session->username) {
			echo "<font face=verdana><b>This isn't your mail!";
			exit;
		}
		$q = "UPDATE mail SET status='read' WHERE UserTo='$session->username' AND mail_id='$row[mail_id]'";
		$database->query($q) or die("An error occurred resulting that this message has not been marked read.");
		
		?>
			<form method="post" action="mail.php">
				<div id="single">
					<p class="grid_1">From: </p><p class="grid_2"><?php echo $row['UserFrom']; ?><input type="hidden" name="mailFrom" value="<?php echo $row['UserFrom']; ?>" /></p>
					<p class="grid_1 clear">Subject: </p><p class="grid_2"><?php echo $row['Subject']; ?><input type="hidden" name="mailSubject" value="<?php echo$row['Subject']; ?>" /></p>
					<p class="grid_4 clear">body: <br /><?php echo $row['Message']; ?><br /></p>
					<p class="grid_4 clear" align="right"><input type="submit" name="mailAction" value="Reply" /></p>
				</div>
			</form>
<ul class="nav nav-tabs" role="tablist"> 
	<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
		    Admin <span class="caret"></span></a>
		<ul class="dropdown-menu" role="menu">
		  <?php
			}
			if($action == 'Delete') {
			$id = $_POST['mail_id'];
			$query = sprintf("UPDATE mail SET 'Deleted' = 1 WHERE mail_id='%s' LIMIT 1",
		            mysql_real_escape_string($id));
		
			if(!$query) {
				echo "The message wasn\'t deleted";
			} else {
				header("Location: mail.php");
					}
				}	
		        	echo "
		        		  <li><a href=\"main.php\">Main</a></li></ul>;
						  <li><a href=\"userinfo.php?user=$session->username\">My Account</a></li>;
						  <li><a href=\"process.php\">Logout</a></li>";
		  		?>
	</li>
</ul>
</div>
<?php include("admin/footeradmin.php"); ?>