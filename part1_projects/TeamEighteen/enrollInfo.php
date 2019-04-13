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
  <h1>Enrollment Information</h1>
<p> Search Courses Taken of in Progress from Given Semester</p><br>
<form action="takenThisYear.php" method="post">
  <select name="year">
    <option value="2018">2018</option>
    <option value="2019">2019</option>
    <option value="2020">2020</option>
    <option value="2021">2021</option>
  </select>
  <select name="semester">
    <option value="Spring">Spring</option>
    <option value="Fall">Fall</option>
  </select>
  <input type="submit" value="Search"/>
</form>

<?php
	  session_start();
	$id = $_SESSION["id"];
	$role = $_SESSION["role"];
	if ($role != "student" && $role != "gradSec")
	{
		header('Location: permissionDenied.html');
	}
	$id = $_POST["id"];
	
	echo '<form action= "viewForm1.php" method="post">';
	echo '<input type="hidden" name="id" value = "'.$id.'">';
	echo '<input type="hidden" name="permission" value = 1/>';
    	echo '<button class="button" style="vertical-align:middle"><span>View Form 1</span></button>';
	echo '</form>';
	
  	echo '<form action="transcript.php" method = "post">';
        echo '<input type="hidden" name="id" value = "'.$id.'"/>';
	echo '<input type="hidden" name="permission" value = 1/>';
        echo '<button class="button" style="vertical-align:middle"><span>View Transcript</span></button>';
  	echo '</form>';
	
	
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
      echo "<b>Searched Courses: </b>";
      // define the sql_insert_query
      $query = "SELECT * FROM taken WHERE id = ".$id."";
      $result = mysqli_query($conn, $query) or die("Bad Query: $query");
      if(mysqli)
      echo "<table border='1'>";
      echo "<tr><td>Course Title</td><td>Course Number</td><td>Department</td><td>Section</td><td>Year</td><td>Semester</td><td>Grade</td><tr>";
              while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>{$row['courseTitle']}</td><td>{$row['courseNumber']}</td><td>{$row['dept']}</td><td>{$row['section']}</td><td>{$row['year']}</td><td>{$row['semester']}</td><td>{$row['grade']}</td><tr>";
      }
      echo "</table>";
	
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
