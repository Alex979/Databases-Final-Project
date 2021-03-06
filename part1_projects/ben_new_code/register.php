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
  <h1 class="text-primary">Register a New Account</h1>

  <form action="registerUser.php" method="post">Enter Information Below<br><br>
          <b>First Name</b><br> <input type="text" ID="fname" name="fname" required ><br>
          <b>Last Name</b><br> <input type="text" ID="lname" name="lname" required ><br>
          <b>Email</b><br> <input type="text" ID="email" name="email" required ><br>
          <b>Username</b><br> <input type="text" ID="username" name="username" required ><br>
          <b>Password</b><br> <input type="password" ID="password" name="password" required><br>
          <b>ID</b><br> <input type="number" ID="id" name="id" required><br>
          <b>Address</b><br> <input type="text" ID="address" name="address" required><br>
	  <b>Role</b><br> 
	  <select name="role">
  		<option value="student">Student</option>
  		<option value="alumni">Alumni</option>
  		<option value="advisor">Advisor</option>
  		<option value="gradSec">Graduate Secretary</option>
		<option value="sysAdmin">System Administrator</option>
	</select><br>
          <br><button class="button" style="vertical-align:middle"><span>Submit</span></button><br>
  </form>
  <form action="sysadmin.php">
    <button class="button" style="vertical-align:middle"><span>Return to HomePage</span></button>
  </form>
<?php
  	$sessRole = $_SESSION["role"];
	if ($sessRole != "sysAdmin")
	{
		header('Location: permissionDenied.html');
	}

    ?>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
