<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update Evening Diet/Exercise Round</title>
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
		
			?>
		
		<?php
				
				//echo $_GET['patient_id'];
				$captured_patient_id = ltrim($_GET['patient_id']);// ltrim to remove whitespace in front of variable
				//echo $captured_patient_id;
				
				
				// Get curret date
				$currentDate = date('d/m/Y');
				//echo $currentDate;
				
				?>	
		
				<form id="update_diet_round_record" name="update_diet_round_record"  method= "post" action="update_diet_round_record.php"> 
					<table class="edit_round_center">
						
						<th> No. </th>
						<th> Exercise/Diet </th>
						<th> Status </th>
						<tr>
							
						<?php 
	
							$get_diet_rec= "SELECT * FROM Diet WHERE (patient_id = '".$captured_patient_id."')  AND (diet_exercise_round = 'evening') AND (administer_date = '".$currentDate."')";
							$sql_display_diet_rec = odbc_exec($conn, $get_diet_rec);
						
							
							$num_diet = 0;
							while($row = odbc_fetch_array($sql_display_diet_rec)){
								$num_diet++;
								$patient_id = $row['patient_id'];
								$prac_id = $row['prac_id'];
								$diet_round = $row['diet_exercise_round'];
								
								
							?>
								<tr>
									
									<input type="hidden" name="num_diet[]" value="<?php echo $num_diet;?>"/>
									<input type="hidden" name="pat_id[]" value="<?php echo $row['patient_id'];?>"/>
									<input type="hidden" name="prac_id[]" value="<?php echo $row['prac_id'];?>"/>
									<input type="hidden" name="diet_name[]" value="<?php echo $row['diet_exercise'];?>"/>
									
									<input type="hidden" name="t_date[]" value="<?php echo $currentDate;?>"/>
									<input type="hidden" name="round[]" value="<?php echo $diet_round;?>"/>
									
									
									<td><?php echo $num_diet; ?></td>
									<td><?php echo $row["diet_exercise"]; ?></td>
							
									<td><input list="round_status_list" name="round_status[]" value ="<?php echo $row['diet_exercise_status']; ?>">
										<datalist id="round_status_list">
											<option value = "Given">
											<option value = "Fasting">
											<option value = "Refused">
											<option value = "Ceased">
											<option value = "Prescribed">
										</datalist>
										</select>
									</td>
									
								</tr>
							
							<?php		
							}

							?>
						</tr>
					</table> 
					<input type='submit' name='update_diet_round_record[]' id='update_diet_round_record' Value='Update' class="add_round_record"/>
				
				</form>
		
		
			
    </article>
  </section>
  
  <footer class="secondary_header footer">
    <div class="copyright">&copy;2020 - <strong>Stella Lau Shu Neng</strong></div>
  </footer>
	</div>
</body>
</html>