<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Practioner Main Page</title>
	<link href="css/StyleSheet.css" rel="stylesheet" type="text/css">
	<script src ="library/moment/moment.min.js"></script>

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
				
			//Get prac_id from session
			//echo $_SESSION["prac_login"];
			$session_prac_id = $_SESSION["prac_login"];
			echo "<br/><b>Medication Round Performance of last 7 days</b><br/>";
			// Gets count of patients see each day for med round each day from DB
			$sql_count_daily_med_patient = "SELECT administer_date, COUNT(patient_id) As Counts
											FROM Medication
											WHERE prac_id = '".$session_prac_id."' 
											AND datevalue([administer_date]) >= Date() - 7 
											AND datevalue([administer_date]) <= Date()
											Group by administer_date;";
		
			$sql_count_daily_med_patient = odbc_exec($conn, $sql_count_daily_med_patient);
			while($row = odbc_fetch_array($sql_count_daily_med_patient)){
				$patient_count[] = $row["Counts"]; // Sores count of patients seen for Medication round each day
				$round_date[] = $row["administer_date"] ; // stores dates
			}

			
			$a = 0;
			
			?>
				<table class="performance_table">
					
					<tr>
						<td><b>Date</b></td>
						<td><b>Total Patients Seen</b></td>
					
					</tr>
					
			<?php foreach ($round_date as $x ){ ?>  
					<tr>
						<td><?php echo $round_date[$a]; ?></td>
					
						<td><?php echo $patient_count[$a]; ?></td>
					</tr>
	
				
				<?php 
				$a++;
			
			}?>
		</table>

			
		<?php	
		echo "<br/><b>Select Type of Report to View</b><br/>";
		?>
		<form name="view_report" method="post">			
			<table class="form_center" id="view_reports" style="float:center">
				
				<tr>
					<td style="text-align: right">View Type:</td>
					<td>
					<input list="view_list" name="view_type"/>
							<datalist id="view_list">
								<option value="All Patients">
								<option value="My Patients">
							</datalist>
					</td>
				</tr>
				
				<tr>
					<td style="text-align: right">Report Type:</td>
					<td>
					<input list="report_list" name="report_type"/>
							<datalist id="report_list">
								<option value="Medication">
								<option value="Diet">
							</datalist>
					</td>
				</tr>
				
				<tr>
					<td style="text-align: right">Past/Present View:</td>
					<td>
					<input list="past_present_list" name="report_time"/>
							<datalist id="past_present_list">
								<option value="Past 7 Days">
								<option value="Next 7 Days">
							</datalist>
					</td>
				</tr>
				
				<tr>
					<td></td>
					<td style="text-align: right"><input type="submit" name="view_report_selected" id="view_report_selected" value="View Report" class="button"></td>
				</tr>	
									
			</table>				
		</form>
		
		<?php
		if(isset($_POST['view_report_selected'])){ //check if form was submitted

			$input_view_type = $_POST['view_type'];
			$input_report_type = $_POST['report_type'];
			$input_report_time = $_POST['report_time'];
			
			//echo "View Type is:".$input_view_type;
			//echo "<br>View Report Type is: ".$input_report_type;
			//echo "<br>View Report Timing is: ".$input_report_time;
			
			if($input_report_time == "Past 7 Days"){
				
				if($input_view_type == "My Patients"){
				$sql_select_report =  "SELECT * FROM ".$input_report_type." AS A INNER JOIN Patient AS B ON A.patient_id = B.patient_id WHERE (A.prac_id = '".$session_prac_id."') AND (datevalue([administer_date]) >= Date() - 7) AND (datevalue([administer_date]) <= Date())";
				$sql_display_report = odbc_exec($conn, $sql_select_report);
				
				}else{

					$sql_select_report = "SELECT * FROM ".$input_report_type." AS A INNER JOIN Patient AS B ON A.patient_id = B.patient_id WHERE datevalue([administer_date]) >= Date() - 7 AND datevalue([administer_date]) <= Date()";
					$sql_display_report = odbc_exec($conn, $sql_select_report);

					echo "<br>SELECT * FROM ".$input_report_type." AS A INNER JOIN Patient AS B ON A.patient_id = B.patient_id";		
				}
				
			}else{
				if($input_view_type == "My Patients"){
				
				//$selected_view_type = $session_prac_id;
				$sql_select_report =  "SELECT * FROM ".$input_report_type." AS A INNER JOIN Patient AS B ON A.patient_id = B.patient_id WHERE (A.prac_id = '".$session_prac_id."' AND datevalue([administer_date])<= Date() + 7 )";
				$sql_display_report = odbc_exec($conn, $sql_select_report);
				
				}else{

					$sql_select_report = "SELECT * FROM ".$input_report_type." AS A INNER JOIN Patient AS B ON A.patient_id = B.patient_id WHERE datevalue([administer_date])<= Date() + 7 ";
					$sql_display_report = odbc_exec($conn, $sql_select_report);

					//echo "<br>SELECT * FROM ".$input_report_type." AS A INNER JOIN Patient AS B ON A.patient_id = B.patient_id";		
				}
				
			}
			
		}
			
