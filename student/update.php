<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">

function Validate(){
	var valid = true;
	var message = '';
	var fname = document.getElementById("fname");
	var lname = document.getElementById("lname");
	
	if(fname.value.trim() == ''){
		valid = false;
		message = message + '*First Name is required' + '\n';
	}
	if(lname.value.trim() == ''){
		valid = false;
		message = message + '*Last Name is required';
	}
	
	if (valid == false){
		alert(message);
		return false;
	}
}

function GotoHome(){
	window.location = 'studentproc.php?';
}

</script>
</head>
<body>
	<div class="wrapper">
		<div class="content" style="width: 500px !important;">
			<br/>
			<div>
			<form id="frmContact" method="POST" action="studentproc.php" 		
					onSubmit="return Validate();">
				<input type="hidden" name="id" 
				value="<?php echo (isset($gresult) ? $gresult["id"] :  ''); ?>" />
				<table>
                
                <tr>
						<td>
							<label for="fname">Id Number </label>
						</td>
						<td>
							<input type="text" name="idnum" 
							value="<?php echo (isset($gresult) ? $gresult["idnum"] :  ''); ?>" 
							id="fname" class="txt-fld"/>
				</td>
                </tr>
                        
					<tr>
						<td>
							<label for="fname">First Name: </label>
						</td>
						<td>
							<input type="text" name="firstname" 
							value="<?php echo (isset($gresult) ? $gresult["firstname"] :  ''); ?>" 
							id="fname" class="txt-fld"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="fname">Middle Name: </label>
						</td>
						<td>
							<input type="text" name="middlename" 
							value="<?php echo (isset($gresult) ? $gresult["middlename"] :  ''); ?>" 
							id="lname" class="txt-fld"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="fname">Last Name: </label>
						</td>
						<td>
							<input type="text" name="lastname" 
							value="<?php echo (isset($gresult) ? $gresult["lastname"] :  ''); ?>" 
							class="txt-fld"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="fname">Gender: </label>
						</td>
						<td>
							<input type="text" name="gender" 
							value="<?php echo (isset($gresult) ? $gresult["gender"] :  ''); ?>" 
							class="txt-fld"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="fname">Birthdate: </label>
						</td>
						<td>
							<input type="text" name="birthdate" 
							value="<?php echo (isset($gresult) ? $gresult["birthdate"] :  ''); ?>" 
							class="txt-fld"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="fname">Address: </label>
						</td>
						<td>
							<input type="text" name="address" 
							value="<?php echo (isset($gresult) ? $gresult["address"] :  '');?>" 
							class="txt-fld"/>
						</td>
					</tr>
                    <tr>
						<td>
							<label for="fname">Contact: </label>
						</td>
						<td>
							<input type="text" name="contact" 
							value="<?php echo (isset($gresult) ? $gresult["contact"] :  ''); ?>" 
							class="txt-fld"/>
						</td>
					</tr>
                    
                    <tr>
						<td>
							<label for="fname">Guardian: </label>
						</td>
						<td>
							<input type="text" name="guardian" 
							value="<?php echo (isset($gresult) ? $gresult["guardian"] :  ''); ?>" 
							class="txt-fld"/>
						</td>
					</tr>
                    
                    
                    
				</table>
				<input type="hidden" name="action_type" value="<?php echo (isset($gresult) ? 'edit' :  'add');?>"/>
				<div style="text-align: center; padding-top: 30px;">
					<input class="btn" type="submit" name="save" id="save" value="Save" />
					<input class="btn" type="submit" name="save" id="cancel" value="Cancel" 
					onclick=" return GotoHome();"/>
				</div>
			</form>
			</div>
		</div>
	</div>
</body>
</html>