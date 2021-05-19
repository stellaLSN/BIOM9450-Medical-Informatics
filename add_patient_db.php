<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	
	<?php
		session_start();
		// establish db connection
		$conn=odbc_connect('z5275703','','',SQL_CUR_USE_ODBC);
		
		// Get prac_id from session
		//echo $_SESSION["prac_login"];
		$session_prac_id = $_SESSION["prac_login"];
		?>
		// Upload Photo code
		<?php
		$target_dir = "images/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// Check if image file is a actual image or fake image
		if(isset($_POST["add"])) {
		  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		  if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		  } else {
			echo "File is not an image.";
			$uploadOk = 0;
		  }
		}

		// Check if file already exists
		if (file_exists($target_file)) {
		  echo "Sorry, file already exists.";
		  $uploadOk = 0;
		}

		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
		  echo "Sorry, your file is too large.";
		  $uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		  $uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		  echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
		  } else {
			echo "Sorry, there was an error uploading your file.";
		  }
		}
		?>
	
		<?php
		// Validation for rest of the form
		if(isset($_POST['add'])){	 
			$patient_id = $_POST['patient_id'];
			$patient_first_name = $_POST['patient_first_name'];
			$patient_last_name = $_POST['patient_last_name'];
			$dob = $_POST['dob'];
			$room = $_POST['room'];
			$status = $_POST['status'];
			$email = $_POST['input_email'];
			$address = $_POST['address'];
			$contact = $_POST['contact'];

			
			//Check for duplicate records START
			
			// SQL statement to check first name + Last name match records in database
			$sql_match_name = "SELECT * FROM Patient WHERE patient_first_name = '$patient_first_name' AND patient_last_name = '".$patient_last_name."'" ;
	
    		$exec_check_name = odbc_exec($conn, $sql_match_name);
			$name_row_match = (odbc_fetch_row($exec_check_name));
			
			// SQL statement to check if DOB match records in database
			$sql_match_dob = "SELECT * FROM Patient WHERE dob = '".$dob."' ";
	
    		$exec_check_dob = odbc_exec($conn, $sql_match_dob);
			$dob_row_match = (odbc_fetch_row($exec_check_dob));
			
			if($name_row_match > 0 && $dob_row_match > 0){
				
			?>
				<script type="text/javascript">
					alert("Patient Record already Exist in Patient Database!");
					window.location.href = "patient_profile.php?patient_id= <?php echo $patient_id ?>";
				</script>
			<?php
				//Check for duplicate records END
			}else{
				$sql_add_new_patient = "INSERT INTO Patient(patient_id, patient_first_name, patient_last_name, dob, email, address, contact, prac_id, room, status) VALUES ('$patient_id', '$patient_first_name', '$patient_last_name', '$dob', '$email', '$address', '$contact', '$session_prac_id', '$room', '$status')";
				
			
				$exec_add_record = odbc_exec($conn, $sql_add_new_patient);
			
				if ($exec_add_record) {
			?>
				<script type="text/javascript">
					alert("Patient Record added Successfully!");
					window.location.href = "patient_profile.php?patient_id= <?php echo $patient_id ?>";
				</script>
			<?php
				echo "New record created successfully!";
			 	} else {
					echo "<br>Error: " . $exec_add_record . " " . odbc_error($conn);
				}
				
			}
			
			
			
			
			
			 	odbc_close($conn);
		}		
	?>
	
</body>
</html>