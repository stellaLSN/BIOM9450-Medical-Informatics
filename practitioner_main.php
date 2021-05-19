<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Practioner Main Page</title>
	<link href="css/StyleSheet.css" rel="stylesheet" type="text/css">


</head>
	
<body onload="firstfocus();">
<div class="container">
  <header>
    <div class="primary_header">
      <h1 class="title">
		  <img src="images/nsw_health_logo.png" alt="" class="main_thumbnail"/>
	  </h1>
    </div>
    <nav class="secondary_header" id="menu">
	<!--Menu with links to different pages -->
      <ul>
		  <li><a href= "practitioner_main.php"> Today's Rounds </a></li>
		  <li><a href= "add_patient.php">Add New Patient</a></li>
		  <li><a href= "patient_records.php">Patient Records</a></li>
		  <li><a href= "search_patient.php">Search Patient</a></li>
		  <li><a href= "reports.php">Reports</a></li>
		  <li><a href= "logout.php">Log Out</a></li>
		  
      </ul>
    </nav>
  </header>
	
  <section>
    <h2 class="noDisplay">Main Content</h2>
    <article class="left_article">			
		<?php
			session_start();
			// establish db connection
			$conn=odbc_connect('z5275703','','',SQL_CUR_USE_ODBC);
				
			// Get prac_id from session
			//echo $_SESSION["prac_login"];
			$session_prac_id = $_SESSION["prac_login"];
		
			// Get curret date
			$currentDate = date('d/m/Y');
    		//echo $currentDate;
				
			// Display Practitioner's Morning Medication Rounds
			echo "<br/><b>Morning Medication Rounds</b><br/><br/>";
			$sql_select_morning_rounds = "SELECT * FROM Medication AS A INNER JOIN Patient AS B ON A.patient_id = B.patient_id WHERE (A.prac_id = '".$session_prac_id."') AND round='morning' AND datevalue([administer_date]) = Date()";
		
			$sql_display_morning_rounds = odbc_exec($conn, $sql_select_morning_rounds);
			
		?>
	
				<table class="event_table">
					<tr>
					
						<td><b><u>Patient Id</u></b></td>
						<td><b><u>First Name</u></b></td>
						<td><b><u>Last Name</u></b></td>
						<td><b><u>Room No.</u></b></td>
						<td><b><u>Status</u></b></td>
						<td><b><u>Medication Name</u></b></td>
						<td><b><u>Dosage</u></b></td>
						<td><b><u>Route of Administration</u></b></td>
						<td><b><u>Round Status</u></b></td>
						<td><b><u>View Profile</u></b></td>
						
						<td><b><u>Action</u></b></td>
	
					</tr>
				<?php
					
					while($row = odbc_fetch_array($sql_display_morning_rounds)) {
				
				?>
					<tr class="<?php if(isset($classname)) echo $classname;?>">
						
						<td><?php echo $row["patient_id"]; ?></td>
						<td><?php echo $row["patient_first_name"]; ?></td>
						<td><?php echo $row["patient_last_name"]; ?></td>
						<td><?php echo $row["room"]; ?></td>
						<td><?php echo $row["status"]; ?></td>
						<td><?php echo $row["med_name"]; ?></td>
						<td><?php echo $row["dosage"]; ?></td>
						<td><?php echo $row["route_of_administration"]; ?></td>
						<td><?php echo $row["round_status"]; ?></td>
						
						
						<td><a href="patient_profile.php?patient_id=<?php echo $row["patient_id"]; ?>">View Profile</a></td>
						
						<td><a href="update_round_status_morn.php?patient_id=<?php echo $row["patient_id"]; ?>">Edit</a></td>
							
					</tr>
				<?php
					
					}
				?>
				</table>
		
		<?php // Display Practitioner's Morning Diet Rounds
			echo "<br/><b>Morning Diet Rounds</b><br/><br/>";
			$sql_select_morning_diet = "SELECT * FROM Diet AS A INNER JOIN Patient AS B ON A.patient_id = B.patient_id WHERE (A.prac_id = '".$session_prac_id."') AND diet_exercise_round ='morning' AND datevalue([administer_date]) = Date()";
		
			$sql_display_morning_diet = odbc_exec($conn, $sql_select_morning_diet);
			
		?>
	
				<table class="event_table">
					<tr>
					
						<td><b><u>Patient Id</u></b></td>
						<td><b><u>First Name</u></b></td>
						<td><b><u>Last Name</u></b></td>
						<td><b><u>Room No.</u></b></td>
						<td><b><u>Status</u></b></td>
						<td><b><u>Exercise/Diet</u></b></td>
						<td><b><u>Exercise/Diet Status</u></b></td>
						<td><b><u>View Profile</u></b></td>
						
						<td><b><u>Action</u></b></td>
	
					</tr>
				<?php
					
					while($row = odbc_fetch_array($sql_display_morning_diet)) {
					
				?>
					<tr class="<?php if(isset($classname)) echo $classname;?>">
						
						<td><?php echo $row["patient_id"]; ?></td>
						<td><?php echo $row["patient_first_name"]; ?></td>
						<td><?php echo $row["patient_last_name"]; ?></td>
						<td><?php echo $row["room"]; ?></td>
						<td><?php echo $row["status"]; ?></td>
						<td><?php echo $row["diet_exercise"]; ?></td>
						<td><?php echo $row["diet_exercise_status"]; ?></td>
							
						<td><a href="patient_profile.php?patient_id=<?php echo $row["patient_id"]; ?>">View Profile</a></td>
					
						<td><a href="update_diet_round_morn.php?patient_id=<?php echo $row["patient_id"]; ?>">Edit</a></td>
							
					</tr>
				<?php
					
					}
				?>
				</table>
		
		<?php
		// Display Practitioner's Afternoon Rounds
			echo "<br><br><b>Afternoon Medication Rounds</b><br><br>";
			$sql_select_aft_rounds = "SELECT * FROM Medication AS A INNER JOIN Patient AS B ON A.patient_id = B.patient_id WHERE (A.prac_id = '".$session_prac_id."') AND round='afternoon' AND datevalue([administer_date]) = Date()";
		
			$sql_display_aft_rounds = odbc_exec($conn, $sql_select_aft_rounds);
			
		?>
	
				<table class="event_table">
					<tr>
					
						<td><b><u>Patient Id</u></b></td>
						<td><b><u>First Name</u></b></td>
						<td><b><u>Last Name</u></b></td>
						<td><b><u>Room No.</u></b></td>
						<td><b><u>Status</u></b></td>
						<td><b><u>Medication Name</u></b></td>
						<td><b><u>Dosage</u></b></td>
						<td><b><u>Route of Administration</u></b></td>
						<td><b><u>Round Status</u></b></td>
						<td><b><u>View Profile</u></b></td>
						
						<td><b><u>Action</u></b></td>
	
					</tr>
				<?php
					while($row = odbc_fetch_array($sql_display_aft_rounds)) {
					
				?>
					<tr>
						
						<td><?php echo $row["patient_id"]; ?></td>
						<td><?php echo $row["patient_first_name"]; ?></td>
						<td><?php echo $row["patient_last_name"]; ?></td>
						<td><?php echo $row["room"]; ?></td>
						<td><?php echo $row["status"]; ?></td>
						<td><?php echo $row["med_name"]; ?></td>
						<td><?php echo $row["dosage"]; ?></td>
						<td><?php echo $row["route_of_administration"]; ?></td>
						<td><?php echo $row["round_status"]; ?></td>
							
						<td><a href="patient_profile.php?patient_id=<?php echo $row["patient_id"]; ?>">View Profile</a></td>
					
						<td><a href="update_round_status_aft.php?patient_id=<?php echo $row["patient_id"]; ?>">Edit</a></td>
							
					</tr>
				<?php
				
					}
				?>
				</table>
		
		<?php // Display Practitioner's Afternoon Diet Rounds
			echo "<br/><b>Afternoon Diet Rounds</b><br/><br/>";
			$sql_select_afternoon_diet = "SELECT * FROM Diet AS A INNER JOIN Patient AS B ON A.patient_id = B.patient_id WHERE (A.prac_id = '".$session_prac_id."') AND diet_exercise_round ='afternoon' AND datevalue([administer_date]) = Date()";
		
			$sql_display_afternoon_diet = odbc_exec($conn, $sql_select_afternoon_diet);
			
		?>
	
				<table class="event_table">
					<tr>
					
						<td><b><u>Patient Id</u></b></td>
						<td><b><u>First Name</u></b></td>
						<td><b><u>Last Name</u></b></td>
						<td><b><u>Room No.</u></b></td>
						<td><b><u>Status</u></b></td>
						<td><b><u>Exercise/Diet</u></b></td>
						<td><b><u>Exercise/Diet Status</u></b></td>
						<td><b><u>View Profile</u></b></td>
						
						<td><b><u>Action</u></b></td>
	
					</tr>
				<?php
					
					while($row = odbc_fetch_array($sql_display_afternoon_diet)) {
					
				?>
					<tr>
						
						<td><?php echo $row["patient_id"]; ?></td>
						<td><?php echo $row["patient_first_name"]; ?></td>
						<td><?php echo $row["patient_last_name"]; ?></td>
						<td><?php echo $row["room"]; ?></td>
						<td><?php echo $row["status"]; ?></td>
						<td><?php echo $row["diet_exercise"]; ?></td>
						<td><?php echo $row["diet_exercise_status"]; ?></td>
							
						<td><a href="patient_profile.php?patient_id=<?php echo $row["patient_id"]; ?>">View Profile</a></td>
						
						<td><a href="update_diet_round_aft.php?patient_id=<?php echo $row["patient_id"]; ?>">Edit</a></td>
							
					</tr>
				<?php
					
					}
				?>
				</table>
		
		<?php
		// Display Practitioner's Evening Rounds
			echo "<br><br><b>Evening Medication Rounds</b><br><br>";
			$sql_select_eve_rounds = "SELECT * FROM Medication AS A INNER JOIN Patient AS B ON A.patient_id = B.patient_id WHERE (A.prac_id = '".$session_prac_id."') AND round='evening' AND datevalue([administer_date]) = Date()";
		
			$sql_display_eve_rounds = odbc_exec($conn, $sql_select_eve_rounds);
			
		?>
	
				<table class="event_table">
					<tr>
					
						<td><b><u>Patient Id</u></b></td>
						<td><b><u>First Name</u></b></td>
						<td><b><u>Last Name</u></b></td>
						<td><b><u>Room No.</u></b></td>
						<td><b><u>Status</u></b></td>
						<td><b><u>Medication Name</u></b></td>
						<td><b><u>Dosage</u></b></td>
						<td><b><u>Route of Administration</u></b></td>
						<td><b><u>Round Status</u></b></td>
						<td><b><u>View Profile</u></b></td>
						
						<td><b><u>Action</u></b></td>
	
					</tr>
				<?php
					
					while($row = odbc_fetch_array($sql_display_eve_rounds)) {
					
				?>
					<tr>
						
						<td><?php echo $row["patient_id"]; ?></td>
						<td><?php echo $row["patient_first_name"]; ?></td>
						<td><?php echo $row["patient_last_name"]; ?></td>
						<td><?php echo $row["room"]; ?></td>
						<td><?php echo $row["status"]; ?></td>
						<td><?php echo $row["med_name"]; ?></td>
						<td><?php echo $row["dosage"]; ?></td>
						<td><?php echo $row["route_of_administration"]; ?></td>
						<td><?php echo $row["round_status"]; ?></td>
							
						<td><a href="patient_profile.php?patient_id=<?php echo $row["patient_id"]; ?>">View Profile</a></td>
					
						<td><a href="update_round_status_eve.php?patient_id=<?php echo $row["patient_id"]; ?>">Edit</a></td>
							
					</tr>
				<?php
					
					}
				?>
				</table>
		
		<?php // Display Practitioner's Evening Diet Rounds
			echo "<br/><b>Evening Diet Rounds</b><br/><br/>";
			$sql_select_evening_diet = "SELECT * FROM Diet AS A INNER JOIN Patient AS B ON A.patient_id = B.patient_id WHERE (A.prac_id = '".$session_prac_id."') AND diet_exercise_round ='evening' AND datevalue([administer_date]) = Date()";
		
			$sql_display_evening_diet = odbc_exec($conn, $sql_select_evening_diet);
			
		?>
	
				<table class="event_table">
					<tr>
					
						<td><b><u>Patient Id</u></b></td>
						<td><b><u>First Name</u></b></td>
						<td><b><u>Last Name</u></b></td>
						<td><b><u>Room No.</u></b></td>
						<td><b><u>Status</u></b></td>
						<td><b><u>Exercise/Diet</u></b></td>
						<td><b><u>Exercise/Diet Status</u></b></td>
						<td><b><u>View Profile</u></b></td>
						
						<td><b><u>Action</u></b></td>
	
					</tr>
				<?php
					
					while($row = odbc_fetch_array($sql_display_evening_diet)) {
					
				?>
					<tr>
						
						<td><?php echo $row["patient_id"]; ?></td>
						<td><?php echo $row["patient_first_name"]; ?></td>
						<td><?php echo $row["patient_last_name"]; ?></td>
						<td><?php echo $row["room"]; ?></td>
						<td><?php echo $row["status"]; ?></td>
						<td><?php echo $row["diet_exercise"]; ?></td>
						<td><?php echo $row["diet_exercise_status"]; ?></td>
							
						<td><a href="patient_profile.php?patient_id=<?php echo $row["patient_id"]; ?>">View Profile</a></td>
						
						<td><a href="update_diet_round_eve.php?patient_id=<?php echo $row["patient_id"]; ?>">Edit</a></td>
							
					</tr>
				<?php
					
					}
				?>
				</table>

					
    </article>
  </section>
  


  <footer class="secondary_header footer">
    <div class="copyright">&copy;2020 - <strong>Stella Lau Shu Neng</strong></div>
  </footer>
	</div>
</body>
</html>