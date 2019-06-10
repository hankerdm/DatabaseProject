<?php
session_start();
include ('../PHP/SignInSignUpFunctions.php');

// unset cookies in root
if (isset($_SERVER['HTTP_COOKIE'])) {
	$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
	foreach($cookies as $cookie) {
		$parts = explode('=', $cookie);
		$name = trim($parts[0]);
		setcookie($name, '', time()-1000);
		setcookie($name, '', time()-1000, '/');
	}
}

//remove PHPSESSID from browser
if (isset($_COOKIE[session_name()]))
	setcookie(session_name(), "", time()-3600, "/");

//clear session from globals and destroy
$_SESSION = array();
session_destroy();

returnToLogin();
?>