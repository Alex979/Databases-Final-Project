<html>
<head>
  <title>GWU Advising</title>
	<link rel="icon" href="http://www.gwrha.com/uploads/1/7/9/9/17997469/gw_atx_4cp_pos.png">
</head>
<body>
	<h1>User Registration Error</h1>
<?php
	session_start();
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
</body>
</html>
