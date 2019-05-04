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
	<h1 class="text-primary">User Registration Error</h1>
<?php
  	$sessRole = $_SESSION["role"];
	if ($sessRole != "sysAdmin")
	{
		header('Location: permissionDenied.html');
	}
	
     
	    $servername = "localhost";
	    $uname = "Team_Name";
	    $pword = "p@ssW0RD";
	    $dbname = "Team_Name";
      // define connection variable
      $conn = mysqli_connect($servername, $uname, $pword, $dbname);
      // Check connection
      if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
      }
	
	
	$noReg = 0;
	$fname = $_POST['fname'];
  	$lname = $_POST['lname'];
   	$email = $_POST['email'];
   	$uid = $_POST['uid'];
   	$username = $_POST['username'];
  	$password = $_POST['password'];
   	$address = $_POST['address'];
   	$role = $_POST['role'];
	
		
	$id_query = "SELECT * FROM user WHERE uid LIKE '%".$uid."%'";
	$id_result = mysqli_query($conn,$id_query);
	if (mysqli_num_rows($id_result) > 0)
	{
		echo 'This id is already taken. Please select a different id.  ';
		$noReg = 1;
	}
	
	$username_query = "SELECT * FROM user WHERE username LIKE '%".$username."%'";
	$username_result = mysqli_query($conn,$username_query);
	if (mysqli_num_rows($username_result) > 0)
	{
		echo 'This username is already taken. Please select a different username.  ';
		$noReg = 1;
	}
	
		
		
		if($noReg != 1)
		{
			echo 'time to register';
     		 	$query = "INSERT INTO users (uid, email, fname, lname, username, password, city, balance) VALUES ('$uid', '$email', '$fname', '$lname', '$username', '$password', '$address', 0.00)";
      			$result = mysqli_query($conn, $query);
      			if($result){
				$role_query = "INSERT INTO role (uid, type) VALUES ('$uid', '$role')";
        			$role_result = mysqli_query($conn, $role_query);
        			header('Location: sysadmin.php');
				echo '<br>';
				echo 'done';
			}
      		}
      //close connection
        mysqli_close($conn);
    ?>
	<a href="register.php">Go Back</a><br>
</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
