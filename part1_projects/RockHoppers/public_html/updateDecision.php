<?php
	session_start();
	include('connect.php');
	$uid = $_POST["uid"];
	$decision = $_POST["decision"];
	$query = "UPDATE application_status SET decision = '$decision' where uid = '$uid'";
	$result = mysqli_query($conn,$query);
	header('location:applicant_display.php?status=decided');
	exit;
?>
