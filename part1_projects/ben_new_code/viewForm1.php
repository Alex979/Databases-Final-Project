<html>
<head>
  <title>GWU Advising</title>
<link rel="icon" href="http://www.gwrha.com/uploads/1/7/9/9/17997469/gw_atx_4cp_pos.png">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>View Form 1</h1>

<?php
	
	session_start();
	        $uid = $_SESSION["uid"];
  		$role = $_SESSION["role"];
	$student_id = $_POST["uid"];
	
	    $servername = "localhost";
	    $username = "Team_Name";
	    $password = "p@ssW0RD";
	    $dbname = "Team_Name";

      // define connection variable
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      // Check connection
      if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
      }
      // define the sql_insert_query
      $query = "SELECT * FROM formOne WHERE uid = ".$uid."";
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
	
	echo '<form action="dashboard.php" method = "post">';
        echo '<input type="hidden" name="id" value = "'.$uid.'"/>';
	echo '<input type="hidden" name="permission" value = 1/>';
        echo '<button class="button" style="vertical-align:middle"><span>Return to Home Page</span></button>';
  	echo '</form>';
      //close connection
        mysqli_close($conn);
    ?>
</body>
</html>


