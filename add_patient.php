<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Patient Records Database</title>
	<link href="css/StyleSheet.css" rel="stylesheet" type="text/css">

	<script type = "text/javascript">
		// Moment.js is included to do date/time validation for DOB
	
         //<!--
		 // This function validates Email		 
		 function ValidateEmail(){
			 // gets the email input
			 var val_email = document.getElementById('input_email').value;
			 var email_format = /^\w+([\._-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
			 // Before the‘@’you can have any number of a-z,A-Z,0-9,‘.’,‘_’,or‘-’
		 	// After the‘@’you can have any number of a-z,A-Z,0-9,‘.’,or‘-’
		 	// At the end you can have a‘.’followed by between 2 and 4 characters from a-z or A-Z
			 
			 if(val_email.match(email_format) || val_email == '' ){
				 document.getElementById("email_error").innerHTML = "<span style='color: green'>No Error </span>";
				 return true;
			 }else{
				document.getElementById("email_error").innerHTML = "<span style='color: red'>Invalid Email </span>";
				return false; 
			 }
		 }

		 	
		 // This function validates First Name
		 function ValidateFirstName(){
			 // gets the first name input
			 var input_FN = document.getElementById('patient_first_name').value;
			 var FN_format = /^[a-zA-Z '-]+$/;  // First name should contain only letters, apostrophes, spaces and hyphens
			 
			 if(input_FN.match(FN_format)){
				 document.getElementById("first_name_error").innerHTML = "<span style='color: green'>No Error </span>";
				 return true;
			 }else{
				document.getElementById("first_name_error").innerHTML = "<span style='color: red'>First name should contain only letters, apostrophes, spaces and hyphens</span>";
				return false; 
			 }	
		}

		 // This function validates Last Name
		 function ValidateLastName(){
			 // gets the last name input
			 var input_LN = document.getElementById('patient_last_name').value;
			 var FN_format = /^[a-zA-Z '-]+$/; // Last name should contain only letters, apostrophes, spaces and hyphens
			 
			 if(input_LN.match(FN_format)){
				 document.getElementById("last_name_error").innerHTML = "<span style='color: green'>No Error </span>";
				 return true;
			 }else{
				document.getElementById("last_name_error").innerHTML = "<span style='color: red'>Last name should contain only letters, apostrophes, spaces and hyphens</span>";
				return false; 
			 }	
		}
		
		 // This function validates Contact Number
		 function ValidateContact(){
			 // gets the last name input
			 var input_LN = document.getElementById('contact').value;
			 var FN_format = /^\d{10}$/; // Contact number should only contain 10 digits
			 
			 if(input_LN.match(FN_format)){
				 document.getElementById("contact_error").innerHTML = "<span style='color: green'>No Error </span>";
				 return true;
			 }else{
				document.getElementById("contact_error").innerHTML = "<span style='color: red'>Contact should contain 10 Digits only</span>";
				return false; 
			 }	
		}
		
		// This function validates DOB
		// Entered as text in the format ‘dd/mm/yyyy’
		// Checking that day, month and year is not a future date, or several hundred years ago
		// Allow only Year starting with 19 or 20 (So that dob is not a date too far away)
		function ValidateDOB(){
			 var input_dob = document.getElementById('dob').value;
			 var DOB_format = /^(\d{1,2})\/(\d{1,2})\/(\d{4})$/;; // Contact number should only contain 10 digits
			 
			 if(input_dob.match(DOB_format)){
				 document.getElementById("dob_error").innerHTML = "<span style='color: green'>No Error </span>";
				 return true;
			 }else{
				document.getElementById("dob_error").innerHTML = "<span style='color: red'>Wrong DOB format</span>";
				return false; 
			 }
				
		}
		
		function validInfo(){
			// This functions checks all inputs in the form for any error, before submiting form.
				if(
					ValidateEmail() == false || // checks if email is valid
					ValidateFirstName() == false || // checks if first name is valid
					ValidateLastName() == false || // checks if last name is valid
					ValidateDOB() == false // check if dob is valid
				){
					
					alert('Please ensure details are entered correctly.') // alert pops up informing user to check inputs again
					return false; // returns to form
					
					
					}else{
						return true;
						window.location.href = "add_patient_db.php"; // since all fields are valid, proceed to check for duplicate record before adding to db
						
					}
				
			}

         //-->
	</script>

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
		<form action="add_patient_db.php" name="update_patient_form" method="post" onSubmit="validInfo()" enctype='multipart/form-data'>
					
			<input type="hidden" name="prac_id" class="txtField" value= " ">
				
				<table class="form_center" id="patient_add">
					<tr>
						<th colspan="2"><b>Add New Patient</b></th>
					</tr>
					<tr>
						<td style="text-align: right">Patient ID:</td>
						<td><input type="text" name="patient_id" value="<Enter Patient ID>"/></td>
					</tr>
					
					<tr>
						<td style="text-align: right">First Name:</td>
						<td>
						<input type="text" name="patient_first_name" id="patient_first_name" maxlength="30" value="<Enter First Name>" onChange="ValidateFirstName();"/></td>
						<td>
							<span id="first_name_error"></span>
						</td>
						
					</tr>
					
					
					<tr>
						<td style="text-align: right">Last Name:</td>
						<td><input type="text" name="patient_last_name" id="patient_last_name" maxlength="30" value="<Enter Last Name>" onChange="ValidateLastName()"/></td>
						<td>
							<span id="last_name_error"></span>
						</td>
					</tr>
					
					<tr>
						<td style="text-align: right">DOB(dd/mm/yyyy):</td>
						<td><input type="text" id="dob" name="dob" value="<Enter DOB>" onChange="ValidateDOB()"/></td>
						<td>
							<span id="dob_error"></span>
						</td>
					
					</tr>
					
					<tr>
						<td style="text-align: right">Room:</td>
						<td><input type="text" name="room" value="<Enter Room>"/></td>
					</tr>
					
					<tr>
						<td style="text-align: right">Status:</td>
						<td>
							<input list="status_list" name="status" value="<Select One>"/>
							<datalist id="status_list">
								<option value="Admitted">
								<option value="Discharged">
								<option value="Deceased">
							</datalist>
						</td>
					</tr>
					
					<tr>
						<td style="text-align: right">Email:</td>
						<td><input type="text" name="input_email" id="input_email" value="<Enter Email>" onChange="ValidateEmail()"/></td>
						<td>
							<span id="email_error"></span>
						</td>
					</tr>

					<tr>
						<td style="text-align: right">Address:</td>
						<td><input type="text" name="address" value="<Enter Address>"/></td>
					</tr>
					
					<tr>
						<td style="text-align: right">Contact:</td>
						<td><input type="text" id="contact" name="contact" value="<Enter Contact>" onChange="ValidateContact()"/></td>
						<td>
							<span id="contact_error"></span>
						</td>
					</tr>
					
					<tr>
						<td style="text-align: right">Upload photo:</td>
						<td><input type="file" name="fileToUpload" id="fileToUpload"></td>
					
					</tr>
					
					<tr>
						<td></td>
						<td style="text-align: right"><input type="submit" name="add" id="add" value="Add" class="button"></td>
						
					</tr>
					
					
					
				</table>
					
			</form>

		
    </article>
  </section>
  


  <footer class="secondary_header footer">
    <div class="copyright">&copy;2020 - <strong>Stella Lau Shu Neng</strong></div>
  </footer>
	</div>
</body>
</html>