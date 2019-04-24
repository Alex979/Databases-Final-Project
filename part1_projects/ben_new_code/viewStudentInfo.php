<html>
<head>
  <title>GWU Advising</title>
  <link rel="icon" href="http://www.gwrha.com/uploads/1/7/9/9/17997469/gw_atx_4cp_pos.png">
  <link rel="stylesheet" href="style.css">
</head>
<h1>Student Information</h1>

<body>

<?php
  session_start();
  $id = $_SESSION["uid"];
  $role = $_SESSION["role"];

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
	  
	$uid = $_POST["uid"];

	$student_query = "SELECT * FROM user WHERE uid LIKE '%".$uid."%'";
	$student_result = mysqli_query($conn,$student_query);
	if (mysqli_num_rows($student_result) > 0)
	{
		while ($student_row = mysqli_fetch_assoc($student_result))
		{
			$firstname = $student_row["fname"];
			$lastname = $student_row["lname"];
      			$email = $student_row["email"];
      			$address = $student_row["city"];
      			$balance = $student_row["balance"];
		}
	}
	
  echo 'Name: '.$firstname.' '.$lastname.'<br>';
  echo 'University ID: '.$id.'<br>';
  echo 'Email: '.$email.'<br>';
  echo 'Address: '.$city.'<br>';
  echo 'Balance: $'.$balance.'<br>';
  echo '<form action="student.php" method = "post"></form>';
  echo '<br><br><br>';

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
	
	echo '<form action="'.$destination.'.php" method = "post">';
        echo '<input type="hidden" name="id" value = "'.$uid.'"/>';
	echo '<input type="hidden" name="permission" value = 1/>';
        echo '<button class="button" style="vertical-align:middle"><span>Return to Home Page</span></button>';
  	echo '</form>';

mysqli_close($conn);
 ?>
	</body>
	</html>