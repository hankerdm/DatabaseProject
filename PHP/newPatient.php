<?php
	//get includes for file
	include ('../PHP/Database.php');
	include ('../PHP/SignInSignUpFunctions.php');
	
	//start session and get variables from new patient page
	$fName = filter_input(INPUT_POST, 'fname');
	$lName = filter_input(INPUT_POST, 'lname');
	$DOB = filter_input(INPUT_POST, 'DOB');
	$Address = filter_input(INPUT_POST, 'Address');
	$Phone = filter_input(INPUT_POST, 'Phone');
	$Email = filter_input(INPUT_POST, 'Email');
	$SSN = filter_input(INPUT_POST, 'SSN');
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
	
	//check if already a patient
	$checkPatient = "SELECT SSN FROM PATIENT WHERE SSN = '$SSN'";
	$patientCheckResult = $mysqli->query("$checkPatient");
	if ($patientCheckResult->num_rows == 0)
	{
		//create patient in PATIENT table
		$createPatient ="INSERT INTO PATIENT(SSN, Employee_ID, Address, pfName, plName, Reason_for_visit, pDOB, Location, MRN, Phone, Email)
				VALUES('$SSN', '$PCP', '$Address', '$fName', '$lName', '$Reason_for_visit', '$DOB', '$Location', '$MRN', '$Phone', '$Email')"; 
		$createPatientResult = $mysqli->query("$createPatient");
		
		//alert about patient record creation and return to new patient page
		echo '<script language="javascript">';
		echo 'alert("Patient registration successful!");';
		echo 'window.location.href ="../New_Patient/New_Patient.html"' ;
		echo '</script>';
	}
	else
	{		
		//if employee already exists in PROVIDER table
		echo '<script language="javascript">';
		echo 'alert("Patient already registered.")';
		echo 'window.location.href ="../New_Patient/New_Patient.html"' ;
		echo '</script>';
	}
	
	//Close connection
	$mysqli->close();
?>