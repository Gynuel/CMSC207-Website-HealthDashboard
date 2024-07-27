<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href = "Style.css">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>User Login</title>
</head>
<!--------------------- START PAGE SESSIONING ---------------------->
<?php
	session_start();
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
                    <li><a href="index.php" class="link">Home</a></li>
                    <li><a href="About us.php" class="link">About us</a></li>
                    <li><a href="Contact us.php" class="link">Contact us</a></li>
                    <li><a href="Login.php" class="link active">Login</a></li>
                </ul>
            </div>
            
            <div class="nav-menu-btn">
                <i class="bx bx-menu" onclick="myMenuFunction()"></i>
            </div>

        </nav>
<!------------------------- REGISTRATION FORM ------------------------>
        <div class="reg-container">
            <form action="Register.php" method="post">
<!----------------------- FORM TO DB CONNECTION ---------------------->
            <?php
                // Check if the "Register" button is clicked
               if (isset($_POST["register"])) {

                // Initialize variables
                $FirstName = $_POST["firstname"];
                $LastName = $_POST["lastname"];
                $Email = $_POST["email"];
                $Password = $_POST["password"];
                $PasswordRepeat = $_POST["repeat_password"];
                $errors = array();
                
                $domain = explode('@',$Email)[1];
                
                // Encrypt password
                $passwordHash = password_hash($Password, PASSWORD_DEFAULT);
                
                // Apply validation rules
                if (empty($FirstName) OR empty($LastName) OR empty($Email) OR empty($Password) OR empty($PasswordRepeat)) {
                 array_push($errors,"All fields are required!");                        // Required fields
                    }

                if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                 array_push($errors, "Email is not valid!");                            // Valid emails
                    } else {
                        if($domain != 'doh.gov.ph') {                                   // DOH emails only
                            array_push($errors, "Email is not a DOH registered email.");  
                        }
                    } 

                if (strlen($Password) < 4) {
                 array_push($errors,"Password must be at least 4 charactes long.");     // Valid passwords
                    }
                if ($Password !== $PasswordRepeat) {
                 array_push($errors,"Password does not match");                         // Password match
                    }

                require_once "database.php";                                            // Connect to database
                $sql = "SELECT * FROM admin WHERE email = '$Email'";
                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);
                
                if ($rowCount > 0) {
                 array_push($errors,"Email already exists!");                           // Email already exist
                    }
                if (count($errors)>0) {
                    foreach ($errors as  $error) {
                        echo "<div class='alert alert-danger'>$error</div>";            // Show error prompt
                        }
                    }else{                                                              // Insert data to database
                        $sql = "INSERT INTO admin (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                        if ($prepareStmt) {
                            mysqli_stmt_bind_param($stmt,"ssss",$FirstName, $LastName, $Email, $passwordHash);
                            mysqli_stmt_execute($stmt);
                            echo "<div class='alert alert-success'>You are registered successfully!</div>";
                        }else{
                            die("Something went wrong");
                            }
                        }
                }
            ?>
<!---------------------------- FORM FIELDS --------------------------->
                <div class="top">
                    <span>Have an account? <a href="Login.php">Login</a></span>
                    <header>Sign up</header>
                </div>
    
                <div class="two-forms">
                    <div class="input-box">
                        <input type="text" class="input-field" name="firstname" placeholder="First Name">
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="text" class="input-field" name="lastname" placeholder="Last Name">
                        <i class="bx bx-user"></i>
                    </div>
                </div>

                <div class="input-box">
                    <input type="email" class="input-field" name="email" placeholder="Email">
                    <i class="bx bx-envelope"></i>
                </div>
            
                <div class="input-box">
                    <input type="password" class="input-field" name="password" placeholder="Password">
                    <i class="bx bx-lock-alt"></i>
                </div>
            
                <div class="input-box">
                    <input type="password" class="input-field" name="repeat_password" placeholder="Repeat Password">
                    <i class="bx bx-lock-alt"></i>
                </div>
            
                <div class="input-box">
                    <input type="submit" class="submit" name="register" value="Register" >
                </div>

                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="register-check">
                        <label for="register-check"> Remember Me</label>
                    </div>
                    <div class="two">
                        <label><a href="#">Terms & conditions</a></label>
                    </div>
                </div>

            </form>
        </div>
    </div>
<script src = "main.js"></script>
</body>
</html>
