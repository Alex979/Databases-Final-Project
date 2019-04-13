<html>
<head>
  <title>GWU Advising</title>
  <link rel="stylesheet" href="style.css">
	<link rel="icon" href="http://www.gwrha.com/uploads/1/7/9/9/17997469/gw_atx_4cp_pos.png">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="style.css">
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
<style>
.button {
  display: inline-block;
  padding: 15px 25px;
  font-size: 16px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #ffffff;
  background-color: #7a7a7a;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}

.button:hover {background-color: #000000}

.button:active {
  background-color: #000000;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
.tableStyle {
  border-collapse: collapse;
  width: 100%;
}

.thStyle, .tdStyle {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}
</style>
</head>
  <body>

<?php
	session_start();
  	$advisorid = $_SESSION["id"];
  	$role = $_SESSION["role"];
	if ($role != "advisor")
	{
		header('Location: permissionDenied.html');
	}
	  
	   echo '<header class="w3-container w3-xlarge">';
	echo '<div class="w3-display-topleft w3-padding-large w3-xlarge"> </div>';
    echo '<p class="w3-left" style="font-size:45px;margin-top:30px"><b>GWU Advising</b></p>';
    echo '<p class="w3-right" style="margin-top:30px">';
	
      //logout
  echo '<table><td><form action="logout.php" method = "post">';
  echo '<input type="hidden" name="id" value = "'.$advisorid.'"/>';
  echo '<input type="hidden" name="permission" value = 1/>';
  echo '<button class="glyphicon glyphicon-user" style="color:black;font-size:25px;box-shadow:none;background: none;border: none;"></button>';
  echo '</form></td>';	
	
	
      //advisor home
  echo '<td><form action="advisor.php" method = "post">';
  echo '<input type="hidden" name="id" value = "'.$advisorid.'"/>';
  echo '<input type="hidden" name="permission" value = 1/>';
  echo '<button class="fa fa-home" style="color:black;font-size:25px;box-shadow:none;background: none;border: none;"></button>';
  echo '</form></td></table>';
  echo '</p></header>';	
	  
	/* Create connection */
	$servername = "localhost";
	$username = "TeamEighteen";
	$password = "DatabasePassword1!";
	$dbname = "TeamEighteen";	
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);
		  
	if (!$conn) //Check if connection failed
	{	
		die("Connection failed: ".mysqli_connect_error());
	}
	  
	  

	$name_query = "SELECT * FROM users WHERE id LIKE '%".$advisorid."%'";
	$name_result = mysqli_query($conn,$name_query);
	if (mysqli_num_rows($name_result) > 0)
	{
		while ($name_row = mysqli_fetch_assoc($name_result))
		{
			$firstname = $name_row["fname"];
			$lastname = $name_row["lname"];
		}
	}

	$advisee_query = "SELECT * FROM users WHERE advisorid LIKE '%".$advisorid."%'";
	$advisee_result = mysqli_query($conn,$advisee_query);
	if (mysqli_num_rows($advisee_result) > 0)
	{

			echo '    ';
			echo $firstname;
			echo ' ';
			echo $lastname;
			echo "'s Advisees:";
			echo '<br>';
			
			echo '<table class="tableStyle" style="width50%" border="1">';
   
      			echo '<tr class="trStyle"><th>Name</th>';
			echo '<th class="thStyle">Information</th>';
			echo '<th class="thStyle">Transcript</th>';
			echo '<th class="thStyle">Form 1</th>';
			
    
			//output data of each row that query found as result	
			while ($row = mysqli_fetch_assoc($advisee_result))
			{	
				$fname = $row["fname"];
				$lname = $row["lname"];
				$id = $row["id"];
				
				echo '<tr class="trStyle"><td class="tdStyle">'.$fname.' '.$lname.'</td>';
				
      				echo '<td class="tdStyle">';
				echo '<form action= "viewStudentInfo.php" method="post">';
				echo '<input type="hidden" name="id" value = "'.$id.'">';
				echo '<br><input type="hidden" name="permission" value = 1/><br>';
    				echo '<button class="button">View</button>';
				echo '</form>';
				echo '</td>';
				
				echo '<td class="tdStyle">';		
				echo '<form action= "transcript.php" method="post">';
				echo '<input type="hidden" name="id" value = "'.$id.'">';
				echo '<br><input type="hidden" name="permission" value = 1/><br>';
    				echo '<button class="button">View</button>';
				echo '</form>';
				echo '</td>';
				
				echo '<td class="tdStyle">';
				echo '<form action= "viewForm1.php" method="post">';
				echo '<input type="hidden" name="id" value = "'.$id.'">';
				echo '<br><input type="hidden" name="permission" value = 1/><br>';
    				echo '<button class="button">View</button>';
				echo '</form>';
				echo '</td></tr>';
			}	
			echo '</table>';
			echo '<br>';
				
		}	
		else	
		{	
			echo "No advisees found.";		
		}
	  echo '</div>';
 ?>
  </body>
</html>

