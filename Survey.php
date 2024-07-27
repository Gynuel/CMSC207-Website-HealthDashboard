<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href = "Survey.css">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'> <!---This is a CSS online for the buttons and icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <title>Survey Form</title>
</head>
<!--------------------- START PAGE SESSIONING ---------------------->
<?php
    session_start();

    if(empty($_SESSION["survey"])){
        header("Location: index.php");
    }
    if((time()-$_SESSION["Active_Time"]) > 7200 ){     // Logout after 2hours or 7200 seconds of inactivity in this page.
        header("Location: index.php");
    }

    $_SESSION["Active_Time"] = time();                // Update session time when going back to this page.
?>
<body>
<div class="wrapper">
<!-------------------------- PROGRESS BAR -------------------------->
<a href="Exit Survey.php" style="text-decoration:none"><button type="button" class="btn_exit"><span class="icon">Exit Survey <ion-icon name="close-circle-outline"></ion-icon></span></button></a>
	<br>
    <br>
    <div class="header">
		<ul>
			<li class="active form_1_progessbar">
				<div>
					<p>1</p>
				</div>
			</li>
			<li class="form_2_progessbar">
				<div>
					<p>2</p>
				</div>
			</li>
			<li class="form_3_progessbar">
				<div>
					<p>3</p>
				</div>
			</li>
		</ul>
	</div>
	<div class="form_wrap">
		<div class="form_1 data_info">
			<h2>Client Info</h2>
			<form action="Survey.php" method="post">
<!----------------------- FORM TO DB CONNECTION ---------------------->
            <?php
            // Check if the "Next" button is clicked
            if (isset($_POST["page_1_next"])) {

                // Initialize variables
                $FullName = $_POST["full_name"];
                $Email = $_POST["email"];
                $Gender = $_POST["gender"];
                $Birthday = $_POST["birthday"];
                $DOHEmployee = $_POST["doh_employee"];
                $Provider = $_POST["staff_name"];
                $errors = array();
                
                $survey = $_SESSION["survey"];
        
                // Apply validation rules
                if (empty($Email) OR empty($Gender) OR empty($Birthday) OR empty($DOHEmployee)) {
                    array_push($errors,"Fields with * are required!");                   // Required fields
                   }

                if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Email is not valid!");                          // Valid emails
                   }     
                
                   // Check if there are errors. If none, proceed with inserting/updating a row in the respective tables
                if (count($errors)>0) { 
                    foreach ($errors as  $error) {
                        echo "<div class='alert alert-danger'>$error</div>";            // Show error prompt
                    }
                    }else{           
                        require_once "database.php";                                    // Connect to database
                        // Check first if Survey is form an existing client based on their email.
                        $sql = "SELECT * FROM client WHERE email = '$Email'";
                        $result = mysqli_query($conn, $sql);
                        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

                        if ($user) {    // Existing User. 
                                        // Are the credentials different? If Yes, update existing records first, then update the entry in the form1_survey table.
                            if(($user["name"]!= $FullName OR $user["gender"]!= $Gender OR  $user["birthday"]!= $Birthday OR $user["doh_employee"]!= $DOHEmployee) AND $user["email"] == $Email){
                                $sql_exe = "UPDATE client SET name = '$FullName', gender = '$Gender', birthday = '$Birthday', doh_employee = '$DOHEmployee' WHERE email = '$Email';";
                                $result = mysqli_prepare($conn, $sql_exe); 
                                mysqli_execute($result);

                                $sql_exe = "UPDATE form1_survey SET client_id = '$user[client_id]', provider_name = '$Provider', iscompletepage_one	= '1' WHERE service_code = '$survey[service_code]';";
                                $result = mysqli_prepare($conn, $sql_exe); 
                                mysqli_execute($result);
                                print_r($sql_exe);

                                session_start();
                                $_SESSION["survey"] = $survey;
                                $_SESSION["Active_Time"] = time();
                                $_SESSION["respondent"] = $user;
                                header("Location: Survey_P2.php");
                                die();

                                }else{   // Are the credentials different? If No, update the entry in the form1_survey table.
                                    $sql_exe = "UPDATE form1_survey SET client_id = '$user[client_id]', provider_name = '$Provider', iscompletepage_one	= '1' WHERE service_code = '$survey[service_code]';";
                                    $result = mysqli_prepare($conn, $sql_exe); 
                                    mysqli_execute($result);

                                    session_start();
                                    $_SESSION["survey"] = $survey;
                                    $_SESSION["Active_Time"] = time();
                                    $_SESSION["respondent"] = $user;
                                    header("Location: Survey_P2.php");
                                    die();
                            }
                            }else{      // New User.
                                        // Create a new entry in the client table
                                $sql = "INSERT INTO client (name, email, gender, birthday, doh_employee) VALUES (?, ?, ?, ?, ?)";
                                $stmt = mysqli_stmt_init($conn);
                                $prepareStmt = mysqli_stmt_prepare($stmt,$sql);

                                if ($prepareStmt) {
                                    mysqli_stmt_bind_param($stmt,"sssss", $FullName, $Email, $Gender, $Birthday, $DOHEmployee);
                                    mysqli_stmt_execute($stmt);

                                    }else{
                                        die("Something went wrong");
                                    }
                                    //  Fetch the row of the newly created user
                                    $sql = "SELECT * FROM client WHERE email = '$Email'";
                                    $result = mysqli_query($conn, $sql);
                                    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                    
                                    // Update the form1_survey table
                                    $sql_exe = "UPDATE form1_survey SET client_id = '$user[client_id]', provider_name = '$Provider', iscompletepage_one	= '1' WHERE service_code = '$survey[service_code]';";
                                    $result = mysqli_prepare($conn, $sql_exe); 
                                    mysqli_execute($result);
        
                                    session_start();
                                    $_SESSION["survey"] = $survey;
                                    $_SESSION["Active_Time"] = time();
                                    $_SESSION["respondent"] = $user;
                                    header("Location: Survey_P2.php");
                                    die();
                            }


                    }  
            }
            ?>
