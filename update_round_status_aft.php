<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update Patient Status on Rounds</title>
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
		  <li><a href= "search_patient.php">Log Out</a></li>
		  
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
				
			//This Chunk of code checks if connection to DB is successful or not
			if (!$conn){
				exit("Connection Failed: " . $conn."<br/>");
			}else{
				echo ("Connection Successful! <br/>");
				echo "<br/>";
			}
			?>
		
		<?php
				
				//echo $_GET['patient_id'];
				$captured_patient_id = ltrim($_GET['patient_id']);// ltrim to remove whitespace in front of variable
				//echo $captured_patient_id;
		
					// Fetching each row of data from db for display
				$row = odbc_fetch_array($get_patient_med_record);
					
				// Get curret date
				$currentDate = date('d/m/Y');
				echo $currentDate;
				
				?>	
		
				<form id="add_med_round_rec" name="add_med_round_rec"  method= "post" action="add_round_rec_db.php"> 
					<table class="edit_round_center">
						
						<th> No. </th>
						<th> Medication Name </th>
						<th> Dosage </th>
						<th> Route of Administration </th>
						<th> Status </th>
						<tr>
							
						<?php 
	
							$get_med_rec= "SELECT * FROM Medication WHERE (patient_id = '".$captured_patient_id."')  AND (round = 'afternoon') AND (administer_date = '".$currentDate."')";
							$sql_display_med_rec = odbc_exec($conn, $get_med_rec);
						
							
							$num_med = 0;
							while($row = odbc_fetch_array($sql_display_med_rec)){
								$num_med++;
								$patient_id = $row['patient_id'];
								$prac_id = $row['prac_id'];
								$med_round = $row['round'];
								$today_date = date('d/m/Y')
								
							?>
								<tr>
									
									<input type="hidden" name="num_med[]" value="<?php echo $num_med;?>"/>
									<input type="hidden" name="pat_id[]" value="<?php echo $row['patient_id'];?>"/>
									<input type="hidden" name="prac_id[]" value="<?php echo $row['prac_id'];?>"/>
									<input type="hidden" name="med_name[]" value="<?php echo $row['med_name'];?>"/>
									<input type="hidden" name="dose[]" value="<?php echo $row['dosage'];?>"/>
									<input type="hidden" name="route[]" value="<?php echo $row['route_of_administration'];?>"/>
									<input type="hidden" name="t_date[]" value="<?php echo $today_date;?>"/>
									<input type="hidden" name="round[]" value="<?php echo $med_round;?>"/>
									
									
									<td><?php echo $num_med; ?></td>
									<td><?php echo $row["med_name"]; ?></td>
									<td><?php echo $row['dosage']; ?></td>
									<td><?php echo $row['route_of_administration']; ?></td>
									<td><input list="round_status_list" name="round_status[]" value ="<?php echo $row['round_status']; ?>">
										<datalist id="round_status_list">
											<option value = "Given">
											<option value = "Fasting">
											<option value = "No Stock">
											<option value = "Ceased">
											<option value = "Refused">
											<option value = "Not Administered">
										</datalist>
										</select>
									</td>
									
								</tr>
							
							<?php		
							}

							?>
						</tr>
					</table> 
					<input type='submit' name='add_round_record[]' id='add_round_record' Value='Update' class="add_round_record"/>
				
				</form>
		
		
			
    </article>
  </section>
  
  <footer class="secondary_header footer">
    <div class="copyright">&copy;2020 - <strong>Stella Lau Shu Neng</strong></div>
  </footer>
	</div>
</body>
</html>