<?php

//message when invalid user or password
function invalidUserOrPassword()
{
	echo '<script language="javascript">';
	echo 'alert("Invalid username or password. Please enter a valid username and password.")';
	echo '</script>';
	returnToLogin();
}

//confirm passwords and confirmation match
function confirmPassword($password, $passwordCnf)
{
	if (!strcmp($password, $passwordCnf) == 0)
	{
		echo '<script language="javascript">';
		echo 'alert("Password confirmation does not match.")';
		echo '</script>';
		returnToLogin();
		return false;
	}
	
	//if password and confirmation match return true
	return true;
}

//ensure a strong password
function passwordValidation($password) 
{
	//check if password is proper format
	$lowercase = preg_match('@[a-z]@', $password);
	$uppercase = preg_match('@[A-Z]@', $password);
	$number = preg_match('@[0-9]@', $password);
	
	//if bad password display appropriate message	
	if (!(strlen($password)>7) || !$uppercase || !$number || !$lowercase)
	{
		echo '<script language="javascript">';
		echo 'alert("Invalid password. Password must have at least 8 characters and contain the following: " 
			  + "1 lowercase letter, 1 capital letter, 1 number.")';
		echo '</script>';
		returnToLogin();
		return false;
	}
	
	//if good password return true
	return true;
}

//rerout the user from this php file back to homepage to try again
function returnToLogin()
{
		echo '<script language="javascript">';
		echo 'window.location.href ="../SignIn/Login.html"' ;
		echo '</script>';
}
?>