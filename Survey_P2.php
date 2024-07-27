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

	$_SESSION["Active_Time"] = time(); 	               // Update session time when going back to this page.
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
			<li class="active form_2_progessbar">
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
		<div class="form_2 data_info">
			<h2>Routine Service Form</h2>
			<form action="Survey_P2.php" method="post">
<!----------------------- FORM TO DB CONNECTION ---------------------->
            <?php
            // Check if the "Next" button is clicked
            if (isset($_POST["page_2_next"])) {

                // Initialize variables
                $Expectation = $_POST["overall_expectation"];
                $Q1 = $_POST["Q1"];
                $Q2 = $_POST["Q2"];
                $Q3 = $_POST["Q3"];
                $Q4 = $_POST["Q4"];
                $Q5 = $_POST["Q5"];
                $Q6 = $_POST["Q6"];
                $errors = array();
                
                $survey = $_SESSION["survey"];
                $respondent = $_SESSION["respondent"];

                // Apply validation rules
                if (empty($Expectation) OR empty($Q1) OR empty($Q2) OR empty($Q3) OR empty($Q4) OR empty($Q5) OR empty($Q6)) {
                    array_push($errors,"All fields are required!");                        // Required fields
                   }

                if (count($errors)>0) { 
                    foreach ($errors as  $error) {
                        echo "<div class='alert alert-danger'>$error</div>";            // Show error prompt
                    }
                }else{                                                            
                        require_once "database.php";                                    // Connect to database
                        $sql_exe = "UPDATE form1_survey SET expectation_rating = '$Expectation', 
                        q1_rating = '$Q1', 
                        q2_rating = '$Q2',
                        q3_rating = '$Q3', 
                        q4_rating = '$Q4', 
                        q5_rating = '$Q5',
                        q6_rating = '$Q6',
                        iscompletepage_two = '1'
                        WHERE service_code = '$survey[service_code]';";

                        $result = mysqli_prepare($conn, $sql_exe); 
                        mysqli_execute($result);

                        session_start();
                        $_SESSION["survey"] = $survey;
                        $_SESSION["Active_Time"] = time();
                        $_SESSION["respondent"] = $user;
                        header("Location: Survey_P3.php");
                        die();
                }
            }
            ?>
