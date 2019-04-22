
<html>
	 <title>GWU Advising</title>
	<link rel="icon" href="http://www.gwrha.com/uploads/1/7/9/9/17997469/gw_atx_4cp_pos.png">
	<style>
		.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #000000;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 20px;
  padding: 20px;
  width: 200px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}
.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}
.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}
.button:hover span {
  padding-right: 25px;
}
.button:hover span:after {
  opacity: 1;
  right: 0;
}
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
	$username = "TeamEighteen";
	$password = "DatabasePassword1!";
	$dbname = "TeamEighteen";	
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);
		  
	if (!$conn) //Check if connection failed
	{	
		die("Connection failed: ".mysqli_connect_error());
	}
	
	$query = "SELECT * FROM roles r, users s WHERE r.id = s.id AND r.role = 'student' ";
	$result = mysqli_query($conn,$query);
	if (mysqli_num_rows($result) > 0)
	{
			echo "Students enrolled at GWU:";
			echo '<br>';
			echo '<br>';
			
			echo '<table>';
   
      			echo '<tr><th>Student Name</th>';
			echo '<th>Student ID</th>';
		echo '<th>Enrollment Information</th>';
		echo '<th>Personal Information</th></tr>';
			
    
			//output data of each row that query found as result	
			while ($row = mysqli_fetch_assoc($result))
			{	
				$student_fname = $row["fname"];
				$student_lname = $row["lname"];
				$student_id = $row["id"];
				$advisor_id = $row["advisorid"];
        
				echo '<tr><td>'.$student_fname.' '.$student_lname.'</td>';
        
       				 echo '<td>';
				echo $student_id;
				echo '</td>';
				
				echo '<td><form action="enrollInfo.php" method = "post">';
				echo '<input type="hidden" name="id" value = "'.$student_id.'">';
				echo '<input type="hidden" name="permission" value = 1/>';
    				echo '<button type="submit">View </button>';
				echo '</form>';
				echo '</td>';
				
				echo '<td><form action="viewStudentInfo.php" method = "post">';
				echo '<input type="hidden" name="id" value = "'.$student_id.'">';
				echo '<input type="hidden" name="permission" value = 1/>';
    				echo '<button type="submit">View</button>';
				echo '</form>';
				echo '</td></tr>';
			}	
			echo '</table>';
			echo '<br>';
				
		}	
		else	
		{	
			echo "No students are enrolled.";		
		}
	
?>
	 <form action="gradsec.php" method="post">
	<br><button class="button" style="vertical-align:middle"><span>Return to HomePage</span></button>
	</form>
</body>
</html>
