<?php
	session_start();
	$server = "localhost";
    $username = "jacobcannizzaro";
    $password = "seas";
    $dbname = "apps";
    $conn = mysqli_connect($server,$username,$password,$dbname);
    
        // Check connection
    if(!$conn){
      die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully <br/>";
    ?>
    