<?php 
// contactlist
include_once 'studentproc.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Info</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function ConfirmDelete(){
	var d = confirm('Do you really want to delete data?');
	if(d == false){
		return false;
	}
}
</script>
</head>
<body>
	<div class="wrapper">
		<div class="content" >
			<br/>
			<table class="pbtable">
				<thead>
					<tr>
                        <th>
							Id
                        </th>
						<th>
							Student Id
                        </th>
						<th>
							First Name
						</th>
						<th>
							Middle Name
						</th>
						<th>
							Last Name
						</th>
						<th>
							Gender
						</th>
                        <th>
							Birthdate
						</th>
                        <th>
							Address
						</th>
                        <th>
							Contact Number
						</th>
                        <th>
							Guardin Name
						</th>
                        
						<th></th><th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($contact_list as $contact) : ?>
						<tr>
                            <td>
								<?php echo $contact["id"]; ?>
							</td>
							<td>
								<?php echo $contact["idnum"]; ?>
							</td>
							<td>
								<?php echo $contact["firstname"]; ?>
							</td>
							<td>
								<?php echo $contact["middlename"]; ?>
							</td>
							<td>
								<?php echo $contact["lastname"]; ?>
							</td>
							<td>
								<?php echo $contact["gender"]; ?>
							</td>
                            <td>
								<?php echo $contact["birthdate"]; ?>
							</td>
                            <td>
								<?php echo $contact["address"]; ?>
							</td>
                            <td>
								<?php echo $contact["contact"]; ?>
							</td>
                            <td>
								<?php echo $contact["guardian"]; ?>
							</td>
							<td>
								<form method="post" action="studentproc.php">
									<input type="hidden" name="ci" 
									value="<?php echo $contact["id"]; ?>" />
									<input type="hidden" name="action" value="edit" />
									<input type="submit" value="Edit" />
								</form> 
							</td>
							<td>
								<form method="POST" action="studentproc.php" 
								onSubmit="return ConfirmDelete();">
									<input type="hidden" name="ci" 
									value="<?php echo $contact["id"]; ?>" />
									<input type="hidden" name="action" value="delete" />
									<input type="submit" value="Delete" />
								</form>
							</td>
						<tr>
					<?php endforeach; ?>
				</tbody>
			</table><br/>
			<a href="update.php" class="link-btn">Add Contact</a>
			<a href="../main.php"> Back </a>
		</div>
	</div>
</body>
</html>