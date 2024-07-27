<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href = "Style.css" type="text/css"/>
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'> <!---This is a CSS online for the buttons and icons-->
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
<!----------------------------- LOGIN FORM --------------------------->
        <div class="login-container">
            <form action="Login.php" method="post">
<!----------------------- FORM TO DB CONNECTION ---------------------->
            <?php
                // Check if the "Register" button is clicked
               if (isset($_POST["login"])) {

                // Initialize variables
                $Email = $_POST["email"];
                $Password = $_POST["password"];
                
                require_once "database.php";     // Connect to database
                $sql = "SELECT * FROM admin WHERE email = '$Email'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Apply validation rules
                if ($user) {
                    if (password_verify($Password, $user["password"])) {
                        session_start();
                        $_SESSION["user"] = "yes";
                        $_SESSION["Active_Time"] = time();
                        header("Location: Administrator.php");
                        die();
                    }else{
                        echo "<div class='alert alert-danger'>Password does not match!</div>";
                    }
                }else{
                    echo "<div class='alert alert-danger'>Please enter a valid Email.</div>";
                }
            }
            ?>
<!---------------------------- FORM FIELDS --------------------------->          
                <img alt="image" src="assets/WHITE@4x.png" class="loginadmin-image"> 
                <div class="top">
                    <span>Don't have an account? <a href="Register.php">Sign Up</a></span>
                    <header>Login</header>
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
                    <input type="submit" class="submit" name="login" value="Sign In" >
                </div>

                <div class="two-col">
                    <div class="two">
                        <label><a href="#">Forgot your email or password?</a></label>
                    </div>
                </div>
            </form>
        </div>
    </div>
<script src = "main.js"></script>
</body>
</html>
