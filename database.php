<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "u429525639_auth";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}

?>