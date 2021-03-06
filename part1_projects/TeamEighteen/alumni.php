<html>
<head>
 <title>GWU Advising</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="style.css">
	<link rel="icon" href="http://www.gwrha.com/uploads/1/7/9/9/17997469/gw_atx_4cp_pos.png">
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
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

.edit_hover_class a{
visibility:hidden;
}
.edit_hover_class:hover a {
 visibility:visible;
}

</style>
</head>
<body class="w3-content" style="max-width:1200px">
<header class="w3-container w3-xlarge">
	<div class="w3-display-topleft w3-padding-large w3-xlarge"> </div>
    <p class="w3-left" style='font-size:45px;margin-top:30px'><b>GWU Advising</b></p>
    <p class="w3-right" style='margin-top:30px'>
      

	<?php
      	  session_start();
	        $id = $_SESSION["id"];
  		$role = $_SESSION["role"];
	if ($role != "alumni")
	{
		header('Location: permissionDenied.html');
	}
	
	 //logout
  echo '<table><td><form action="logout.php" method = "post">';
  echo '<input type="hidden" name="id" value = "'.$id.'"/>';
  echo '<input type="hidden" name="permission" value = 1/>';
  echo	'<div class="edit_hover_class">';    
  echo'<a href="logout.php">'; 
echo'<p>Logout </p>'; 
 echo'</a>'; 
  echo '<button class="glyphicon glyphicon-user" style="color:black;font-size:25px;box-shadow:none;background: none;border: none;"></button>';
 echo '</div>'; 
 echo '</form></td>';	
	    
	
      //edit personal info
  echo '<td><form action="editPersonalInfo.php" method = "post">';
  echo '<input type="hidden" name="id" value = "'.$id.'"/>';
  echo '<input type="hidden" name="permission" value = 1/>';
 echo	'<div class="edit_hover_class">';    
  echo'<a href="editPersonalInfo.php">'; 
echo'<p>Edit Info</p>'; 
 echo'</a>'; 
  echo '<button class="fas fa-pen" style="color:black;font-size:25px;box-shadow:none;background: none;border: none;"></button>';
   echo '</div>'; 
echo '</form></td>';		
	
	    //view personal info 
	     echo '<td><form action="viewStudentInfo.php" method = "post">';
  echo '<input type="hidden" name="id" value = "'.$id.'"/>';
  echo '<input type="hidden" name="permission" value = 1/>';
echo	'<div class="edit_hover_class">';    
  echo'<a href="viewStudentInfo.php">'; 
echo'<p>View Info </p>'; 
 echo'</a>'; 
  echo '<button class="fas fa-glasses" style="color:black;font-size:25px;box-shadow:none;background: none;border: none;"></button>';
  echo '</div>'; 
echo '</form></td>';
	    	 //transcript 
  echo '<td><form action="transcript.php" method = "post">';
  echo '<input type="hidden" name="id" value = "'.$id.'"/>';
  echo '<input type="hidden" name="permission" value = 1/>';
  echo	'<div class="edit_hover_class">';    
  echo'<a href="transcript.php">'; 
echo'<p>Transcript </p>'; 
 echo'</a>';  
  echo '<button class="fas fa-book-open" style="color:black;font-size:25px;box-shadow:none;background: none;border: none;"></button>';
 echo '</div>';
 echo '</form></td>';

	 //alumni home
  echo '<td><form action="alumni.php" method = "post">';
  echo '<input type="hidden" name="id" value = "'.$id.'"/>';
  echo '<input type="hidden" name="permission" value = 1/>';
  echo	'<div class="edit_hover_class">';    
  echo'<a href="alumni.php">'; 
echo'<p>Home </p>'; 
 echo'</a>';  
  echo '<button class="fa fa-home" style="color:black;font-size:25px;box-shadow:none;background: none;border: none;"></button>';
 echo '</div>';
 echo '</form></td></table></p></header>';	
	
	
	
	    
	
 
        echo '<form action="editPersonalInfo.php" method = "post">';
        echo '<input type="hidden" name="id" value = "'.$id.'"/>';
	       echo '<input type="hidden" name="permission" value = 1/><br>';
        echo '<button class="button" style="vertical-align:middle"><span>Edit Personal Info</span></button>';
  	     echo '</form>';
	    
	      echo '<form action="viewStudentInfo.php" method = "post">';
  echo '<input type="hidden" name="id" value = "'.$id.'"/>';
  echo '<input type="hidden" name="permission" value = 1/>';
  echo '<br><button class="button" style="vertical-align:middle"><span>View Personal Info</span></button>';
  echo '</form>';
	
 
 
  	      echo '<form action="transcript.php" method = "post">';
         echo '<input type="hidden" name="id" value = "'.$id.'"/>';
	        echo '<input type="hidden" name="permission" value = 1/>';
        echo '<button class="button" style="vertical-align:middle"><span>View Transcript</span></button>';
  	     echo '</form>';
      ?>

</body>
</html>
