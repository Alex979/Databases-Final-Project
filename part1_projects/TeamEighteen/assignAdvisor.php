<html>
<head>
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
	$username = "TeamEighteen";
	$password = "DatabasePassword1!";
	$dbname = "TeamEighteen";	
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);
		  
	if (!$conn) //Check if connection failed
	{	
		die("Connection failed: ".mysqli_connect_error());
	}
	
	$query = "SELECT * FROM roles r, users u WHERE r.id = u.id AND r.role = 'student' AND u.advisorid IS NULL";
	$result = mysqli_query($conn,$query);
	if (mysqli_num_rows($result) > 0)
	{
			echo "Students without an Advisor:";
			echo '<br>';
			echo '<br>';
			
			echo '<table style="width50%" border="1">';
   
      			echo '<tr><th>Name</th>';
			echo '<th>ID</th>';
			echo '<th>Select Advisor</th>';
			echo '<th>Action</th></tr>';
			
    
			//output data of each row that query found as result	
			while ($row = mysqli_fetch_assoc($result))
			{	
				$fname = $row["fname"];
				$lname = $row["lname"];
				$id = $row["id"];
				
				echo '<tr><td>'.$fname.' '.$lname.'</td>';
				
      				echo '<td>';
				echo $id;
				echo '</td>';
				
				echo '<td>';	
				echo '<form action="advisorAssignments.php" method="post">';
				echo '<select name="advisorid">';
					$advisor_query = "SELECT * FROM roles r, users u WHERE r.id = u.id AND r.role = 'advisor'";
					$advisor_result = mysqli_query($conn,$advisor_query);
					if (mysqli_num_rows($advisor_result) > 0)
					{
						while ($row = mysqli_fetch_assoc($advisor_result))
						{
							$advisor_id = $row["id"];
							$advisor_fname = $row["fname"];
							$advisor_lname = $row["lname"];
  							echo '<option value="'.$advisor_id.'">'.$advisor_fname.' '.$advisor_lname.'</option>';
						}
					}
				echo '</select>';
				echo '</td>';
				
				echo '<td>';
				echo '<input type="hidden" name="id" value = "'.$id.'">';
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
