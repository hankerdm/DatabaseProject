<?php
	//get includes for file
	include ('../PHP/Database.php');
	
	//start session and get variables from admin page
	$tName = filter_input(INPUT_POST, 'tName');
	$Department = filter_input(INPUT_POST, 'Department');
	$Shift = filter_input(INPUT_POST, 'Shift');
	
	//connect to database and check connection
	$mysqli = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
	if ($mysqli->connect_error)
	{
		echo "could not establish connection to database";
		die ("connection failed: " . $mysqli->connect_error);
	}
	
	//check if already a team
	$checkTeam = "SELECT Team_name FROM TEAMS WHERE Team_name = '$tName'";
	$teamCheckResult = $mysqli->query("$checkTeam");
	if ($teamCheckResult->num_rows == 0)
	{
		//create team in TEAMS table
		$createTeam ="INSERT INTO TEAMS(Team_name, Department, Shift)
				VALUES('$tName', '$Department', '$Shift')"; 
		$createTeamResult = $mysqli->query("$createTeam");
		
		//alert about team creation and return to Admin page
		echo '<script language="javascript">';
		echo 'alert("Team creation successful!");';
		echo 'window.location.href ="../Admin/Admin.html"' ;
		echo '</script>';
	}
	else
	{		
		//if department already exists in DEPARTMENT table
		echo '<script language="javascript">';
		echo 'alert("Team already exists.")';
		echo 'window.location.href ="../Admin/Admin.html"' ;
		echo '</script>';
	}
	
	//Close connection
	$mysqli->close();
?>