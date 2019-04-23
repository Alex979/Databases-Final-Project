<html>
<head>

    <title>GWU Advising</title>
  <link rel="icon" href="http://www.gwrha.com/uploads/1/7/9/9/17997469/gw_atx_4cp_pos.png">
<link rel="stylesheet" href="style.css">

</head>
<?php
  session_start();
  $uid = $_SESSION["uid"];
  $role = $_SESSION["role"];
  $fname = $_POST["fname"]; 
  $lname = $_POST["lname"]; 
  $email =$_POST["email"]; 
  $address = $_POST["address"]; 
	if (($role != "student") && ($role != "alumni"))
	{
		header('Location: permissionDenied.html');
	}
        $servername="localhost";	
	$username = "Team_Name";
	$password = "p@ssW0RD";
	$dbname = "Team_Name";		
        $conn=mysqli_connect($servername,$username,$password, $dbname);	
	if (!$conn){	
		   die("Connection failed:".mysqli_connect_error());	
	}		
	if (isset($fname)){
	  $query = "UPDATE user SET fname='$fname' WHERE uid='$uid'";
	  $result=mysqli_query($conn,$query); 
	}
	if (isset($lname)){
	  $query2 = "UPDATE user SET lname='$lname' WHERE uid='$uid'";
	  $result2=mysqli_query($conn,$query2); 
	}
	if (isset($email)){
	  $query3 = "UPDATE user SET email='$email' WHERE uid='$uid'";
	  $result3=mysqli_query($conn,$query3); 
	}
	if (isset($address)){
	  $query4 = "UPDATE user SET city='$address' WHERE uid='$uid'";
	  $result4=mysqli_query($conn,$query4); 
	}
        mysqli_close($conn);
  ?>
<body>
<?php
echo '<h2>Edit your personal information</h2>';
echo '<form action="editPersonalInfo.php" method="post"><b>Update: </b><br><br>';
    echo '<b>First Name: </b> <br><input type="text" ID="fname" name="fname"><br>';
    echo '<b>Last Name: </b> <br><input type="text" ID="lname" name="lname"><br>';
    echo '<b>Email: </b> <br><input type="text" ID="email" name="email"><br>';
    echo '<b>Address: </b> <br><input type="text" ID="address" name="address" ><br><br>';
    echo '<button class="button" style="vertical-align:middle"><span>Update</span></button>';
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
	
	echo '<form action="'.$destination.'.php" method = "post">';
        echo '<input type="hidden" name="id" value = "'.$id.'"/>';
	echo '<input type="hidden" name="permission" value = 1/>';
        echo '<button class="button" style="vertical-align:middle"><span>Return to Home Page</span></button>';
  	echo '</form>';
     ?>
</body>
</html>