?>
		
		
		
			<?php
			if($input_report_type == "Medication"){
			?>
				<table class="event_table">
					<tr>
						<td><b><u>Practioner ID</u></b></td>
						<td><b><u>Patient Id</u></b></td>
						<td><b><u>First Name</u></b></td>
						<td><b><u>Last Name</u></b></td>
						<td><b><u>Admission Status</u></b></td>
						<td><b><u>Room No.</u></b></td>
						<td><b><u>Medication Name</u></b></td>
						<td><b><u>Dosage</u></b></td>
						<td><b><u>Route </u></b></td>
						<td><b><u>Date Administered</u></b></td>
						<td><b><u>Round</u></b></td>
						<td><b><u>Round Status</u></b></td>
	
					</tr>
					
					<?php
				
					while($row = odbc_fetch_array($sql_display_report)) {
					
				?>
					<tr>
						<td><?php echo $row["prac_id"]; ?></td>
						<td><?php echo $row["patient_id"]; ?></td>
						<td><?php echo $row["patient_first_name"]; ?></td>
						<td><?php echo $row["patient_last_name"]; ?></td>
						<td><?php echo $row["status"]; ?></td>
						<td><?php echo $row["room"]; ?></td>
						<td><?php echo $row["med_name"]; ?></td>
						<td><?php echo $row["dosage"]; ?></td>
						<td><?php echo $row["route_of_administration"]; ?></td>
						<td><?php echo date("d/m/Y", strtotime($row["administer_date"])) ; ?></td>
						<td><?php echo $row["round"]; ?></td>
						<td><?php echo $row["round_status"]; ?></td>	
					</tr>
				<?php
				
					}
				?>
				</table>
				
		
			<?php
			}else if ($input_report_type == "Diet"){
			?>
				<table class="event_table">
					<tr>
						<td><b><u>Practioner ID</u></b></td>
						<td><b><u>Patient Id</u></b></td>
						<td><b><u>First Name</u></b></td>
						<td><b><u>Last Name</u></b></td>
						<td><b><u>Admission Status</u></b></td>
						<td><b><u>Room No.</u></b></td>
						<td><b><u>Diet/Exercise</u></b></td>
						<td><b><u>Dosage</u></b></td>
						<td><b><u>Round</u></b></td>
						<td><b><u>Round Status</u></b></td>
	
					</tr>
					
					<?php
					
					while($row = odbc_fetch_array($sql_display_report)) {
					
				?>
					<tr>
						<td><?php echo $row["prac_id"]; ?></td>
						<td><?php echo $row["patient_id"]; ?></td>
						<td><?php echo $row["patient_first_name"]; ?></td>
						<td><?php echo $row["patient_last_name"]; ?></td>
						<td><?php echo $row["status"]; ?></td>
						<td><?php echo $row["room"]; ?></td>
						<td><?php echo $row["diet_exercise"]; ?></td>
						<td><?php echo date("d/m/Y", strtotime($row["administer_date"])) ; ?></td>
						<td><?php echo $row["diet_exercise_round"]; ?></td>
						<td><?php echo $row["diet_exercise_status"]; ?></td>	
					</tr>
				<?php
					
					}
				?>
				</table>
		<?php
			}
			?>
			

	
				
    </article>
  </section>
  


  <footer class="secondary_header footer">
    <div class="copyright">&copy;2020 - <strong>Stella Lau Shu Neng</strong></div>
  </footer>
	</div>
</body>
</html>