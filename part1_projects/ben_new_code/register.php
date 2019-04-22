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
