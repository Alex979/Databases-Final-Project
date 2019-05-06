<?php
	
	$servername = "localhost";
	$username = "Team_Name";
	$password = "p@ssW0RD";
	$dbname = "Team_Name";	
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);
		  
	if (!$conn) //Check if connection failed
	{	
		die("Connection failed: ".mysqli_connect_error());
	}
		$studentid = $_POST["uid"];
		
		$query = "UPDATE role SET type = 'alumni' WHERE uid = '$studentid' AND type = 'student'";
		 $result = mysqli_query($conn,$query);
		
		$query = "UPDATE user SET advisorid = '' AND clearedToGrad = '0' WHERE uid = '$studentid'";
		 $result = mysqli_query($conn,$query);
     
     		$query2 = "DELETE FROM formOne WHERE uid = '$studentid'";
		 $result2 = mysqli_query($conn,$query2);
    
    header("Location: ../FlatEarthSociety/public_html/dashboard.php");
?>
