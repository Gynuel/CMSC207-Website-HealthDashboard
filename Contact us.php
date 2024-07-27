<!----------------------- FORM TO PHP MAILER CONNECTION ---------------------->
<?php
use PHPMailer\PHPMailer\PHPMailer;
$msg = '';
    if (array_key_exists('email', $_POST)) {
        require 'vendor/autoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->Port = 587;   
        $mail->SMTPDebug = 0; // If the PHPMailer contact form doesn’t work, change the $mail->SMTPDebug = 0; line to $mail->SMTPDebug = 2 to identify the cause. Don’t forget to remove the line or change the 2 to 0 after.
        $mail->SMTPAuth = true;                                          // Activates SMTP Authentication
        $mail->Username = '*********';                           // Your email address
        $mail->Password = '*********'; 
        
        $errors = array();

        if (filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid!");                          // Validate emails
           }     
        
        // Check if there are errors.
        if (count($errors)>0) { 
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";            // Show error prompt
            }
        }else{
            $mail->setFrom('admin@arisedb.com', 'Project ARISE');            // Sender's email address
            $mail->addAddress($_POST['email'], $_POST['name']);              // Receiver's email address
            $mail->AddCC('admin@arisedb.com', 'Project ARISE');              // CC Admin to receive email 
            
            if($mail->addReplyTo($_POST['email'], $_POST['name'])){
                $mail->Subject = 'Project ARISE Contact Form - ' . $_POST['name']; // Add email subject here
                $mail->isHTML(false);
                $mail->Body = <<<EOT
                Hi Mr./Ms. {$_POST['name']}:

                Hope you are in good health.
    
                This is to acknowledge receipt of your inquiry. We have received the information below and the team will get back to you shortly.

                Email: {$_POST['email']}
                Name: {$_POST['name']}
                Message:
                    {$_POST['message']}


                Sincerely,

            
                Administrator
                Project A.R.I.S.E
                "Be a voice for change"
                EOT;

                if (!$mail->send()) {
                    $msg = 'Sorry, something went wrong. Please try again later.';
                } else {
                    $msg = "<div class='alert alert-success' role='alert'> Message sent! Thanks for contacting us. </div> ";
                    }
                } else {
            $msg = "<div class='alert alert-warning' role='alert'> Share your email with us!</div>";
            }
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href = "Contact us.css">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'> <!---This is a CSS online for the buttons and icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Contact us</title>
</head>
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
                    <li><a href="Contact us.php" class="link active">Contact us</a></li>
                    <li><a href="Login.php" class="link">Login</a></li>
                </ul>
            </div>
            
            <div class="nav-menu-btn">
                <i class="bx bx-menu" onclick="myMenuFunction()"></i>
            </div>
        </nav>
<!------------------------- CONTACT US DETAILS ------------------------->
        <div class="container">
            <div class="content">
                <div class="left-side">
                    <div class="address details">
                        <i class="bx bx-buildings"></i>
                        <div class="topic">Address</div>
                        <div class="text-one"> Santa Cruz, Manila 1003</div>
                        <div class="text-two">National Capital Region, PH</div>
                    </div>

                    <div class="phone details">
                        <i class="bx bx-phone"></i>
                        <div class="topic">Phone</div>
                        <div class="text-one">(+63) 0921-500-2694</div>
                    </div>

                    <div class="email details">
                        <i class="bx bx-envelope"></i>
                        <div class="topic">Email</div>
                        <div class="text-one">admin@arisedb.com</div>
                    </div>
                </div>

                <div class="right-side">
                    <?php if (!empty($msg)) {
                    echo "$msg";
                    } ?>
                    <div class="topic-text">Contact Us</div>
                        <p>Need help? Drop us a message below.</p>
                        <br>
                        <form method="POST">
                            <div class="input-box">
                                <label for="name">Name: <div class="input-box"><input type="text" name="name" id="name"></div></label><br>
                                <label for="email">Email address: <div class="input-box"><input type="email" name="email" id="email" class="input-box"></div></label><br>
                                <label for="message">Message: <div class="input-box"><textarea name="message" id="message" rows="8" cols="20" class="input-box"></textarea></div></label><br>
                            </div>
                            <div class="button-box">
                                <input type="submit" class="button" value="Send">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<!-------------------------- END OF WRAPPER TAG ------------------------>
    </div>
<script src="main.js"></script>
</body>
</html>
