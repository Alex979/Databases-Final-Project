<?php
  $permission = 0;
	$permission = $_POST["permission"];
	if ($permission == 0)
	{
		header('Location: permissionDenied.html');
	}
	
	
	
	/* Create connection */
	$servername = "localhost";
	$username = "TeamEighteen";
	$password = "DatabasePassword1!";
	$dbname = "TeamEighteen";	
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);
		  
	if (!$conn) //Check if connection failed
	{	
		die("Connection failed: ".mysqli_connect_error());
	}
	
	$newGrad = 0;
	$newGrad = $_POST["newGrad"];
	if ($newGrad == 1)
	{
		$studentid = $_POST["id"];
		
		$query = "UPDATE roles SET role = 'alumni' WHERE id = '$studentid'";
		 $result = mysqli_query($conn,$query);
     
     		$query2 = "DELETE FROM formOne WHERE id = '$studentid'";
		 $result2 = mysqli_query($conn,$query2);
    
    header("Location: gradsec.php");
	}
?>
