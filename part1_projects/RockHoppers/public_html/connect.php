<?php 
	session_start();
    $server = "localhost";
    $username = "Team_Name";
    $password = "p@ssW0RD";
    $dbname = "Team_Name";
    $conn = mysqli_connect($server,$username,$password,$dbname);
    
        // Check connection
    if(!$conn){
      die("Connection failed: " . mysqli_connect_error());
    }
    //echo "Connected successfully <br/>";
    ?>
    
