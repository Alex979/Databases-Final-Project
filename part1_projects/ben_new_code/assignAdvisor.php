<?php
session_start();
?>
<html>
<head>

 <title>GWU Advising</title>
  <link rel="stylesheet" href="style.css">
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
		
		$query = "SELECT * FROM role r, user u WHERE r.uid = u.uid AND r.type = 'student' AND u.advisorid IS NULL";
		$result = mysqli_query($conn,$query);
		if (mysqli_num_rows($result) > 0)
		{
				echo "Students without an Advisor:";
				echo '<br>';
				echo '<br>';
				
				echo '<table class="table">';
	
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
						echo '<button class="btn btn-primary" type="submit">Assign</button>';
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
</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
