<?php
// index
include 'sqlcon.php';
//Insert or Update contact information
if(isset($_POST['action_type']))
{
	if ($_POST['action_type'] == 'add' or $_POST['action_type'] == 'edit')
	{
		//Sanitize the data and assign to variables
        $id = mysqli_real_escape_string($link, strip_tags($_POST['id']));
		$idnumber = mysqli_real_escape_string($link, strip_tags($_POST['idnum']));
		$fname = mysqli_real_escape_string($link, strip_tags($_POST['firstname']));
		$mname = mysqli_real_escape_string($link, strip_tags($_POST['middlename']));
		$lname = mysqli_real_escape_string($link, strip_tags($_POST['lastname']));
		$gender = mysqli_real_escape_string($link, strip_tags($_POST['gender']));
		$bdate = mysqli_real_escape_string($link, strip_tags($_POST['birthdate']));
		$address = mysqli_real_escape_string($link, strip_tags($_POST['address']));
        $contact = mysqli_real_escape_string($link, strip_tags($_POST['contact']));
        $guardian = mysqli_real_escape_string($link, strip_tags($_POST['guardian']));
				
		if ($_POST['action_type'] == 'add')
		{
			$sql = "insert into studinfo set
                    idnum = '$idnumber',
					firstname = '$fname',
					middlename = '$mname',
					lastname = '$lname',
					gender = '$gender',
					birthdate = '$bdate',
					address = '$address',
                    contact = '$contact',
                    guardian = '$guardian'";
		}else{
			$sql = "update studinfo set 
                    idnum = '$idnumber',
					firstname = '$fname',
					middlename = '$mname',
					lastname = '$lname',
					gender = '$gender',
					birthdate = '$bdate',
					address = '$address',
                    contact = '$contact',
                    guardian = '$guardian'
                    where id = '$id'";
		}
		
		
		if (!mysqli_query($link, $sql))
		{
			echo 'Error Saving Data. ' . mysqli_error($link);
			exit();	
		}
	}
	header('Location: addstudent.php');
	exit();
}
//End Insert or Update contact information

//Start of edit contact read
$gresult = ''; //declare global variable
if(isset($_POST["action"]) and $_POST["action"]=="edit"){
	$id = (isset($_POST["ci"])? $_POST["ci"] : '');
	$sql = "select id, idnum, firstname, middlename, lastname, gender,
            birthdate, address, contact, guardian from studinfo 
			where id = $id";

	$result = mysqli_query($link, $sql);

	if(!$result)
	{
		echo mysqli_error($link);
		exit();
	}
	
	$gresult = mysqli_fetch_array($result);
	
	include 'update.php';
	exit();
}
//end of edit contact read

//Start Delete Contact
if(isset($_POST["action"]) and $_POST["action"]=="delete"){
	$id = (isset($_POST["ci"])? $_POST["ci"] : '');
	$sql = "delete from studinfo 
			where id = $id";

	$result = mysqli_query($link, $sql);

	if(!$result)
	{
		echo mysqli_error($link);
		exit();
	}
	
}
//End Delete Contact

//Read contact information from database
$sql = "select id, idnum, firstname , middlename, lastname,
		gender, birthdate, address, contact, 
		guardian from studinfo";

$result = mysqli_query($link, $sql);

if(!$result)
{
	echo mysqli_error($link);
	exit();
}

$contact_list = array();
//Loo through each row on array and store the data to $contact_list[]
while($rows = mysqli_fetch_array($result))
{
	$contact_list[] = array('id' => $rows['id'],
                            'idnum' => $rows['idnum'], 
							'firstname' => $rows['firstname'],
							'middlename' => $rows['middlename'],
							'lastname' => $rows['lastname'],
							'gender' => $rows['gender'],
							'birthdate' => $rows['birthdate'],
                            'address' => $rows['address'],
                            'contact' => $rows['contact'],
                            'guardian' => $rows['guardian']);
}
include 'addstudent.php';
exit();
?>