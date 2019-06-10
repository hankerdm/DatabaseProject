<?php

if (isset($_POST['SSN']))
    {
        include("Database.php");

        $database = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);

        $SSN = $_POST['SSN'];

        $query = "DELETE FROM PATIENT WHERE SSN = '$SSN'";
        mysqli_query($database, $query);

		//alert that file was uploaded
		echo '<script language="javascript">';
		echo 'alert("Patient record removed")';
		echo '</script>';
		
		//return to admin page
		echo '<script language="javascript">';
		echo 'window.location.href ="../Admin/Admin.html"' ;
		echo '</script>';
    }

?>