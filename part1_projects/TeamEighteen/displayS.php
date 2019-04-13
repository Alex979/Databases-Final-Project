<html>
<head>
  <title>GWU Advising</title>
	<link rel="icon" href="http://www.gwrha.com/uploads/1/7/9/9/17997469/gw_atx_4cp_pos.png">
	<style>
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
  <link rel="stylesheet" href="style.css">
</head>
    <body>
<form action="changeView.php" method="post">
<button class="button" style="vertical-align:middle"><span>Back</span></button>
</form>
    </body>
</html>
<?php
session_start();
$role = $_SESSION["role"];
	if (($role != "sysAdmin"))
	{
		header('Location: permissionDenied.html');
	}

$servername = "localhost";
$username = "TeamEighteen";
$password = "DatabasePassword1!";
$dbname = "TeamEighteen";	
	
$conn = mysqli_connect($servername, $username, $password, $dbname);
		  
	if (!$conn) //Check if connection failed
	{	
		die("Connection failed: ".mysqli_connect_error());
	}
$query="SELECT * FROM users u,roles r WHERE u.id = r.id AND r.role='student'";
$result=mysqli_query($conn,$query);
echo 'Advisor Login Info: '; 
echo '<table style="width50%" border="1">';
echo '<tr><th>Username</th>';
echo '<th>Password</th></tr>';
if (mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_assoc($result))
		{
			$unamename = $row["username"];
			$pword = $row["password"];
      echo '<tr><td>'.$unamename.'</td>';
      echo '<td>'.$pword.'</td></tr>';
		}
  echo '</table>';
	}
else{
  echo "There are no students";
}
?>
