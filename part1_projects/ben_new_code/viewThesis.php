<?php
  session_start();
?>
<html>
<head>
  <title>GWU Advising</title>
  <link rel="icon" href="http://www.gwrha.com/uploads/1/7/9/9/17997469/gw_atx_4cp_pos.png">
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
<?php
	/* Create connection */
	$servername = "127.0.0.1";
	$username = "Team_Name";
	$password = "p@ssW0RD";
	$dbname = "Team_Name";	
	$fname = "";
        $lname = "";
        $paper = "";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) //Check if connection failed
	{	
		die("Connection failed: ".mysqli_connect_error());
	}
	$uid = $_POST["uid"];
        echo '<p>uid: '.$uid.'</p>';
  $query = "SELECT fname, lname FROM user WHERE uid = '$uid'";
  $result = mysqli_query($conn,$query);
  while ($row = mysqli_fetch_assoc($result))
  {
    $fname = $student_row["fname"];
    $lname = $student_row["lname"];
  }
  echo "<h1 class='text-primary'>Thesis of ".$fname." ".$lname."</h1>";
  $student_query = "SELECT paper FROM thesis WHERE uid ='$uid'";
	$student_result = mysqli_query($conn,$student_query);
	if (mysqli_num_rows($student_result) > 0)
	{
		while ($student_row = mysqli_fetch_assoc($student_result))
		{
			$paper = $student_row["paper"];
		}
	}
	
  echo 'Thesis: '.$paper.'<br>';
  echo '<br><br><br>';

mysqli_close($conn);
 ?>
		</div>
 	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
	</html>
