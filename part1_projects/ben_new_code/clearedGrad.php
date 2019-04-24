<html>
	 <title>GWU Advising</title>
	<link rel="icon" href="http://www.gwrha.com/uploads/1/7/9/9/17997469/gw_atx_4cp_pos.png">

<body>
<h2>Students cleared for graduation</h2>
<?php
  	//check for permission
	$permission = 0;
	$permission = $_POST["permission"];
	if ($permission == 0)
	{
		header('Location: permissionDenied.html');
	}
	
	
	/* Create connection */
	$servername = "localhost";
	$username = "Team_Name";
	$password = "p@ssW0RD";
	$dbname = "Team_Name";	
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);
		  
	if (!$conn) //Check if connection failed
	{	
		die("Connection failed: ".mysqli_connect_error());
	}
	
	$query = "SELECT * FROM role r, user s WHERE r.uid = s.uid AND r.type = 'student' AND s.clearedToGrad = 1";
	$result = mysqli_query($conn,$query);
	if (mysqli_num_rows($result) > 0)
	{
			echo "Students cleared to Graduate:";
			echo '<br>';
			echo '<br>';
			
			echo '<table>';
   
      			echo '<tr><th>Student Name</th>';
			echo '<th>Student ID</th>';
		echo '<th>Enrollment Information</th>';
		echo '<th>Personal Information</th>';
			echo '<th>Action</th></tr>';
			
    
			//output data of each row that query found as result	
			while ($row = mysqli_fetch_assoc($result))
			{	
				$student_fname = $row["fname"];
				$student_lname = $row["lname"];
				$student_id = $row["uid"];
				$advisor_id = $row["advisorid"];
        
				echo '<tr><td>'.$student_fname.' '.$student_lname.'</td>';
        
       				 echo '<td>';
				echo $student_id;
				echo '</td>';
				
				echo '<td><form action="enrollInfo.php" method = "post">';
				echo '<input type="hidden" name="uid" value = "'.$student_id.'">';
				echo '<input type="hidden" name="permission" value = 1/>';
    				echo '<button type="submit">View </button>';
				echo '</form>';
				echo '</td>';
				
				echo '<td><form action="viewStudentInfo.php" method = "post">';
				echo '<input type="hidden" name="uid" value = "'.$student_id.'">';
				echo '<input type="hidden" name="permission" value = 1/>';
    				echo '<button type="submit">View</button>';
				echo '</form>';
				echo '</td>';
				
        
        			echo '<td><form action="gradSuccess.php" method = "post">';
				echo '<input type="hidden" name="uid" value = "'.$student_id.'">';
				echo '<input type="hidden" name="permission" value = 1/>';
				echo '<input type="hidden" name="newGrad" value = 1/>';
    				echo '<button type="submit">Graduate</button>';
				echo '</form>';
				echo '</td></tr>';
			}	
			echo '</table>';
			echo '<br>';
				
		}	
		else	
		{	
			echo "No students have been cleared to graduate.";		
		}
	
?>
	 <form action="gradsec.php" method="post">
	<br><button class="button" style="vertical-align:middle"><span>Return to HomePage</span></button>
	</form>
</body>
</html>
