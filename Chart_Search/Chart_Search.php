<?php include("../PHP/Database.php")?>
	<head>
		<title>Chart Search</title>

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
					
					<?php
					session_start();
					$isAdmin = $_SESSION['isAdmin'];
					if ($isAdmin == 'Administrator')
					{
						echo '<a href = "../Admin/Admin.html">';
						echo '<label id="tt1" class="material-icons mdl-badge mdl-badge--overlap">settings</label></a>';
						echo '<div class="mdl-tooltip" for="tt1">Admin</div>';
					}
					?>
					
				</div>
			</header>
		</div>
		
		<br></br><br></br>
		<div><br>
		<h1 style = "text-align:center; font-size:60px;" > Chart Search Results </h1>
		</br></div>
		
		<table id="Indication" class="center" CELLSPACING="20" style="margin-bottom:20px">
			<td><form id = "chartSearch" action = "../Chart_Search/Chart_Search.php" method = "post">
				<input id="searchField" class="center" type="text" name="searchField" placeholder="Enter patient MRN or Employee ID" style="margin-top:20px; width:350px;"/>
				<input class="button" type="submit" name="Search" value="Search" style="margin-top:20px; margin-left:75px; margin-bottom:0px;"/>
			</form></td>
		</table>
		
		<div> 
			<table id="Details" class="center" CELLSPACING="30">
			<?php
				//start session and save variable for edit patient
				$userSearch = "";
				if (isset($_POST['searchField'])) {
					$userSearch = $_POST['searchField'];
				}
				$_SESSION['currentSearch'] = $userSearch;
								
				//query patient from PATIENT table
				$database = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
				$query = "SELECT * FROM PATIENT WHERE MRN = '$userSearch';";
				$result = mysqli_query($database, $query);
				$num_of_rows = mysqli_num_rows($result);
				$row = $result->fetch_assoc();
				
				if ($num_of_rows > 0)
				{
					//Get patient info
					$fName = $row['pfName'];
					$lName = $row['plName'];
					$DOB = $row['pDOB'];
					$Address = $row['Address'];
					$Phone = $row['Phone'];
					$Email = $row['Email'];
					$MRN = $row['MRN'];
					$Location = $row['Location'];
					$PCP = $row['Employee_ID'];
					$Reason_for_visit = $row['Reason_for_visit'];
					
					//get patient PCP from PROVIDER Table
					$database = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
					$query = "SELECT * FROM PROVIDER WHERE Employee_ID = '$PCP';";
					$result = mysqli_query($database, $query);
					$num_of_rows = mysqli_num_rows($result);
					$row = $result->fetch_assoc();
					$PCPfName = $row['fName'];
					$PCPlName = $row['lName'];
					
					//Generate formatted output
					echo '<td><h1 style = "font-size:40px; background:Teal"> Patient: '.$fName.' '.$lName.' </h1>';
					echo '<h2 style="font-size:20px;font-weight:bold;margin-bottom:0px"> Reason for Visit: </h2>';
					echo '<p> '.$Reason_for_visit.' </p>';
					echo '<h2 style="font-size:20px;font-weight:bold;margin-bottom:0px"> Patient Information: </h2>';
					echo '<ul>
						  <li>DOB: '.$DOB.'</li>
						  <li>Address: '.$Address.'</li>
						  <li>Phone: '.$Phone.'</li>
						  <li>Email: '.$Email.'</li>
						  <li>MRN: '.$MRN.'</li>
						  <li>Location: '.$Location.'</li>
						  <li>PCP: Dr. '.$PCPfName.' '.$PCPlName.'</li>
						  </ul>';
					
					//Create Edit patient button
					if (isset($_POST['searchField'])) {
						echo '<a href = "../Edit_Patient/Edit_Patient.php">';
						echo '<input class="button" type="submit" name="EditPatient" value="Edit Patient" style="margin-top:20px; margin-left:75px; margin-bottom:0px;"/></a>';
					}
				}
				else
				{
					//query employee from PROVIDER table
					$database = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
					$query = "SELECT * FROM PROVIDER WHERE Employee_ID = '$userSearch';";
					$result = mysqli_query($database, $query);
					$num_of_rows = mysqli_num_rows($result);
					$row = $result->fetch_assoc();
					
					//Get employee info
					$fName = $row['fName'];
					$lName = $row['lName'];
					$DOB = $row['DOB'];
					$Shift = $row['Shift'];
					$Licence = $row['Licence'];
					$PositionType = $row['PositionType'];
					$Team = $row['Team'];
					$Employee_ID = $row['Employee_ID'];
					
					//get department employee works in
					$database = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
					$query = "SELECT * FROM TEAMS WHERE Team_name = '$Team';";
					$result = mysqli_query($database, $query);
					$num_of_rows = mysqli_num_rows($result);
					$row = $result->fetch_assoc();
					$Location = $row['Department'];
					
					//Generate formatted output
					echo '<td><h1 style = "font-size:40px; background:Teal"> Employee: '.$fName.' '.$lName.' </h1>';
					echo '<h2 style="font-size:20px;font-weight:bold;margin-bottom:0px"> Employee Information: </h2>';
					echo '<ul>
						  <li>DOB: '.$DOB.'</li>
						  <li>License: '.$Licence.'</li>
						  <li>Employee ID: '.$Employee_ID.'</li>
						  <li>Position: '.$PositionType.'</li>
						  <li>Shift: '.$Shift.'</li>
						  <li>Team: '.$Team.'</li>
						  <li>Location: '.$Location.'</li>
						  </ul>';
				}
			?>
			</table>
		</div>
	</body>
</html>