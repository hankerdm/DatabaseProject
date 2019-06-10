<?php
	//get includes for file
	include ('../PHP/Database.php');
	
	//start session and get variables from admin page
	$dName = filter_input(INPUT_POST, 'dName');
	$Beds = filter_input(INPUT_POST, 'Beds');
	$Specialty = filter_input(INPUT_POST, 'Specialty');
	
	//connect to database and check connection
	$mysqli = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
	if ($mysqli->connect_error)
	{
		echo "could not establish connection to database";
		die ("connection failed: " . $mysqli->connect_error);
	}
	
	//check if already a department
	$checkDepartment = "SELECT Department_name FROM DEPARTMENT WHERE Department_name = '$dName'";
	$departmentCheckResult = $mysqli->query("$checkDepartment");
	if ($departmentCheckResult->num_rows == 0)
	{
		//create department in DEPARTMENT table
		$createDepartment ="INSERT INTO DEPARTMENT(Department_name, Beds, Specialty)
				VALUES('$dName', '$Beds', '$Specialty')"; 
		$createDepartmentResult = $mysqli->query("$createDepartment");
		
		//alert about department creation and return to Admin page
		echo '<script language="javascript">';
		echo 'alert("Department creation successful!");';
		echo 'window.location.href ="../Admin/Admin.html"' ;
		echo '</script>';
	}
	else
	{		
		//if department already exists in DEPARTMENT table
		echo '<script language="javascript">';
		echo 'alert("Department already registered.")';
		echo 'window.location.href ="../Admin/Admin.html"' ;
		echo '</script>';
	}
	
	//Close connection
	$mysqli->close();
?>