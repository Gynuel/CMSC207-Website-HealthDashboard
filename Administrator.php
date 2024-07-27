<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href = "Administrator.css">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <title>Administrator</title>
</head>
<!--------------------- START PAGE SESSIONING ---------------------->
<?php
	session_start();

	if(empty($_SESSION["user"])){
		header("Location: Login.php");
	}
	if((time()-$_SESSION["Active_Time"]) > 86400 ){     // Logout after 24hours or 86400 seconds
		header("Location: Logout.php");
	}
	$_SESSION["Active_Time"] = time(); 					// Update the session time everytime in page add the code below for each page.
?>
<body>
<!------------------------------ SIDEBAR ------------------------------>
	<section id="sidebar">
		<pre><a href="#" class="brand"><i class='bx bxs-analyse'></i>   ARISE</a></pre>
		<ul class="side-menu">
			<li><a href="Administrator.php" class="active"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li class="divider" data-text="Reports"></li>
			<li><a href="Administrator_SERVQUAL.php"><i class='bx bxs-chart icon' ></i>SERVQUAL</a></li>
			<li><a href="Administrator_comments.php"><i class='bx bxs-widget icon' ></i>Comments</a></li>
		</ul>
		<div class="ads">
			<div class="wrapper">
				<p>In partnership with</p>
				<p></p>
				<img alt="image" src="assets/BLACK@4x.png" class="loginadmin-image">
				<br>
				<p><span>Project A.R.I.S.E</span></p>
				<p>A Final Exam deliverable in CMSC 207: Web Development at UP Open University for 2nd Sem. S.Y. 2023-2024 </p>	
			</div>
		</div>
	</section>
<!------------------------------ NAVBAR ------------------------------>
	<section id="content">
		<nav>
			<i class='bx bx-menu toggle-sidebar' ></i>
			<form action="#">
				<div class="form-group">
					<input type="text" placeholder="Search...">
					<i class='bx bx-search icon' ></i>
				</div>
			</form>
			<a href="#" class="nav-link">
				<i class='bx bxs-bell icon' ></i>
			</a>
			<a href="#" class="nav-link">
				<i class='bx bxs-message-square-dots icon' ></i>
			</a>
			<span class="divider"></span>
			<div class="profile">
				<img src="assets/Blank.jpeg" alt="">
				<ul class="profile-link">
					<li><a href="#"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
					<li><a href="#"><i class='bx bxs-cog' ></i> Settings</a></li>
					<li><a href="Logout.php"><i class='bx bxs-log-out-circle' ></i> Logout</a></li>
				</ul>
			</div>
		</nav>
<!------------------------------ MAIN AND CENTER ------------------------------>
		<main>
			<h1 class="title">Dashboard</h1>
			<ul class="breadcrumbs">
				<li><a href="#">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Dashboard</a></li>
			</ul>
			<div class="info-data">
			<iframe title="Dashboard"  height = "550px" width = "100%" src="https://app.powerbi.com/view?r=eyJrIjoiNmQyYzM3ODQtZDdmYS00MDkwLWEwNjMtOGE2NzRiZjJhN2MwIiwidCI6IjA1ZjdiNmQxLTJlYWUtNDY3Mi1hZjczLTQ0YWQ4MTgzMTJmOSIsImMiOjEwfQ%3D%3D" frameborder="0" allowFullScreen="true"></iframe>
			</div>
		</main>
	</section>
<script src="Administrator.js"></script>      
</body>
</html>
