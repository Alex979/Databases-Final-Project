
<html>
<head>
  <title>GWU Advising</title>

  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>GWU Advising</h1>

<?php
      $uname = $_POST['username'];
      $pword = $_POST['password'];
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
	
	$id = 0;
	
	$id_query = "SELECT * FROM users WHERE username LIKE '%".$uname."%' AND password LIKE '%".$pword."%'";
	$id_result = mysqli_query($conn,$id_query);
	if (mysqli_num_rows($id_result) > 0)
	{
		while ($id_row = mysqli_fetch_assoc($id_result))
		{
			$id = $id_row["id"];
			$fname = $id_row["fname"];
			$lname = $id_row["lname"];
			session_start();
			$_SESSION["id"] = $id;
			$_SESSION["fname"] = $fname;
			$_SESSION["lname"] = $lname;
		}
	}
	
	$role = "none";
	
	$role_query = "SELECT * FROM roles WHERE id LIKE '%".$id."%'";
	$role_result = mysqli_query($conn,$role_query);
	if (mysqli_num_rows($role_result) > 0)
	{
		while ($role_row = mysqli_fetch_assoc($role_result))
		{
			$role = $role_row["role"];
			$_SESSION["role"] = $role;
		}
	}
	
	switch ($role) {
    	case "student":
		header('Location: calcGPA.php');
       		 break;
    	case "advisor":
		header('Location: advisor.php');
        	break;
   	case "gradSec":
        	header('Location: gradsec.php');
        	break;
	case "alumni":
        	header('Location: calcGPA.php');
        	break;
	case "sysAdmin":
        	header('Location: sysadmin.php');
        	break;
	case "none":
		echo "You do not have an account!";
        	break;
    	default:
        	echo "Error, your login credentials are not assigned to a role in this university!";
	}
	
      //close connection
        mysqli_close($conn);
    ?>

</body>
</html>
