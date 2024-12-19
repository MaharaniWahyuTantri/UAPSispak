<?php
session_start();
if(!isset($_SESSION['SES_USER'])) {
	header('location:index.php');
} else {
	$SES_USER = $_SESSION['SES_USER'];
	}
?>