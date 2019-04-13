<html>
<head>
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
  <link rel="stylesheet" href="style.css">
</head>
<h1>Transcripts</h1>
</html>

<?php
  session_start();
  $id = $_SESSION["id"];
  $role = $_SESSION["role"];
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
	  
  $id = $_POST["id"];
  $totalGPA = 0.0;
  $creditArray = array();
  $gradeArray = array();
  $numCredits = 0;
  $role = "";
  $query = "SELECT * FROM taken WHERE id = '$id'";
  $result = mysqli_query($conn,$query);
  $numClasses = mysqli_num_rows($result);
  $x = 0;
  while($row = mysqli_fetch_array($result)){
    $creditArray[$x] = $row['creditHours'];
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
  $query2 = "UPDATE taken SET gpa = '$totalGPA' WHERE id = '$id'";
  $result2 = mysqli_query($conn,$query2);
  


	$name_query = "SELECT * FROM users WHERE id LIKE '%".$id."%'";
	$name_result = mysqli_query($conn,$name_query);
	if (mysqli_num_rows($name_result) > 0)
	{
		while ($name_row = mysqli_fetch_assoc($name_result))
		{
			$firstname = $name_row["fname"];
			$lastname = $name_row["lname"];
		}
	}
	
	

	$transcript_query = "SELECT * FROM taken WHERE id LIKE '%".$id."%'";
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
			
			echo '<table style="width50%" border="1">';
   
       			echo '<tr><th>Semester</th>';
      			echo '<th>Year</th>';
			echo '<th>Department</th>';
			echo '<th>Course Number</th>';
			echo '<th>Course Title</th>';
			echo '<th>Grade</th>';
      			echo '<th>Credit Hours</th></tr>';
			
    
			//output data of each row that query found as result	
			while ($row = mysqli_fetch_assoc($transcript_result))
			{	
				$semester = $row["semester"];
				$year = $row["year"];
				$dept = $row["dept"];
				$courseNumber = $row["courseNumber"];
				$courseTitle = $row["courseTitle"];
				$grade = $row["grade"];	
				$creditHours = $row["creditHours"];
				$gpa = $row["gpa"];
				
				echo '<tr><td>'.$semester.'</td>';
      				echo '<td>'.$year.'</td>';
				echo '<td>'.$dept.'</td>';
				echo '<td>'.$courseNumber.'</td>';
				echo '<td>'.$courseTitle.'</td>';
				echo '<td>'.$grade.'</td>';
      				echo '<td>'.$creditHours.'</td></tr>';
			}	
			echo '</table>';
			echo '<br>';
			echo 'Cumulative GPA: ';
			echo $gpa;
				
		}	
		else	
		{	
			echo "No transcript found";		
		}

  $id = $_SESSION["id"];
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
	
	echo '<form action="'.$destination.'.php" method = "post">';
        echo '<input type="hidden" name="id" value = "'.$id.'"/>';
	echo '<input type="hidden" name="permission" value = 1/>';
        echo '<button class="button" style="vertical-align:middle"><span>Return to Home Page</span></button>';
  	echo '</form>';
	
 ?>
