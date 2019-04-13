<?php
  $servername = "localhost";
  $username = "TeamEighteen";
  $password = "DatabasePassword1!";
  $dbname = "TeamEighteen";

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
  }
  session_start();
  $id = $_SESSION["id"];
  $totalGPA = 0.0;
  $creditArray = array();
  $gradeArray = array();
  $numCredits = 0;
  $role = "";
  $query = "SELECT * FROM taken WHERE id = '$id'";
  $result = mysqli_query($conn,$query);
  $numClasses = mysqli_num_rows($result);
  $x = 0;
  while($row = mysqli_fetch_array($result)){
    $creditArray[$x] = $row['creditHours'];
    $gradeArray[$x] = $row['grade'];
    echo "<p>creditArray[".$x."]: ".$creditArray[$x]."</p><br>";
    echo "<p>gradeArray[".$x."]: ".$gradeArray[$x]."</p><br>";
    $numCredits = $numCredits + $creditArray[$x];
    $x++;
  }
  
  for($x = 0; $x < $numClasses; $x++){
    if($gradeArray[$x] == "A"){
      $totalGPA = $totalGPA + (4.0 * $creditArray[$x]);
    }
    else if($gradeArray[$x] == "A-"){
      $totalGPA = $totalGPA + (3.7 * $creditArray[$x]);
    }
    else if($gradeArray[$x] == "B+"){
      $totalGPA = $totalGPA + (3.3 * $creditArray[$x]);
    }
    else if($gradeArray[$x] == "B"){
      $totalGPA = $totalGPA + (3.0 * $creditArray[$x]);
    }
    else if($gradeArray[$x] == "B-"){
      $totalGPA = $totalGPA + (2.7 * $creditArray[$x]);
    }
    else if($gradeArray[$x] == "C+"){
      $totalGPA = $totalGPA + (2.3 * $creditArray[$x]);
    }
    else if($gradeArray[$x] == "C"){
      $totalGPA = $totalGPA + (2.0 * $creditArray[$x]);
    }
    echo "<p>totalGPA ".$x.": ".$totalGPA."</p><br>";
  }
  $totalGPA = $totalGPA / $numCredits;
  echo "<p>totalGPA ".$x.": ".$totalGPA."</p><br>";
  echo "<p>numCredits: ".$numCredits."</p><br>";
  echo "<p>numClasses: ".$numClasses."</p><br>";
  $query2 = "UPDATE taken SET gpa = '$totalGPA' WHERE id = '$id'";
  $result2 = mysqli_query($conn,$query2);

  $query3 = "SELECT * FROM roles WHERE id = '$id'";
  $result3 = mysqli_query($conn, $query3);
  while($row = mysqli_fetch_array($result3)){
    $role = $row['role'];
  }
  if($role == "student"){
    header('Location: student.php');
  }
  if($role == "advisor"){
    header('Location: transcript.php');
  }
  if($role == "alumni"){
    header('Location: alumni.php');
  }
  mysqli_close($conn);
 ?>
