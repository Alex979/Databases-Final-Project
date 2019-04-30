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
<?php

  $uid = $_SESSION["user_id"];
  $role = $_SESSION["role"];
  $fname = $_POST["fname"]; 
  $lname = $_POST["lname"]; 
  $email =$_POST["email"]; 
  $street = $_POST["street"]; 
  $city = $_POST["city"]; 
  $state = $_POST["state"]; 
  $zip = $_POST["zip"]; 
	

	$servername="127.0.0.1";	
	$username = "Team_Name";
	$password = "p@ssW0RD";
	$dbname = "Team_Name";
        $conn=mysqli_connect($servername,$username,$password, $dbname);	
	if (!$conn){	
		   die("Connection failed:".mysqli_connect_error());	
	}
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if (!empty($fname)){
		  $query = "UPDATE user SET fname='$fname' WHERE uid='$uid'";
		  $result=mysqli_query($conn,$query); 

		}
		if (!empty($lname)){
		  $query2 = "UPDATE user SET lname='$lname' WHERE uid='$uid'";
		  $result2=mysqli_query($conn,$query2); 
		}
		if (!empty($email)){
		  $query3 = "UPDATE user SET email='$email' WHERE uid='$uid'";
		  $result3=mysqli_query($conn,$query3); 
		}
		if (!empty($street)){
		  $query4 = "UPDATE user SET street='$street' WHERE uid='$uid'";
		  $result4=mysqli_query($conn,$query4); 
		}
		if (!empty($city)){
		  $query4 = "UPDATE user SET city='$city' WHERE uid='$uid'";
		  $result4=mysqli_query($conn,$query4); 
		}
		if (!empty($state)){
		  $query4 = "UPDATE user SET state='$state' WHERE uid='$uid'";
		  $result4=mysqli_query($conn,$query4); 
		}
		if (!empty($zip)){
		  $query4 = "UPDATE user SET zip='$zip' WHERE uid='$uid'";
		  $result4=mysqli_query($conn,$query4); 
		}
		header("Location: ../FlatEarthSociety/public_html/info.php");
	}
        mysqli_close($conn);
  ?>
<body>
	<?php
  include('../FlatEarthSociety/public_html/navbar.php');
  ?>
	<div class="container mt-3">
	<?php
	echo '<h1 class="text-primary">Edit your personal information</h1>';
	echo '<form action="editPersonalInfo.php" method="post" style="max-width: 500px" >';
			echo '
			<div class="form-group">
				<label>First Name</label>
				<input class="form-control" type="text" ID="fname" name="fname">
			</div>
			';
			echo '
			<div class="form-group">
				<label>Last Name</label>
				<input class="form-control" type="text" ID="lname" name="lname">
			</div>
			';
			echo '
			<div class="form-group">
				<label>Email</label>
				<input class="form-control" type="text" ID="email" name="email">
			</div>
			';
			echo '
			<div class="form-group">
				<label>Street</label>
				<input class="form-control" type="text" ID="street" name="street" >
			</div>
			';
			echo '
			<div class="form-group">
				<label>City</label>
				<input class="form-control" type="text" ID="city" name="city" >
			</div>
			';
			echo '
			<div class="form-group">
				<label>State</label>
				<input class="form-control" type="text" ID="state" name="state" >
			</div>
			';
			echo '
			<div class="form-group">
				<label>Zip Code</label>
				<input class="form-control" type="text" ID="zip" name="zip" >
			</div>
			';
			echo '<button class="btn btn-primary" style="vertical-align:middle"><span>Update</span></button>';
		echo '</form>';

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
			?>
	</div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
