<html>
<head>
  <title>GWU Advising</title>
	<link rel="icon" href="http://www.gwrha.com/uploads/1/7/9/9/17997469/gw_atx_4cp_pos.png">
  <link rel="stylesheet" href="style.css">
	<style>
table {
  border-collapse: collapse;
  width: 100%;
}
th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}
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
	</style>
</head>
<body>
  <h1>GWU Course Catalog</h1>
<form action="searchCourse.php" method="post">
  <input type="text" ID="search" name="search"/>
  <input type="submit" value="Search Course"/>
</form>


<form action="courseCatalog.php" method="post">
<button class="button" style="vertical-align:middle"><span>View All Courses</span></button>
</form>

<?php
	  session_start();
  $id = $_SESSION["id"];
  $role = $_SESSION["role"];
	if ($role != "student")
	{
		header('Location: permissionDenied.html');
	}
	
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
      echo "All Courses";
      // define the sql_insert_query
      $query = "SELECT * FROM courseCatalog";
      $result = mysqli_query($conn, $query) or die("Bad Query: $query");
      echo "<table border='1'>";
      echo "<tr><td>Course Number</td><td>Title</td><td>Credits</td><td>Department</td><td>Pre-Requisite 1</td><td>Pre-Requisite 2</td><tr>";
              while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>{$row['courseNumber']}</td><td>{$row['title']}</td><td>{$row['credits']}</td><td>{$row['dept']}</td><td>{$row['preRequisite1']}</td><td>{$row['preRequisite2']}</td><tr>";
      }
      echo "</table>";
	echo '<form action="student.php" method = "post">';
        echo '<input type="hidden" name="id" value = "'.$id.'"/>';
	echo '<input type="hidden" name="permission" value = 1/>';
        echo '<button class="button" style="vertical-align:middle"><span>Return to Student Page</span></button>';
  	echo '</form>';
      //close connection
        mysqli_close($conn);
    ?>
</body>
</html>