<!---------------------------- FORM FIELDS --------------------------->
				<div class="form_container">
					<div class="input_wrap">
                        <div class="overall">
    						<label for="overall_expectation">A<sup>*</sup>. How would you rate your overall expectation of the service/s provided?</label>
                            <div class="rating">
                                <input type="number" name="overall_expectation" class="input" id="overall_expectation" required="true" hidden>
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
						<label for="level_perception">B<sup>*</sup>. Please show the extent to which you think the office visited possess the features described by each statement below.</label>
						<br>
                        <table>
                            <tbody>
                                <tr>
                                    <th></th>
                                    <th class="tableh" colspan="2">Strongly Disagree</th>
                                    <th class="tableh" colspan="3"></th>
                                    <th class="tableh" colspan="2">Strongly Agree</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>5</th>
                                    <th>6</th>
                                    <th>7</th>
                                </tr>
                                <tr>
                                    <th class="question"><label>1.The service provider/s provides its service at the time if promises to do so.</th></label>
                                    <td><input type="radio" name="Q1" class="input" id="Q1" value="1"></td>
                                    <td><input type="radio" name="Q1" class="input" id="Q1" value="2"></td>
                                    <td><input type="radio" name="Q1" class="input" id="Q1" value="3"></td>
                                    <td><input type="radio" name="Q1" class="input" id="Q1" value="4"></td>
                                    <td><input type="radio" name="Q1" class="input" id="Q1" value="5"></td>
                                    <td><input type="radio" name="Q1" class="input" id="Q1" value="6"></td>
                                    <td><input type="radio" name="Q1" class="input" id="Q1" value="7"></td>
                                </tr>
                                <tr>
                                    <th class="question"><label>2.You receive prompt service from service providers.</th></label>
                                    <td><input type="radio" name="Q2" class="input" id="Q2" value="1"></td>
                                    <td><input type="radio" name="Q2" class="input" id="Q2" value="2"></td>
                                    <td><input type="radio" name="Q2" class="input" id="Q2" value="3"></td>
                                    <td><input type="radio" name="Q2" class="input" id="Q2" value="4"></td>
                                    <td><input type="radio" name="Q2" class="input" id="Q2" value="5"></td>
                                    <td><input type="radio" name="Q2" class="input" id="Q2" value="6"></td>
                                    <td><input type="radio" name="Q2" class="input" id="Q2" value="7"></td>
                                </tr>
                                <tr>
                                    <th class="question"><label>3.The service provider/s is/are polite.</th></label>
                                    <td><input type="radio" name="Q3" class="input" id="Q3" value="1"></td>
                                    <td><input type="radio" name="Q3" class="input" id="Q3" value="2"></td>
                                    <td><input type="radio" name="Q3" class="input" id="Q3" value="3"></td>
                                    <td><input type="radio" name="Q3" class="input" id="Q3" value="4"></td>
                                    <td><input type="radio" name="Q3" class="input" id="Q3" value="5"></td>
                                    <td><input type="radio" name="Q3" class="input" id="Q3" value="6"></td>
                                    <td><input type="radio" name="Q3" class="input" id="Q3" value="7"></td>
                                </tr>
                                <tr>
                                    <th class="question"><label>4.The service provider/s is/are sensitive to the clients needs.</th></label>
                                    <td><input type="radio" name="Q4" class="input" id="Q4" value="1"></td>
                                    <td><input type="radio" name="Q4" class="input" id="Q4" value="2"></td>
                                    <td><input type="radio" name="Q4" class="input" id="Q4" value="3"></td>
                                    <td><input type="radio" name="Q4" class="input" id="Q4" value="4"></td>
                                    <td><input type="radio" name="Q4" class="input" id="Q4" value="5"></td>
                                    <td><input type="radio" name="Q4" class="input" id="Q4" value="6"></td>
                                    <td><input type="radio" name="Q4" class="input" id="Q4" value="7"></td>
                                </tr>
                                <tr>
                                    <th class="question"><label>5.The service provider/s is/are well dressed and appear neat.</th></label>
                                    <td><input type="radio" name="Q5" class="input" id="Q5" value="1"></td>
                                    <td><input type="radio" name="Q5" class="input" id="Q5" value="2"></td>
                                    <td><input type="radio" name="Q5" class="input" id="Q5" value="3"></td>
                                    <td><input type="radio" name="Q5" class="input" id="Q5" value="4"></td>
                                    <td><input type="radio" name="Q5" class="input" id="Q5" value="5"></td>
                                    <td><input type="radio" name="Q5" class="input" id="Q5" value="6"></td>
                                    <td><input type="radio" name="Q5" class="input" id="Q5" value="7"></td>
                                </tr>
                                <tr>
                                    <th class="question"><label>6.The appearance of the physical facilities/venue of the service provider is in keeping with the type of service provided.</th></label>
                                    <td><input type="radio" name="Q6" class="input" id="Q6" value="1"></td>
                                    <td><input type="radio" name="Q6" class="input" id="Q6" value="2"></td>
                                    <td><input type="radio" name="Q6" class="input" id="Q6" value="3"></td>
                                    <td><input type="radio" name="Q6" class="input" id="Q6" value="4"></td>
                                    <td><input type="radio" name="Q6" class="input" id="Q6" value="5"></td>
                                    <td><input type="radio" name="Q6" class="input" id="Q6" value="6"></td>
                                    <td><input type="radio" name="Q6" class="input" id="Q6" value="7"></td>
                                </tr>
                            </table>
					</div>
				</div>
                <br>
                <div class="btns_wrap">
		            <div class="common_btns form_2_btns">
                        <a href="javascript:history.back(1)" style="text-decoration:none"><button type="button" class="btn_back" ><span class="icon"><ion-icon name="arrow-back-sharp"></ion-icon></span>Back</button></a>
			            <button type="Submit" class="btn_next" name="page_2_next">Next <span class="icon"><ion-icon name="arrow-forward-sharp"></ion-icon></span></button>
		            </div>
                </div>   
			</form>
		</div>
    </div>
</div>
<script type="text/javascript" src="Star.js"></script>
</body>
</html>
