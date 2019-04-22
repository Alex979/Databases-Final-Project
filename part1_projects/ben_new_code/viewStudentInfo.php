<html>
<head>
  <title>GWU Advising</title>
  <link rel="icon" href="http://www.gwrha.com/uploads/1/7/9/9/17997469/gw_atx_4cp_pos.png">
  <link rel="stylesheet" href="style.css">
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
</head>
<h1>Student Information</h1>

<body>

<?php
  session_start();
  $id = $_SESSION["id"];
  $role = $_SESSION["role"];

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

	$student_query = "SELECT * FROM users WHERE id LIKE '%".$id."%'";
	$student_result = mysqli_query($conn,$student_query);
	if (mysqli_num_rows($student_result) > 0)
	{
		while ($student_row = mysqli_fetch_assoc($student_result))
		{
			$firstname = $student_row["fname"];
			$lastname = $student_row["lname"];
      $email = $student_row["email"];
      $address = $student_row["address"];
      $balance = $student_row["balance"];
		}
	}
	
	echo 'Name: '.$firstname.' '.$lastname.'<br>';
  echo 'University ID: '.$id.'<br>';
  echo 'Email: '.$email.'<br>';
  echo 'Address: '.$address.'<br>';
  echo 'Balance: $'.$balance.'<br>';
  echo '<form action="student.php" method = "post"></form>';
  echo '<br><br><br>';

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

mysqli_close($conn);
 ?>
	</body>
	</html>
