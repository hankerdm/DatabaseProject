<?php
	//get includes for file
	include ('../PHP/Database.php');
	include ('../PHP/SignInSignUpFunctions.php');
	
	//start session and get variables from admin page
	$fName = filter_input(INPUT_POST, 'fname');
	$lName = filter_input(INPUT_POST, 'lname');
	$DOB = filter_input(INPUT_POST, 'DOB');
	$Position = filter_input(INPUT_POST, 'Position');
	$Shift = filter_input(INPUT_POST, 'Shift');
	$Licence = filter_input(INPUT_POST, 'Licence');
	$password = filter_input(INPUT_POST, 'passwordNew');
	$Employee_ID = filter_input(INPUT_POST, 'Employee_ID');
	$tName = filter_input(INPUT_POST, 'tName');
	$hash = password_hash($password, PASSWORD_DEFAULT);
	
	//connect to database and check connection
	$mysqli = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
	if ($mysqli->connect_error)
	{
		echo "could not establish connection to database";
		die ("connection failed: " . $mysqli->connect_error);
	}
	
	//check if already a employee
	$checkEmployee = "SELECT Employee_ID FROM PROVIDER WHERE Employee_ID = '$Employee_ID'";
	$employeeCheckResult = $mysqli->query("$checkEmployee");
	if ($employeeCheckResult->num_rows == 0)
	{
		//create employee in PROVIDER table
		$createEmployee ="INSERT INTO PROVIDER(Employee_ID, lName, fName, DOB, Shift, Licence, PositionType, Team, Password)
				VALUES('$Employee_ID', '$lName', '$fName', '$DOB', '$Shift', '$Licence', '$Position', '$tName', '$hash')"; 
		$createEmployeeResult = $mysqli->query("$createEmployee");
		
		//alert about account creation and return to admin page
		echo '<script language="javascript">';
		echo 'alert("Employee registration successful!");';
		echo 'window.location.href ="../Admin/Admin.html"' ;
		echo '</script>';
	}
	else
	{		
		//if employee already exists in PROVIDER table
		echo '<script language="javascript">';
		echo 'alert("Employee ID already registered.")';
		echo 'window.location.href ="../Admin/Admin.html"' ;
		echo '</script>';
	}
	
	//Close connection
	$mysqli->close();
?>