<html>
<head>
 <title>GWU Advising</title>
  <link rel="stylesheet" href="style.css">
	<link rel="icon" href="http://www.gwrha.com/uploads/1/7/9/9/17997469/gw_atx_4cp_pos.png">
	<style>
table {
  border-collapse: collapse;
  width: 100%;
}
th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}
	</style>
</head>
<body>
<h1>Assign an advisor to a student</h1>
 
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
	
	$newAssignment = 0;
	$newAssignment = $_POST["newAssignment"];
	if ($newAssignment == 1)
	{
		$studentid = $_POST["id"];
		$advisorid = $_POST["advisorid"];
		
		
		$assign_query = "UPDATE users SET advisorid = ".$advisorid." WHERE id = ".$studentid."";
		if(mysqli_query($conn,$assign_query))
		{
			echo "Advisor assignment successful!<br>";
		}
		else
		{
			echo "Advisor assignment unsuccessful!<br>";
		}
	}
	
	$query = "SELECT * FROM roles r, users s WHERE r.id = s.id AND r.role = 'student' AND s.advisorid IS NOT NULL";
	$result = mysqli_query($conn,$query);
	if (mysqli_num_rows($result) > 0)
	{
			echo "Students with an Advisor:";
			echo '<br>';
			echo '<br>';
			
			echo '<table style="width50%" border="1">';
   
      			echo '<tr><th>Student Name</th>';
			echo '<th>Student ID</th>';
			echo '<th>Advisor Name</th>';
			echo '<th>Advisor ID</th></tr>';
			
    
			//output data of each row that query found as result	
			while ($row = mysqli_fetch_assoc($result))
			{	
				$student_fname = $row["fname"];
				$student_lname = $row["lname"];
				$student_id = $row["id"];
				$advisor_id = $row["advisorid"];
			 
				$innerquery = "SELECT * FROM users WHERE id = ".$advisor_id."";
				$innerresult = mysqli_query($conn,$innerquery);
				if (mysqli_num_rows($result) > 0)
				{
					while ($innerrow = mysqli_fetch_assoc($innerresult))
					{
						$advisor_fname = $innerrow["fname"];
						$advisor_lname = $innerrow["lname"];	
					}
				}

        
				echo '<tr><td>'.$student_fname.' '.$student_lname.'</td>';
        
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

</body>
</html>
