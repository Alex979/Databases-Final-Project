<html>
<head>
  <title>GWU Advising</title>
	<link rel="icon" href="http://www.gwrha.com/uploads/1/7/9/9/17997469/gw_atx_4cp_pos.png">
  <link rel="stylesheet" href="style.css">

</head>
<body>
  <h1>Register a New Account</h1>

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
	session_start();
  	$sessRole = $_SESSION["role"];
	if ($sessRole != "sysAdmin")
	{
		header('Location: permissionDenied.html');
	}

    ?>
</body>
</html>
