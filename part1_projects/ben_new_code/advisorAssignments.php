<?php
session_start();
?>
<html>
<head>
 <title>GWU Advising</title>
	<link rel="icon" href="http://www.gwrha.com/uploads/1/7/9/9/17997469/gw_atx_4cp_pos.png">
  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
<?php
include('../FlatEarthSociety/public_html/navbar.php');
?>
<div class="container mt-3">
<h1 class="text-primary">Assign an advisor to a student</h1>
 
 <?php

	
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
	
	$newAssignment = 0;
	$newAssignment = $_POST["newAssignment"];
	if ($newAssignment == 1)
	{
		$studentid = $_POST["uid"];
		$advisorid = $_POST["advisorid"];
		
		
		$assign_query = "UPDATE user SET advisorid = '$advisorid' WHERE uid = '$studentid'";
		if(mysqli_query($conn,$assign_query))
		{
			echo "Advisor assignment successful!<br>";
			header('Location: assignAdvisor.php');
		}
		else
		{
			echo "Advisor assignment unsuccessful!<br>";
		}
	}
	
	$query = "SELECT * FROM role, user WHERE role.uid = user.uid AND role.type = 'student' AND user.advisorid IS NOT NULL";
	$result = mysqli_query($conn,$query);
	if (mysqli_num_rows($result) > 0)
	{
			echo "Students with an Advisor:";
			echo '<br>';
			echo '<br>';
			
			echo '<table class="table">';
   
      			echo '<tr><th>Student Name</th>';
			echo '<th>Student ID</th>';
			echo '<th>Advisor Name</th>';
			echo '<th>Advisor ID</th></tr>';
			
    
			//output data of each row that query found as result	
			while ($row = mysqli_fetch_assoc($result))
			{	
				$student_fname = $row["fname"];
				$student_lname = $row["lname"];
				$student_id = $row["uid"];
				$advisor_id = $row["advisorid"];
			 
				$innerquery = "SELECT * FROM user WHERE uid = '$advisor_id'";
				$innerresult = mysqli_query($conn,$innerquery);
				if (mysqli_num_rows($result) > 0)
				{
					while ($innerrow = mysqli_fetch_assoc($innerresult))
					{
						$advisor_fname = $innerrow["fname"];
						$advisor_lname = $innerrow["lname"];	
					}
				}
        
				echo '<tr><td>'.$student_fname. ' '.$student_lname.'</td>';
        
       				 echo '<td>';
				echo $student_id;
				echo '</td>';
				
       				 echo '<td>'.$advisor_fname.' '.$advisor_lname.'</td>';
        
        			echo '<td>';
				echo $advisor_id;
				echo '</td></tr>';
			}
			echo '</table>';
			echo '<br>';
				
		}	
		else	
		{	
			echo "No students have been assigned an advisor.";		
		}
 
 
 ?>
 </div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
