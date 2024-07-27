<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href = "index.css">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'> <!---This is a CSS online for the buttons and icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Home</title>
</head>
<!--------------------- START PAGE SESSIONING ---------------------->
<?php
	session_start();
	if(!empty($_SESSION["survey"])){
		header("Location: Survey.php");
	}
	if(!empty($_SESSION["user"])){
		header("Location: Administrator.php");
	}
?>
<body>
    <div class="wrapper">
<!------------------------------ HEADER ------------------------------>
        <nav class="nav">
            <div class="nav-logo">
                <p><i class="bx bx-analyse"></i> ARISE</p>
            </div>
            
            <div class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="index.php" class="link active">Home</a></li>
                    <li><a href="About us.php" class="link">About us</a></li>
                    <li><a href="Contact us.php" class="link">Contact us</a></li>
                    <li><a href="Login.php" class="link">Login</a></li>
                </ul>
            </div>
            
            <div class="nav-menu-btn">
                <i class="bx bx-menu" onclick="myMenuFunction()"></i>
            </div>
        </nav>
<!------------------------------ CONTENTS ---------------------------->
        <div class="content-box">
            <div class="team">
		        <img alt="image" src="assets/WHITE@4x.png" class="landingpageuser-image">
            </div>
            <div class="content">
                <h1>Partnering for Better Care<br>Share your recent healthcare experience!</h1>
                <p class="sub-description">We believe in partnering with patients and clients to provide exceptional care. By participating
                    in this survey, you'll be an active partner, helping the Philippine Department of Health
                    improve their primary care services for you and the community. Your voice counts!
                <br>
                <br>
                Your answers will be kept confidential and compliant to the Data Privacy Act (RA No. 10173)
                <br>
                <br>
                Have a service code? Put it below to access your survey.
                </p>
                <form action="index.php" method="post">
<!----------------------- FORM TO DB CONNECTION ---------------------->
            <?php
                // Check if the "Submit" button is clicked
               if (isset($_POST["service-code"])) {
                
                // Initialize variables
                $Code = $_POST["code"];
                require_once "database.php";                           // Connect to database
                $sql = "SELECT * FROM form1_survey WHERE service_code = '$Code' AND activation_date IS NULL;";
                $result = mysqli_query($conn, $sql);
                $survey = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Apply validation rules
                if ($survey) {                                        // Check if code matched. If > 0 meaning, code exist.
                    if ($survey["activation_date"] == NULL){          // Check if code is utilized. If NULL meaning, unutilized.
                        
                        $result = mysqli_query($conn, "SELECT NOW() AS cur_date;");    
                        $current_date = mysqli_fetch_array($result, MYSQLI_ASSOC);   
                        $sql_exe = "UPDATE form1_survey SET activation_date = '$current_date[cur_date]', isactivate ='1' WHERE service_code  = '$Code' AND activation_date IS NULL;";
                        $result = mysqli_prepare($conn, $sql_exe);    
                        mysqli_execute($result);                      // Update the activation_date and isactivate to date of access based on database time and "1", respectively.
                        echo "<div class='alert alert-success'>Let's get you started!</div>";
                            
                        session_start();
                        $_SESSION["survey"] = $survey;
                        $_SESSION["Active_Time"] = time();
                        header("Location: Survey.php");
                        die();
                        } else{echo "<div class='alert alert-danger'>The code has already been activated!</div>";}
                } else{echo "<div class='alert alert-danger'>The code is invalid!</div>";}
            }
            ?>
<!----------------------- SERVICE CODE INPUT ---------------------->
                        <div class="two-col">                        
                            <div class="input-box">
                                <input type="text" class="input-field" name="code" placeholder="Service Code">
                                <i class="bx bx-grid-alt"></i>
                            </div>
                        
                            <div class="input-box">
                                <input type="submit" class="submit" name="service-code" value="Submit" >
                            </div>
                
                            <div class="two">
                                <label><a href="Contact us.php"><br>Don't know where to find your code? Contact us.</a></label>
                            </div>

                        </div>
                </form>
            </div>
        </div>
<!-------------------------- END OF CONTENTS ------------------------->
    </div>
<script src = "main.js"></script>
</body>
</html>
