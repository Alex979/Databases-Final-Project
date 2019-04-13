<!DOCTYPE html>
<html>
<head>
  <title>GWU Advising</title>
	<link rel="icon" href="http://www.gwrha.com/uploads/1/7/9/9/17997469/gw_atx_4cp_pos.png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.dropbtn {
  background-color: #000000;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}
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
</style>
</head>
<body>
<?php
session_start();
$role = $_SESSION["role"];
	if (($role != "sysAdmin"))
	{
		header('Location: permissionDenied.html');
	}
	echo '<form action="sysadmin.php" method = "post">';
        echo '<input type="hidden" name="id" value = "'.$id.'"/>';
	echo '<input type="hidden" name="permission" value = 1/>';
        echo '<button class="button" style="vertical-align:middle"><span>Back</span></button>';
  	echo '</form>';
     ?>	
	<br>
<div class="dropdown">
<form action="changeView.php" method = "post">
  <button class="dropbtn">Users</button>
  <div class="dropdown-content">
    <a href="displaySA.php">Systems Admin</a>
    <a href="displayGS.php">Graduate Secretary</a>
    <a href="displayS.php">Student</a>
    <a href="displayA.php">Alumni</a>    
    <a href="displayFA.php">Faculty Advisor</a>
  </div>
</form>
</div>
	
	
</body>
</html>
