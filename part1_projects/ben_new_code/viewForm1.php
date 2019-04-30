<?php
session_start();
$uid = $_SESSION["uid"];
$role = $_SESSION["role"];
$student_id = $_POST["uid"];

$servername = "127.0.0.1";
$username = "Team_Name";
$password = "p@ssW0RD";
$dbname = "Team_Name";

// define connection variable
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if(!$conn){
	die("Connection failed: " . mysqli_connect_error());
}
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
  <h1 class="text-primary">View Form 1</h1>

<?php
      // define the sql_insert_query
      $query = "SELECT * FROM formOne WHERE uid = '$uid'";
      $result = mysqli_query($conn, $query) or die("Bad Query: $query");
      if(mysqli_num_rows($result) > 0){
      	echo "<table border='1' class=\"table\">";
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
	
      //close connection
        mysqli_close($conn);
    ?>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>


