<html>
<head>

    <title>GWU Advising</title>
  <link rel="icon" href="http://www.gwrha.com/uploads/1/7/9/9/17997469/gw_atx_4cp_pos.png">
<link rel="stylesheet" href="style.css">

</head>
<?php
  session_start();
  $uid = $_SESSION["user_id"];
  $role = $_SESSION["role"];
  $fname = $_POST["fname"]; 
  $lname = $_POST["lname"]; 
  $email =$_POST["email"]; 
  $address = $_POST["address"]; 

        $servername="localhost";	
	$username = "Team_Name";
	$password = "p@ssW0RD";
	$dbname = "Team_Name";
        $conn=mysqli_connect($servername,$username,$password, $dbname);	
	if (!$conn){	
		   die("Connection failed:".mysqli_connect_error());	
	}
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
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
		if (isset($street)){
		  $query4 = "UPDATE user SET city='$street' WHERE uid='$uid'";
		  $result4=mysqli_query($conn,$query4); 
		}
		if (isset($city)){
		  $query4 = "UPDATE user SET city='$city' WHERE uid='$uid'";
		  $result4=mysqli_query($conn,$query4); 
		}
		if (isset($state)){
		  $query4 = "UPDATE user SET city='$state' WHERE uid='$uid'";
		  $result4=mysqli_query($conn,$query4); 
		}
		if (isset($zip)){
		  $query4 = "UPDATE user SET city='$zip' WHERE uid='$uid'";
		  $result4=mysqli_query($conn,$query4); 
		}
		header("Location: ../FlatEarthSociety/public_html/info.php");
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
    echo '<b>Street: </b> <br><input type="text" ID="street" name="street" ><br><br>';
    echo '<b>City: </b> <br><input type="text" ID="street" name="city" ><br><br>';
    echo '<b>State: </b> <br><input type="text" ID="street" name="state" ><br><br>';
    echo '<b>Zipcode: </b> <br><input type="text" ID="street" name="zip" ><br><br>';
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
	
	echo '<form action="../FlatEarthSociety/public_html/dashboard.php" method = "post">';
        echo '<input type="hidden" name="uid" value = "'.$uid.'"/>';
	echo '<input type="hidden" name="permission" value = 1/>';
        echo '<button class="button" style="vertical-align:middle"><span>Return to Home Page</span></button>';
  	echo '</form>';
     ?>
</body>
</html>
