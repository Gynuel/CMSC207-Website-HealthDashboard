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

	$_SESSION["Active_Time"] = time(); 	              // Update session time when going back to this page.
?>
<body>
<div class="wrapper">
<!-------------------------- PROGRESS BAR -------------------------->
<a href="Exit Survey.php" style="text-decoration:none"><button type="button" class="btn_exit"><span class="icon">Exit Survey <ion-icon name="close-circle-outline"></ion-icon></span></button></a>
	<br>
    <br>
	<div class="header">
		<ul>
			<li class="form_1_progessbar">
				<div>
					<p>1</p>
				</div>
			</li>
			<li class="form_2_progessbar">
				<div>
					<p>2</p>
				</div>
			</li>
			<li class="active form_3_progessbar">
				<div>
					<p>3</p>
				</div>
			</li>
		</ul>
	</div>
	<div class="form_wrap">
		<div class="form_3 data_info">
			<h2>Overall Satisfaction and Comments</h2>
			<form action="Survey_P3.php" method="post">
<!----------------------- FORM TO DB CONNECTION ---------------------->
            <?php
            // Check if the "Done" button is clicked
            if (isset($_POST["page_3_done"])) {

                // Initialize variables
                $Satisfaction = $_POST["overall_satisfaction"];
                $comments = $_POST["comments"];
                $errors = array();
                
                $survey = $_SESSION["survey"];
                $respondent = $_SESSION["respondent"];

                // Apply validation rules
                if (empty($Satisfaction)) {
                    array_push($errors,"Fields with * are required!");                   // Required fields
                   }

                if (count($errors)>0) { 
                    foreach ($errors as  $error) {
                        echo "<div class='alert alert-danger'>$error</div>";            // Show error prompt
                    }
                }else{                            
                    require_once "database.php";                                        // Connect to database
                    $result = mysqli_query($conn, "SELECT NOW() AS cur_date;");    
                    $current_date = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    
                    $sql_exe = "UPDATE form1_survey SET overall_rating = '$Satisfaction',
                    comments = '$comments',
                    surveycomplete ='1',
                    completion_date = '$current_date[cur_date]'
                    WHERE service_code = '$survey[service_code]';";
                    
                    $result = mysqli_prepare($conn, $sql_exe); 
                    mysqli_execute($result);

                    session_start();
                    $_SESSION["Active_Time"] = time();
                    $_SESSION["respondent"] = $user;
                    // Execute to retrieve the last data of the this transaction
                    $sql = "SELECT * FROM form1_survey WHERE service_code = '$survey[service_code]';";
                    $result = mysqli_query($conn, $sql);
                    $survey = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $_SESSION["survey"] = $survey;
                    
                    echo '<script type="text/javascript">alert("Your submission was successful! Thank you for your feedback."); window.location.href = "Exit Survey.php";</script>';
                    die(); 
                }    
                    
            }
            ?>
<!---------------------------- FORM FIELDS --------------------------->
				<div class="form_container">
					<div class="input_wrap">
                        <div class="overall">
						    <label for="overall_satisfaction">C<sup>*</sup>. Overall, how would you rate the quality of service provided by the service provider?</label>
						    <div class="rating">
                                <input type="number" name="overall_satisfaction" class="input" id="overall_satisfaction"hidden>
                                <i class="bx bx-star star"style="--i: 0;"></i>
                                <i class="bx bx-star star"style="--i: 1;"></i>
                                <i class="bx bx-star star"style="--i: 2;"></i>
                                <i class="bx bx-star star"style="--i: 3;"></i>
                                <i class="bx bx-star star"style="--i: 4;"></i>
                                <i class="bx bx-star star"style="--i: 5;"></i>
                                <i class="bx bx-star star"style="--i: 6;"></i>
					        </div>
                        </div>
                    </div>
					<div class="input_wrap">
						<label for="comments">D. For comments, recommendations, concerns, or aspects of our service/s that needs improvement, please comment it below.
                            If you wish for us to respond to respond to your feedback, please include your contact details.</label>
                        <textarea name="comments" id="comments" class="input" row="50" placeholder="What do you think about our service?"></textarea>
					</div>
				</div>
                <br>
                <div class="btns_wrap">
		            <div class="common_btns form_3_btns">
                        <a href="javascript:history.back(1)" style="text-decoration:none"><button type="button" class="btn_back"><span class="icon"><ion-icon name="arrow-back-sharp"></ion-icon></span>Back</button></a>
			            <button type="button" class="btn_done">Done</button>
		            </div>
                </div>
                <div class="modal_wrapper">
	                <div class="shadow"></div>
	                    <div class="success_wrap">
		                    <span class="modal_icon"><ion-icon name="help-circle"></ion-icon></span>
                            <p><center>Are you happy with your choices?<br>Click "Submit" when ready.</center></p>
                            <button type="submit" class="btn_done" name="page_3_done">Submit</button>
	                    </div>
                    </div>
                </div>
			</form>
    </div>
</div>
<script type="text/javascript" src="Star.js"></script>
<script type="text/javascript" src="Submit Survey.js"></script>
</body>
</html>
