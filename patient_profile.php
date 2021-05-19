<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Patient Profile Page</title>
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
		
		
				$stmt = ("SELECT * FROM Patient WHERE patient_id = '".$captured_patient_id."';");
				mysql_query($stmt);
				if ($error = odbc_error()) die('Error, insert query failed with:' . $error);
				$get_patient_record = odbc_exec($conn, $stmt);	
				
				// Fetching each row of data from db for display
				while ($row = odbc_fetch_array($get_patient_record)){
					echo "<table class='profile_center'>";
					
					
					echo "<tr><td><img src= 'images/".$row ['patient_id'].".jpg' width='120' height='150'/></td></tr>" ;
					
					echo "<tr><td> Patient Name: ". $row ['patient_first_name']. " ". $row ['patient_last_name']."</td></tr>" ;
					
					echo "<tr><td> Patient ID: ". $row ['patient_id']."</td></tr>" ;
					
					echo "<tr><td> Practioner ID: ". $row ['prac_id']."</td></tr>" ;
					
					echo "<tr><td> Room Number: ". $row ['room']."</td></tr>" ;
					
					echo "<tr><td> Status: ". $row ['status']."</td></tr>" ;
					
					echo "<tr><td> Date of Birth: ". $row ['dob']."</td></tr>" ;
					
					echo "<tr><td> Email: ". $row ['email']."</td></tr>" ;
					
					echo "<tr><td> Address: ". $row ['address']."</td></tr>" ;
					
					echo "<tr><td> Contact: ". $row ['contact']."</td></tr>" ;
					
					echo "</table>";
					
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