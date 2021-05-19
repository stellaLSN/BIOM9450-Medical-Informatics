<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Patient Records Database</title>
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
		<div class="registration_form">
		<?php
			session_start();
			// establish db connection
			$conn=odbc_connect('z5275703','','',SQL_CUR_USE_ODBC);
				
			// Get prac_id from session
			//echo $_SESSION["prac_login"];
			$session_prac_id = $_SESSION["prac_login"];
			echo "<br/><b>Search Patient Records Database</b><br/><br/>";
				
		?>
		
		<form name="search_id" method="post">			
			<table class="form_center" id="search_id" style="float:center">
				<tr>
					<th colspan="2"><b>Search By Patient ID</b></th>
				</tr>
				
				<tr>
					<td style="text-align: right">Patient ID:</td>
					<td><input type="text" name="patient_id"/></td>
				
					<td style="text-align: right"><input type="submit" name="by_id" id="by_id" value="Search by ID" class="button"></td>
						
				</tr>					
			</table>				
		</form>
		
		<?php
			if(isset($_POST['by_id'])){ //check if form was submitted
				$input_id = ltrim($_POST['patient_id']); //get input text
				//echo $input_id;
				
				// Display All Patient Records
				echo "<br/><b>Patient Records Found:</b><br/>";
				$sql_select_patient_record = "SELECT * FROM Patient WHERE patient_id='".$input_id."'";
				$sql_display_patient_record = odbc_exec($conn, $sql_select_patient_record);
				?>
				
				
				<table class="event_table">
					<tr>
						<td><b><u>Patient Id</u></b></td>
						<td><b><u>Practioner ID</u></b></td>
						<td><b><u>First Name</u></b></td>
						<td><b><u>Last Name</u></b></td>
						<td><b><u>DOB</u></b></td>
						<td><b><u>Room No.</u></b></td>
						<td><b><u>Status</u></b></td>
						<td><b><u>Address</u></b></td>
						<td><b><u>Contact</u></b></td>
	
					</tr>
				<?php
					
					while($row = odbc_fetch_array($sql_display_patient_record)) {
					
				?>
					<tr>
						<td><?php echo $row["patient_id"]; ?></td>
						<td><?php echo $row["prac_id"]; ?></td>
						<td><?php echo $row["patient_first_name"]; ?></td>
						<td><?php echo $row["patient_last_name"]; ?></td>
						<td><?php echo date("d-m-Y", strtotime($row["dob"])); ?></td>
						<td><?php echo $row["room"]; ?></td>
						<td><?php echo $row["status"]; ?></td>
						<td><?php echo $row["address"]; ?></td>
						<td><?php echo $row["contact"]; ?></td>
						<td><a href="edit-patient-process.php?patient_id=<?php echo $row["patient_id"]; ?>">Edit</a></td>
						
						<td><a href="patient_profile.php?patient_id=<?php echo $row["patient_id"]; ?>">View Profile</a></td>	
					</tr>
				<?php
					
					}
				?>
				</table>
		<?php
			}		 
	?>
		
	<form name="search_name" method="post">			
			<table class="form_center" id="search_name" style="float:center">
				<tr>
					<th colspan="2"><br><b>Search By Patient Name</b></th>
				</tr>
				
				<tr>
					<td style="text-align: right">Patient First Name:</td>
					<td><input type="text" name="patient_fn"/></td>
				</tr>
				<tr>
					<td style="text-align: right">Patient Last Name:</td>
					<td><input type="text" name="patient_ln"/></td>
				
				
					<td style="text-align: right"><input type="submit" name="by_name" id="by_name" value="Search by Name" class="button"></td>
						
				</tr>					
			</table>				
		</form>
		
		<?php
			if(isset($_POST['by_name'])){ //check if form was submitted
				$input_fn = $_POST['patient_fn']; //get input text
				echo $input_id;
				
				$input_ln = $_POST['patient_ln']; //get input text
				//echo "<br>".$input_id;
				
				// Display All Patient Records
				echo "<br/><b>Patient Records Found:</b><br/>";
				$sql_select_patient_record = "SELECT * FROM Patient WHERE patient_first_name='".$input_fn."' AND patient_last_name ='".$input_ln."'";
				$sql_display_patient_record = odbc_exec($conn, $sql_select_patient_record);
				?>
				
				
				<table class="event_table">
					<tr>
						<td><b><u>Patient Id</u></b></td>
						<td><b><u>Practioner ID</u></b></td>
						<td><b><u>First Name</u></b></td>
						<td><b><u>Last Name</u></b></td>
						<td><b><u>DOB</u></b></td>
						<td><b><u>Room No.</u></b></td>
						<td><b><u>Status</u></b></td>
						<td><b><u>Address</u></b></td>
						<td><b><u>Contact</u></b></td>
	
					</tr>
				<?php
			
					while($row = odbc_fetch_array($sql_display_patient_record)) {
					
				?>
					<tr>
						<td><?php echo $row["patient_id"]; ?></td>
						<td><?php echo $row["prac_id"]; ?></td>
						<td><?php echo $row["patient_first_name"]; ?></td>
						<td><?php echo $row["patient_last_name"]; ?></td>
						<td><?php echo date("d-m-Y", strtotime($row["dob"])); ?></td>
						<td><?php echo $row["room"]; ?></td>
						<td><?php echo $row["status"]; ?></td>
						<td><?php echo $row["address"]; ?></td>
						<td><?php echo $row["contact"]; ?></td>
						<td><a href="edit-patient-process.php?patient_id=<?php echo $row["patient_id"]; ?>">Edit</a></td>
						
						<td><a href="patient_profile.php?patient_id=<?php echo $row["patient_id"]; ?>">View Profile</a></td>	
					</tr>
				<?php
					
					}
				?>
				</table>
		<?php
			}			 
	?>
		
	<form name="search_room" method="post">			
			<table class="form_center" id="search_room" style="float:center">
				<tr>
					<th colspan="2"><br><b>Search By Room</b></th>
				</tr>
				
				<tr>
					<td style="text-align: right">Room Number:</td>
					<td><input type="text" name="room"/></td>
				
					<td style="text-align: right"><input type="submit" name="by_room" id="by_room" value="Search by Room" class="button"></td>
						
				</tr>					
			</table>				
		</form>
		
		<?php
			if(isset($_POST['by_room'])){ //check if form was submitted
				$input_id = ltrim($_POST['room']); //get input text
				//echo $input_id;
				
				// Display All Patient Records
				echo "<br/><b>Patient Records Found:</b><br/>";
				$sql_select_patient_record = "SELECT * FROM Patient WHERE room='".$input_id."'";
				$sql_display_patient_record = odbc_exec($conn, $sql_select_patient_record);
				?>
				
				
				<table class="event_table">
					<tr>
						<td><b><u>Patient Id</u></b></td>
						<td><b><u>Practioner ID</u></b></td>
						<td><b><u>First Name</u></b></td>
						<td><b><u>Last Name</u></b></td>
						<td><b><u>DOB</u></b></td>
						<td><b><u>Room No.</u></b></td>
						<td><b><u>Status</u></b></td>
						<td><b><u>Address</u></b></td>
						<td><b><u>Contact</u></b></td>
	
					</tr>
				<?php
					
					while($row = odbc_fetch_array($sql_display_patient_record)) {
					
				?>
					<tr>
						<td><?php echo $row["patient_id"]; ?></td>
						<td><?php echo $row["prac_id"]; ?></td>
						<td><?php echo $row["patient_first_name"]; ?></td>
						<td><?php echo $row["patient_last_name"]; ?></td>
						<td><?php echo date("d-m-Y", strtotime($row["dob"])); ?></td>
						<td><?php echo $row["room"]; ?></td>
						<td><?php echo $row["status"]; ?></td>
						<td><?php echo $row["address"]; ?></td>
						<td><?php echo $row["contact"]; ?></td>
						<td><a href="edit-patient-process.php?patient_id=<?php echo $row["patient_id"]; ?>">Edit</a></td>
					
						<td><a href="patient_profile.php?patient_id=<?php echo $row["patient_id"]; ?>">View Profile</a></td>	
					</tr>
				<?php
					$i++;
					}
				?>
				</table>
		<?php
			}		 
	?>
		
	<form name="search_prac_id" method="post">			
			<table class="form_center" id="search_prac_idPr" style="float:center">
				<tr>
					<th colspan="2"><br><b>Search By Practitioner ID</b></th>
				</tr>
				
				<tr>
					<td style="text-align: right">Practitioner Id:</td>
					<td><input type="text" name="prac_id"/></td>
				
					<td style="text-align: right"><input type="submit" name="by_prac_id" id="by_prac_id" value="Search by Prac ID" class="button"></td>
						
				</tr>					
			</table>				
		</form>
		
		<?php
			if(isset($_POST['by_prac_id'])){ //check if form was submitted
				$input_id = ltrim($_POST['prac_id']); //get input text
				//echo $input_id;
				
				// Display All Patient Records
				echo "<br/><b>Patient Records Found:</b><br/>";
				$sql_select_patient_record = "SELECT * FROM Practitioner AS A INNER JOIN Patient AS B ON A.prac_id = B.prac_id WHERE A.prac_id = '".$input_id."'";
				$sql_display_patient_record = odbc_exec($conn, $sql_select_patient_record);
				?>
				
				
				<table class="event_table">
					<tr>
						<td><b><u>Patient Id</u></b></td>
						<td><b><u>Practioner ID</u></b></td>
						<td><b><u>First Name</u></b></td>
						<td><b><u>Last Name</u></b></td>
						<td><b><u>DOB</u></b></td>
						<td><b><u>Room No.</u></b></td>
						<td><b><u>Status</u></b></td>
						<td><b><u>Address</u></b></td>
						<td><b><u>Contact</u></b></td>
	
					</tr>
				<?php
					
					while($row = odbc_fetch_array($sql_display_patient_record)) {
					
				?>
					<tr>
						<td><?php echo $row["patient_id"]; ?></td>
						<td><?php echo $row["prac_id"]; ?></td>
						<td><?php echo $row["patient_first_name"]; ?></td>
						<td><?php echo $row["patient_last_name"]; ?></td>
						<td><?php echo date("d-m-Y", strtotime($row["dob"])); ?></td>
						<td><?php echo $row["room"]; ?></td>
						<td><?php echo $row["status"]; ?></td>
						<td><?php echo $row["address"]; ?></td>
						<td><?php echo $row["contact"]; ?></td>
						<td><a href="edit-patient-process.php?patient_id=<?php echo $row["patient_id"]; ?>">Edit</a></td>
					
						<td><a href="patient_profile.php?patient_id=<?php echo $row["patient_id"]; ?>">View Profile</a></td>	
					</tr>
				<?php
					
					}
				?>
				</table>
		<?php
			}		 
	?>
		
		
			<form name="search_status" method="post">			
			<table class="form_center" id="search_status" style="float:center">
				<tr>
					<th colspan="2"><br><b>Search By Admission Status</b></th>
				</tr>
				
				<tr>
					<td style="text-align: right">Admission Status:</td>
					<td>
					<input list="status_list" name="adm_status"/>
							<datalist id="status_list">
								<option value="Admitted">
								<option value="Discharged">
								<option value="Deceased">
							</datalist>
					</td>
				
					<td style="text-align: right"><input type="submit" name="by_status" id="by_status" value="Search by Status" class="button"></td>
						
				</tr>					
			</table>				
		</form>
		
		<?php
			if(isset($_POST['by_status'])){ //check if form was submitted
				$input_id = $_POST['adm_status']; //get input text
				//echo $input_id;
				
				// Display All Patient Records
				echo "<br/><b>Patient Records Found:</b><br/>";
				$sql_select_patient_record = "SELECT * FROM Patient WHERE status='".$input_id."'";
				$sql_display_patient_record = odbc_exec($conn, $sql_select_patient_record);
				?>
				
				
				<table class="event_table">
					<tr>
						<td><b><u>Patient Id</u></b></td>
						<td><b><u>Practioner ID</u></b></td>
						<td><b><u>First Name</u></b></td>
						<td><b><u>Last Name</u></b></td>
						<td><b><u>DOB</u></b></td>
						<td><b><u>Room No.</u></b></td>
						<td><b><u>Status</u></b></td>
						<td><b><u>Address</u></b></td>
						<td><b><u>Contact</u></b></td>
	
					</tr>
				<?php
					
					while($row = odbc_fetch_array($sql_display_patient_record)) {
					
				?>
					<tr>
						<td><?php echo $row["patient_id"]; ?></td>
						<td><?php echo $row["prac_id"]; ?></td>
						<td><?php echo $row["patient_first_name"]; ?></td>
						<td><?php echo $row["patient_last_name"]; ?></td>
						<td><?php echo date("d-m-Y", strtotime($row["dob"])); ?></td>
						<td><?php echo $row["room"]; ?></td>
						<td><?php echo $row["status"]; ?></td>
						<td><?php echo $row["address"]; ?></td>
						<td><?php echo $row["contact"]; ?></td>
						<td><a href="edit-patient-process.php?patient_id=<?php echo $row["patient_id"]; ?>">Edit</a></td>
						
						<td><a href="patient_profile.php?patient_id=<?php echo $row["patient_id"]; ?>">View Profile</a></td>	
					</tr>
				<?php
					
					}
				?>
				</table>
		<?php
			}		 
	?>	
		
		
		
		
		</div>
    </article>
  </section>
  


  <footer class="secondary_header footer">
    <div class="copyright">&copy;2020 - <strong>Stella Lau Shu Neng</strong></div>
  </footer>
	</div>
</body>
</html>