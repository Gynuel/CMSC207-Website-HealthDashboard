<?php
session_start();
unset($_SESSION["survey"]);
header("Location: index.php");
?>