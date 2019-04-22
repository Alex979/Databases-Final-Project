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
<body>
  <h1>View Form 1</h1>

<?php
	$permission = 0;
	$permission = $_POST["permission"];
	if ($permission == 0)
	{
		header('Location: permissionDenied.html');
	}
	
	session_start();
	        $id = $_SESSION["id"];
  		$role = $_SESSION["role"];
	$student_id = $_POST["id"];
	
	    $servername = "localhost";
	    $username = "TeamEighteen";
	    $password = "DatabasePassword1!";
	    $dbname = "TeamEighteen";

      // define connection variable
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      // Check connection
      if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
      }
      // define the sql_insert_query
      $query = "SELECT * FROM formOne WHERE id = ".$student_id."";
      $result = mysqli_query($conn, $query) or die("Bad Query: $query");
      if(mysqli_num_rows($result) > 0){
      	echo "<table border='1'>";
      	echo "<tr><td>Number</td><td>Department</td><td>Course Number</td><tr>";
      	while($row = mysqli_fetch_assoc($result)) {
      	  echo "<tr><td>{$row['num']}</td><td>{$row['dept']}</td><td>{$row['courseNumber']}</td><tr>";
      	}
      	echo "</table>";
      }
      else{
	echo "<p>A Form 1 has not been submitted</p>";     
      }
	
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
      //close connection
        mysqli_close($conn);
    ?>
</body>
</html>


