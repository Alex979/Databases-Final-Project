<?php
  session_start();
	/* Create connection */
	$servername = "127.0.0.1";
	$username = "Team_Name";
	$password = "p@ssW0RD";
	$dbname = "Team_Name";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) //Check if connection failed
	{	
		die("Connection failed: ".mysqli_connect_error());
	}
	$uid = $_POST["uid"];
  $query = "UPDATE user SET approveThesis = 1 WHERE uid = '$uid'";
  $result = mysqli_query($conn, $query);
  header("Location: ../FlatEarthSociety/public_html/dashboard.php");
mysqli_close($conn);
 ?>


