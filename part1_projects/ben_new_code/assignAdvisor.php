<html>
<head>

 <title>GWU Advising</title>
  <link rel="stylesheet" href="style.css">
<link rel="icon" href="http://www.gwrha.com/uploads/1/7/9/9/17997469/gw_atx_4cp_pos.png">
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
	$username = "Team_Name";
	$password = "p@ssW0RD";
	$dbname = "Team_Name";	
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);
		  
	if (!$conn) //Check if connection failed
	{	
		die("Connection failed: ".mysqli_connect_error());
	}
	
	$query = "SELECT * FROM role r, user u WHERE r.uid = u.uid AND r.type = 'student' AND u.advisorid IS NULL";
	$result = mysqli_query($conn,$query);
	if (mysqli_num_rows($result) > 0)
	{
			echo "Students without an Advisor:";
			echo '<br>';
			echo '<br>';
			
			echo '<table style="width50%" border="1">';
   
      			echo '<tr><th>Name</th>';
			echo '<th>UID</th>';
			echo '<th>Select Advisor</th>';
			echo '<th>Action</th></tr>';
			
    
			//output data of each row that query found as result	
			while ($row = mysqli_fetch_assoc($result))
			{	
				$fname = $row["fname"];
				$lname = $row["lname"];
				$uid = $row["uid"];
				
				echo '<tr><td>'.$fname.' '.$lname.'</td>';
				
      				echo '<td>';
				echo $uid;
				echo '</td>';
				
				echo '<td>';	
				echo '<form action="advisorAssignments.php" method="post">';
				echo '<select name="advisorid">';
					$advisor_query = "SELECT * FROM role r, user u WHERE r.uid = u.uid AND r.type = 'advisor'";
					$advisor_result = mysqli_query($conn,$advisor_query);
					if (mysqli_num_rows($advisor_result) > 0)
					{
						while ($row = mysqli_fetch_assoc($advisor_result))
						{
							$advisor_id = $row["uid"];
							$advisor_fname = $row["fname"];
							$advisor_lname = $row["lname"];
  							echo '<option value="'.$advisor_id.'">'.$advisor_fname.' '.$advisor_lname.'</option>';
						}
					}
				echo '</select>';
				echo '</td>';
				
				echo '<td>';
				echo '<input type="hidden" name="uid" value = "'.$uid.'">';
				echo '<input type="hidden" name="permission" value = 1/>';
				echo '<input type="hidden" name="newAssignment" value = 1/>';
    				echo '<button type="submit">Assign</button>';
				echo '</form>';
				echo '</td></tr>';
			}	
			echo '</table>';
			echo '<br>';
				
		}	
		else	
		{	
			echo "All students have been assigned an advisor.";		
		}
 
 
 ?>
 <form action="gradsec.php" method="post">
	<br><button class="button" style="vertical-align:middle"><span>Return to HomePage</span></button>
	</form>
</body>
</html>
