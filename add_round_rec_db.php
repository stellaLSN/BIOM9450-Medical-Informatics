<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Round Record</title>
</head>

<body>
	<?php
		session_start();
		// establish db connection
		$conn=odbc_connect('z5275703','','',SQL_CUR_USE_ODBC);

				
		// Get prac_id from session
		echo $_SESSION["prac_login"];
		$session_prac_id = $_SESSION["prac_login"];
		
	
	// start
		if(isset($_POST["add_round_record"])) {
			
			//echo $_POST['add_round_record'];
			
			$recArray = $_POST['add_round_record']."<br>";
			
			//echo "count".count($_POST['add_round_record']);
			
			$c_num_med = $_POST['num_med'];
			//echo "<br>c_num_med is".count($c_num_med);
			
			$c_pat_id = $_POST['pat_id'];
			///echo "<br>c_pat_id is".count($c_pat_id);
			
			$c_prac_id = $_POST['prac_id'];
			//echo "<br>c_prac_id is".count($c_prac_id);
			
			$c_med_name = $_POST['med_name'];
			//echo "<br>c_m_name is".count($c_med_name);
			
			$c_dose = $_POST['dose'];
			//echo "<br>c_dose is".count($c_dose);
			
			$c_route = $_POST['route'];
			///echo "<br>c_route is".count($c_route);
			
			$c_t_date = $_POST['t_date'];
			//echo "<br>c_t_date is".count($c_t_date);
			
			
			$c_round = $_POST['round'];
			//echo "<br>c_round is".count($c_round);
			
			$c_round_status = $_POST['round_status'];
			echo "<br>c_status is".count($c_round_status);
			
			
			$i = 0;
			
			foreach($c_num_med as $key => $value){
				echo "<br>pat ID: ".$c_pat_id[$i];
				echo "<br>prac ID: ".$c_prac_id[$i];
				echo "<br>med_name: ".$c_med_name[$i];
				echo "<br>dose: ".$c_dose[$i];
				echo "<br>Route: ".$c_route[$i];
				echo "<br>Date: ".$c_t_date[$i];
				echo "<br>Round: ".$c_round[$i];
				echo "<br> Status:".$c_round_status[$i];
				
				$add_p_id = $c_pat_id[$i];
				$add_prac_id = $c_prac_id[$i];
				$add_med_name = $c_med_name[$i];
				$add_dose = $c_dose[$i];
				$add_route = $c_route[$i];
				$add_date = $c_t_date[$i];
				$add_round = $c_round[$i];
				$add_round_status = $c_round_status[$i];
				
				
				if($add_round_status == "Refused"){
					$to = "stella.snlau@gmail.com";
				 	$subject = "Medication  Refused (P.ID:".$add_p_id.")";

				 	$message = "<h1><b>Notice of Medication Refusal</b></h1>";
				 	$message .= "Date : ".$c_t_date;
				 	$message .= "Practitioner ID: ".$add_prac_id;
				 	$message .= "Patient ID: ".$add_p_id;
				 	$message .= "Medication Name: ".$add_med_name;
					$message .= "Dosage: ".$add_dose;
					$message .= "Route of Admnistration: ".$add_route;
					$message .= "Medication Round: ".$add_round;
					
					$headers = 'From: stella.snlau@gmail.com' . "\r\n" . 
							   'Reply-To: stella.snlau@gmail.com' . "\r\n" .
							   'MIME-Version: 1.0' . "\r\n" .
							   'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
							   'X-Mailer: PHP/' . phpversion();


					mail($to,$subject,$message, $headers);
	
					
				}
				
				$sql_add_round_rec = 
				"UPDATE Medication SET round_status ='".$add_round_status."'
				WHERE patient_id='".$add_p_id."'
				AND round='".$add_round."' AND 
				med_name='".$add_med_name."' 
				AND dosage ='".$add_dose."' 
				AND route_of_administration ='".$add_route."' 
				AND administer_date ='".$add_date."'";
	
				$exec_add_round_record = odbc_exec($conn, $sql_add_round_rec);
				
				// If the particular Medication is refused, email would be sent to aged-care facitily director
				
				
				    
				

				$i++;	
				
			}
				
		}
	odbc_close($conn);
			
	?>
		<script type="text/javascript">
			alert("Patient Round Record Updated Successfully!");
			window.location.href = "practitioner_main.php";
		</script>
		
</body>
</html>