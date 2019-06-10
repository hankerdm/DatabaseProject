<?php
	//get includes for file
	include ('../PHP/Database.php');
	include ('../PHP/SignInSignUpFunctions.php');
	
	//start session and save variable for edit patient
	session_start();
	$userSearch = $_SESSION['currentSearch'];
	
	//start session and get variables from new patient page
	$fName = filter_input(INPUT_POST, 'fname');
	$lName = filter_input(INPUT_POST, 'lname');
	$DOB = filter_input(INPUT_POST, 'DOB');
	$Address = filter_input(INPUT_POST, 'Address');
	$Phone = filter_input(INPUT_POST, 'Phone');
	$Email = filter_input(INPUT_POST, 'Email');
	$MRN = filter_input(INPUT_POST, 'MRN');
	$Location = filter_input(INPUT_POST, 'Location');
	$PCP = filter_input(INPUT_POST, 'PCP');
	$Reason_for_visit = filter_input(INPUT_POST, 'Reason_for_visit');
	
	//connect to database and check connection
	$mysqli = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
	if ($mysqli->connect_error)
	{
		echo "could not establish connection to database";
		die ("connection failed: " . $mysqli->connect_error);
	}
	
	//check for valid patient
	$query = "SELECT * FROM PATIENT WHERE MRN = '$userSearch';";
	$result = mysqli_query($mysqli, $query);
	$num_of_rows = mysqli_num_rows($result);
	$row = $result->fetch_assoc();
	if ($num_of_rows > 0)
	{
		//update database
		$query = "UPDATE PATIENT SET Employee_ID='$PCP', Address='$Address', pfName='$fName', plName='$lName', 
		Reason_for_visit='$Reason_for_visit', pDOB='$DOB', Location='$Location', Phone='$Phone', Email='$Email' WHERE MRN = '$userSearch';";
		mysqli_query($mysqli, $query);

		//generate alert and return to editPatient page
		echo '<script type="text/javascript">';
		echo 'alert("Patient updated");';
		echo 'window.location.href ="../Edit_Patient/Edit_Patient.php"';
		echo '</script>';
	}
	else
	{
		echo '<script type="text/javascript">';
		echo 'alert("Patient not found");';
		echo 'window.location.href ="../Edit_Patient/Edit_Patient.php"' ;
		echo '</script>';
	}
	
	
	//create patient in PATIENT table
	$createPatient ="INSERT INTO PATIENT(SSN, Employee_ID, Address, pfName, plName, Reason_for_visit, pDOB, Location, MRN, Phone, Email)
			VALUES('$SSN', '$PCP', '$Address', '$fName', '$lName', '$Reason_for_visit', '$DOB', '$Location', '$MRN', '$Phone', '$Email')"; 
	$createPatientResult = $mysqli->query("$createPatient");
		
	
	//Close connection
	$mysqli->close();
?>