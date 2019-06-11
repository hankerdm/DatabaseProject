<?php
	//get includes for file
	include ('../PHP/Database.php');
	session_start();
	
	//start get variables from sign in
	$Employee_ID = $_POST['username'];
	$password = filter_input(INPUT_POST, 'password');
	
	//connect to database and check connection
	$mysqli = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
	if ($mysqli->connect_error)
	{
		echo "could not establish connection to database";
		die ("connection failed: " . $mysqli->connect_error);
	}
	
	//query database and check for valid username and email 
	$queryUsername = "SELECT Employee_ID FROM PROVIDER WHERE Employee_ID = '$Employee_ID'";
	$resultUsername = $mysqli->query($queryUsername);
	
	//if account present check password
	if (mysqli_num_rows($resultUsername) != 0)
	{
		
		//get stored password hash and test if valid
		$queryHash = "SELECT * FROM PROVIDER WHERE Employee_ID = '$Employee_ID'";
		$resultHash = $mysqli->query($queryHash);
		$resultHashRow = $resultHash->fetch_assoc();
		$hash = $resultHashRow['Password'];
		$_SESSION['isAdmin'] = $resultHashRow['PositionType'];
		$hash2 = password_hash($password, PASSWORD_DEFAULT);

		if (password_verify($password, $hash))
		{
			//routs the user to chart search if id and password were found
			echo '<script language="javascript">';
			echo 'window.location.href ="../Chart_Search/Chart_Search.php"' ;
			echo '</script>';
		}
		else
		{
			//output message if invalid password and return to login
			echo '<script language="javascript">';
			echo 'alert("Invalid Password");';
			echo 'window.location.href ="../SignIn/Login.html"';
			echo '</script>';
		}
	}
	else
	{
		//output message if invalid user and return to login
		echo '<script language="javascript">';
		echo 'alert("Invalid ID");';
		echo 'window.location.href ="../SignIn/Login.html"';
		echo '</script>';
	}
	
	//close connection
	$mysqli->close();
?>