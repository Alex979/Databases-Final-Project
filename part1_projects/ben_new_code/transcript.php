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
	<h1 class="text-primary">Transcripts</h1>
<?php
  $uid = $_SESSION["uid"];
	//check for permission
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
	  
  $uid = $_POST["uid"];
  $totalGPA = 0.0;
  $creditArray = array();
  $gradeArray = array();
  $numCredits = 0;
  $query = "SELECT uid, schedule.sid, course.cid, course.credits, enrolls.grade
		FROM enrolls, schedule, course 
			WHERE schedule.sid = enrolls.sid 
				AND course.cid = schedule.cid AND enrolls.uid = '$uid'";
  $result = mysqli_query($conn,$query);
  $numClasses = mysqli_num_rows($result);
  $x = 0;
  while($row = mysqli_fetch_array($result)){
    $creditArray[$x] = $row['credits'];
    $gradeArray[$x] = $row['grade'];
    $numCredits = $numCredits + $creditArray[$x];
    $x++;
  }
  
  for($x = 0; $x < $numClasses; $x++){
    if($gradeArray[$x] == "A"){
      $totalGPA = $totalGPA + (4.0 * $creditArray[$x]);
    }
    else if($gradeArray[$x] == "A-"){
      $totalGPA = $totalGPA + (3.7 * $creditArray[$x]);
    }
    else if($gradeArray[$x] == "B+"){
      $totalGPA = $totalGPA + (3.3 * $creditArray[$x]);
    }
    else if($gradeArray[$x] == "B"){
      $totalGPA = $totalGPA + (3.0 * $creditArray[$x]);
    }
    else if($gradeArray[$x] == "B-"){
      $totalGPA = $totalGPA + (2.7 * $creditArray[$x]);
    }
    else if($gradeArray[$x] == "C+"){
      $totalGPA = $totalGPA + (2.3 * $creditArray[$x]);
    }
    else if($gradeArray[$x] == "C"){
      $totalGPA = $totalGPA + (2.0 * $creditArray[$x]);
    }
  }
  $totalGPA = $totalGPA / $numCredits;
  
	$name_query = "SELECT * FROM user WHERE uid = '$uid'";
	$name_result = mysqli_query($conn,$name_query);
	if (mysqli_num_rows($name_result) > 0)
	{
		while ($name_row = mysqli_fetch_assoc($name_result))
		{
			$firstname = $name_row["fname"];
			$lastname = $name_row["lname"];
		}
	}
	
	
	$transcript_query = "SELECT uid, schedule.sid, course.cid, course.credits, enrolls.grade, course.courseNumber, course.title, course.dept, schedule.term
				FROM enrolls, schedule, course 
					WHERE schedule.sid = enrolls.sid 
						AND course.cid = schedule.cid AND enrolls.uid = '$uid'";
	$transcript_result = mysqli_query($conn,$transcript_query);	
		if (mysqli_num_rows($transcript_result) > 0)
		{
			echo 'Viewing transcript for ';
			echo $firstname;
			echo ' ';
			echo $lastname;
			echo ':';
			echo '<br>';
			echo '<br>';
			
			echo '<table class="table">';
   
       			echo '<tr><th>Semester</th>';
			echo '<th>Department</th>';
			echo '<th>Course Number</th>';
			echo '<th>Course Title</th>';
			echo '<th>Grade</th>';
      			echo '<th>Credit Hours</th></tr>';
			
    
			//output data of each row that query found as result	
			while ($row = mysqli_fetch_assoc($transcript_result))
			{	
			
				$term = $row["term"];
				$dept = $row["dept"];
				$courseNumber = $row["courseNumber"];
				$title = $row["title"];
				$grade = $row["grade"];	
				$credits = $row["credits"];
			
      				echo '<td>'.$term.'</td>';
				echo '<td>'.$dept.'</td>';
				echo '<td>'.$courseNumber.'</td>';
				echo '<td>'.$title.'</td>';
				echo '<td>'.$grade.'</td>';
      				echo '<td>'.$credits.'</td></tr>';
			}	
			echo '</table>';
			echo '<br>';
			echo 'Cumulative GPA: ';
			echo $totalGPA;
				
		}	
		else	
		{	
			echo "No transcript found";		
		}
  $uid = $_SESSION["uid"];
  $role = $_SESSION["role"];
	switch ($role) {
    	case "student":
		$destination = student;
       		 break;
    	case "advisor":
		$destination = advisor;
        	break;
   	case "gradSec":
        	$destination =  gradsec;
        	break;
	case "alumni":
        	$destination =  alumni;
        	break;
	case "sysAdmin":
        	$destination = sysadmin;
        	break;
	}
 ?>
	</div>
 	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
