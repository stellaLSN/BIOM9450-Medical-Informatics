<!doctype html>

<?php
// Start user session
session_start();
?>

<html>
<head>
<meta charset="utf-8">
<title>Login Check PHP page</title>
</head>

<body>
	
	
	<?php
		// Checking if form data is captured
		//var_dump($_POST); 
	
		// Get form data and store as variables 
		if(isset($_POST['submit_form'])) {
			$input_username = $_POST['input_username']; // Get username from form
			$input_password = $_POST['input_password']; //Get user pw from form
		} 
		
		
		// establish db connection
		$conn=odbc_connect('z5275703','','',SQL_CUR_USE_ODBC);
	
		
	/*
		//This Chunk of code checks if connection to DB is successful or not
		if (!$conn){
			exit("Connection Failed: " . $conn."<br/>");
		}else{
			echo ("Connection Successful! <br/>");
			echo "<br/>";
		}
		*/

		// Check if user already registered
		
		// SQL statement to check if username match email in records in database
		$sql_match_username = "SELECT * FROM Practitioner WHERE email = '$input_username' " ;
	
    	$exec_check_username = odbc_exec($conn, $sql_match_username);
		$username_row_match = (odbc_fetch_row($exec_check_username));
	

		
		// SQL statement to check if password match records in database
		$sql_match_pw = "SELECT * FROM Practitioner WHERE password = '$input_password' " ;
		$exec_check_pw = odbc_exec($conn, $sql_match_pw);
		$pw_row_match = (odbc_fetch_row($exec_check_pw));
		
			
		// Check if Username AND Password match go to prac_page.html
		if($username_row_match > 0 && $pw_row_match > 0){
				
			// Set session variable - Practitioner ID
			$_SESSION["prac_login"] = odbc_result($exec_check_username, "prac_id");
			//echo $_SESSION["prac_login"];
			echo "<script>
			window.location.href='practitioner_main.php';
    		</script>";
    		exit;
			
			
		}else{
			// If username and/or password do not match, show alert, and redirect back to login page
			$message = "Username and/or Password not found!";
			echo "<script>
    		alert('$message'); 
			window.location.href='index.html';
    		</script>";
    		exit;
      	}


		// Close DB connection
  		odbc_close($conn);
		?>
</body>
</html>