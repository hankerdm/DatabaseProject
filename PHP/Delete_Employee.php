<?php

if (isset($_POST['Employee_ID']))
    {
        include("Database.php");

        $database = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);

        $Employee_ID = $_POST['Employee_ID'];

        $query = "DELETE FROM PROVIDER WHERE Employee_ID = '$Employee_ID'";
        mysqli_query($database, $query);

		//alert that file was uploaded
		echo '<script language="javascript">';
		echo 'alert("Employee account removed")';
		echo '</script>';
		
		//return to admin page
		echo '<script language="javascript">';
		echo 'window.location.href ="../Admin/Admin.html"' ;
		echo '</script>';
    }
?>