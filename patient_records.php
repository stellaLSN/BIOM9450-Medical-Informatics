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
				
				
				<?php
				//session_start();
				// establish db connection
				$conn=odbc_connect('z5275703','','',SQL_CUR_USE_ODBC);
				
				// Get prac_id from session
				//echo $_SESSION["prac_login"];
				//$session_prac_id = $_SESSION["prac_login"];
				
				// Display All Patient Records
				echo "<br/><b>Patient Records Database</b><br/><br/>";
				$sql_select_patient_record = "SELECT * FROM Patient";
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
						<td><b><u>Email</u></b></td>
						<td><b><u>Address</u></b></td>
						<td><b><u>Contact</u></b></td>
	
					</tr>
				<?php
					$i=0;
					while($row = odbc_fetch_array($sql_display_patient_record)) {
					if($i%2==0)
					$classname="even";
					else
					$classname="odd";
				?>
					<tr class="<?php if(isset($classname)) echo $classname;?>">
						<td><?php echo $row["patient_id"]; ?></td>
						<td><?php echo $row["prac_id"]; ?></td>
						<td><?php echo $row["patient_first_name"]; ?></td>
						<td><?php echo $row["patient_last_name"]; ?></td>
						<td><?php echo date("d-m-Y", strtotime($row["dob"])); ?></td>
						<td><?php echo $row["room"]; ?></td>
						<td><?php echo $row["status"]; ?></td>
						<td><?php echo $row["email"]; ?></td>
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
    </article>
  </section>
  


  <footer class="secondary_header footer">
    <div class="copyright">&copy;2020 - <strong>Stella Lau Shu Neng</strong></div>
  </footer>
	</div>
</body>
</html>