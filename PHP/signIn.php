<?php
	//get includes for file
	include ('../PHP/Database.php');
	include ('../PHP/SignInSignUpFunctions.php');
	
	//start session and get variables from sign in
	session_start();
	$email = $_POST['usernameEmail'];
	$password = filter_input(INPUT_POST, 'password');
	$_SESSION["user"] = $email;

	
	//connect to database and check connection
	$mysqli = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
	if ($mysqli->connect_error)
	{
		echo "could not establish connection to database";
		die ("connection failed: " . $mysqli->connect_error);
	}
	
	//query database and check for valid username and email 
	$queryUsername = "SELECT email FROM CUSTOMER WHERE email = '$email'";
	$resultUsername = $mysqli->query($queryUsername);
	
	//if account present check password
	if (mysqli_num_rows($resultUsername) != 0)
	{
		//get stored password hash and test if valid
		$queryHash = "SELECT password, user_type FROM CUSTOMER WHERE email = '$email'";
		$resultHash = $mysqli->query($queryHash);
		$resultHashRow = $resultHash->fetch_assoc();
		$hash = $resultHashRow['password'];
		$user_type = $resultHashRow['user_type'];
		
		if (password_verify($password, $hash))
		{
			//routs the user to homepage if username and password were found
			echo '<script language="javascript">';
			echo 'window.location.href ="../Chart_Search/Chart_Search.php"' ;
			echo '</script>';
			$_SESSION['logged_in'] = true;
			$_SESSION['user_type'] = $user_type;
		}
		else
		{
			//output message if invalid password and return to login
			invalidUserOrPassword();
		}
	}
	else
	{
		//output message if invalid user and return to login
		invalidUserOrPassword();
	}
	
	//close connection
	$mysqli->close();
?>