<!---------------------------- FORM FIELDS --------------------------->
				<div class="form_container">
					<div class="input_wrap">
						<label for="full_name">Full Name</label>
						<input type="text" name="full_name" class="input" id="full_name">
					</div>
                    <div class="input_wrap">
						<label for="email">Email Address<sup>*</sup></label>
						<input type="email" name="email" class="input" id="email">
					</div>
					<div class="input_wrap">
						<label for="gender">Gender<sup>*</sup></label>
                        <select name="gender" id="gender" class="input">
                            <option value="none" selected disabled hidden>Select</option> 
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="others">Others</option>
                        </select>
					</div>
                    <div class="input_wrap">
						<label for="birthday">Birth Date<sup>*</sup></label>
						<input type="date" name="birthday" class="input" id="birthday">
					</div>
					<div class="input_wrap">
						<label for="doh_employee">Are you a DOH employee?<sup>*</sup></label>
                        <select name="doh_employee" id="doh_employee" class="input">
                            <option value="none" selected disabled hidden>Select</option> 
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
					</div>
                    <br>
                    <br>
                    <h2>Service Info</h2>
                    <?php // Connect to database to pull default service information
                        require_once "database.php"; 
                        $survey = $_SESSION["survey"];
                        $sql = "SELECT name FROM service_list  WHERE service_id = '$survey[service_id]';";
                        $result = mysqli_query($conn, $sql);
                        $service = mysqli_fetch_array($result, MYSQLI_ASSOC);

                        $sql = "SELECT office FROM provider  WHERE provider_id = '$survey[provider_id]';";
                        $result = mysqli_query($conn, $sql);
                        $staff_office = mysqli_fetch_array($result, MYSQLI_ASSOC);

                        $conn->close();
                    ?>
                    <div class="input_wrap">
						<label for="staff_name">Name of Provider</label>
						<input type="text" name="staff_name" class="input" id="staff_name">
					</div>
                    <div class="input_wrap">
						<label for="staff_office">Office</label>
						<input type="text" name="staff_office"class="input" id="staff_office" value ="<?php echo $staff_office["office"]; ?>" readonly>
					</div>
                    <div class="input_wrap">
						<label for="service_availed">Service Availed</label>
						<input type="text" name="service_availed" class="input" id="service_availed" value = "<?php echo $service["name"]; ?>" readonly> 
					</div>
				</div>
                <br>
                <div class="btns_wrap">
                    <div class="common_btns form_1_btns">
		                <button type="submit" class="btn_next" name="page_1_next">Next <span class="icon"><ion-icon name="arrow-forward-sharp"></ion-icon></span></button>
                    </div>
                </div>
            </form>
		</div>
    </div>
</div>
</body>
</html>
