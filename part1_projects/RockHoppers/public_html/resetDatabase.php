<?php
	include('connect.php');
	$reset = file_get_contents('/home/ead/alexjacobson/public_html/TheRockhoppers/apps_schema.sql');
	$resetdb = mysqli_multi_query($conn, $reset);
	header('location:login.php');
	exit;
?>