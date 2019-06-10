<?php include("../PHP/Database.php")?>

<html lang="en">

	<head>
		<title>Edit Patient</title>

		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">
		
		<link rel="stylesheet" href="../CSS/HomePageCSS.css">
		<script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
	</head>

	<body>
		<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
			<header class="mdl-layout__header">
			
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
							mdl-textfield--floating-label mdl-textfield--align-left" >
					
					<a href = "../Chart_Search/Chart_Search.php">
					<label id="tt5" class="material-icons mdl-badge mdl-badge--overlap">home</label></a>  
					<div class="mdl-tooltip" for="tt5">Home</div>
					
					<a href = "../New_Patient/New_Patient.html">
					<label id="tt2" class="material-icons mdl-badge mdl-badge--overlap">account_box</label></a>  
					<div class="mdl-tooltip" for="tt2">New Patient</div>
					
					<a href = "../SignIn/Login.html">
					<label id="tt4" class="material-icons mdl-badge mdl-badge--overlap">power_settings_new</label></a>
					<div class="mdl-tooltip" for="tt4">Sign-Out</div>
					
					<a href = "../Chart_Search/Chart_Search.php">
					<label id="tt1" class="material-icons mdl-badge mdl-badge--overlap">search</label></a>
					<div class="mdl-tooltip" for="tt1">Chart Search</div>
					
				</div>
			</header>
		</div>
		
		<br></br><br></br>
		<div><br>
		<h1 style = "text-align: center; font-size:60px;" > Edit Patient </h1>
		</br></div>
		
		<?php
			//start session and save variable for edit patient
			session_start();
			$userSearch = $_SESSION['currentSearch'];
							
			//query patient from PATIENT table
			$database = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
			$query = "SELECT * FROM PATIENT WHERE MRN = '$userSearch';";
			$result = mysqli_query($database, $query);
			$num_of_rows = mysqli_num_rows($result);
			$row = $result->fetch_assoc();
			
			//Get patient info
			$fName = $row['pfName'];
			$lName = $row['plName'];
			$DOB = $row['pDOB'];
			$Address = $row['Address'];
			$Phone = $row['Phone'];
			$Email = $row['Email'];
			$SSN = $row['SSN'];
			$MRN = $row['MRN'];
			$Location = $row['Location'];
			$PCP = $row['Employee_ID'];
			$Reason_for_visit = $row['Reason_for_visit'];
		?>
		
		<table CELLPADDING="30" CELLSPACING="30" align="center" style=" width:1000px; height:550px">
			<td>
				<div> 
					<table id="Details" class="center" CELLSPACING="30">
						<td><form id = "editPatient" action = "../PHP/editPatient.php" method = "post">
							
							<?php
							echo '<label><br>First Name:</br></label>';
							echo '<input id = "fname" type="text" style="width:350px" name="fname" value="'.$fName.'" placeholder = "First Name" /></br>';
							echo '<label><br>Last Name:</br></label>';
							echo '<input id = "lname" type="text" name="lname" value="'.$lName.'" placeholder = "Last Name" /></br>';
							echo '<label><br>DOB:</br></label>';
							echo '<input id = "DOB" type="text" name="DOB" value="'.$DOB.'" placeholder = "##/##/####" /></br>';
							echo '<label><br>Address:</br></label>';
							echo '<input id = "Address" type="text" name="Address" value="'.$Address.'" placeholder = "123456 Main St."/></br>';
							echo '<label><br>Phone:</br></label>';
							echo '<input id = "Phone" type="text" name="Phone" value="'.$Phone.'" placeholder ="123-456-7890" /></br>';
							echo '<label><br>Email:</br></label>';
							echo '<input id = "Email" type="text" name="Email" value="'.$Email.'" placeholder ="J.Doe@mail.com" /></br>';
							echo '<label><br>MRN:</br></label>';
							echo '<input id = "MRN" type="text" name="MRN" value="'.$MRN.'" placeholder ="123456789" /></br>';
							echo '<label><br>Location:</br></label>';
							echo '<input id = "Location" type="text" name="Location" value="'.$Location.'" placeholder ="Department" /></br>';
							echo '<label><br>PCP ID:</br></label>';
							echo '<input id = "PCP" type="text" name="PCP" value="'.$PCP.'" placeholder ="Employee ID" />';
							?>
						</td>
					</table>
				</div>
			</td>
			
			<td>
				<div> 
					<table id="Indication" class="center" CELLSPACING="30">
						<td>
							<?php
							echo '<textarea id="Reason_for_visit" name="Reason_for_visit" placeholder ="Enter Reason for visit. 500 char limit" 
								  style="text-align:left; height:630px; width:350px; align-content:left;">'.$Reason_for_visit.'</textarea>';
							?>
							<input class = "button" type = "submit" name = "Submit" value = "Update" />
						</form></td>
					</table>
				</div>
			</td>
		</table>
	</body>
</html>