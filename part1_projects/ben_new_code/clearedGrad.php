<?php
session_start();
?>
<html>
	 <title>GWU Advising</title>
	<link rel="icon" href="http://www.gwrha.com/uploads/1/7/9/9/17997469/gw_atx_4cp_pos.png">
	<!-- Custom fonts for this template -->
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="css/sb-admin-2.min.css" rel="stylesheet">
<body>
	<?php
  	include('../FlatEarthSociety/public_html/navbar.php');
	?>
	<div class="container mt-3">
		<h2 class="text-primary">Students cleared for graduation</h2>
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
			
			$query = "SELECT * FROM role r, user s WHERE r.uid = s.uid AND r.type = 'student' AND s.clearedToGrad = 1";
			$result = mysqli_query($conn,$query);
			if (mysqli_num_rows($result) > 0)
			{
					echo "Students cleared to Graduate:";
					echo '<br>';
					echo '<br>';
					
					echo '<table class="table">';
		
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
						
						echo '<td><form action="transcript.php" method = "post">';
						echo '<input type="hidden" name="uid" value = "'.$student_id.'">';
						echo '<input type="hidden" name="permission" value = 1/>';
						echo '<button class="btn btn-primary" type="submit">View </button>';
						echo '</form>';
						echo '</td>';
						
						echo '<td><form action="viewStudentInfo.php" method = "post">';
						echo '<input type="hidden" name="uid" value = "'.$student_id.'">';
						echo '<input type="hidden" name="permission" value = 1/>';
						echo '<button class="btn btn-primary" type="submit">View</button>';
						echo '</form>';
						echo '</td>';
						
				
						echo '<td><form action="gradSuccess.php" method = "post">';
						echo '<input type="hidden" name="uid" value = "'.$student_id.'">';
						echo '<input type="hidden" name="permission" value = 1/>';
						echo '<input type="hidden" name="newGrad" value = 1/>';
						echo '<button class="btn btn-primary" type="submit">Graduate</button>';
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
	</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
