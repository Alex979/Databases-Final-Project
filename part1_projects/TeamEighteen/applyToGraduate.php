<html>
<head>
  <title>ADS</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Apply to Graduate</h1>
  <form action="applyToGraduate.php" method="post">
        <b>Student Number</b><br><input type="text" name="id" required><br><br>
        <b>Degree Type</b><br>
        <input type="radio" name="degree" value="masters">Masters<br>
        <input type="radio" name="degree" value="phd">PhD<br><br>
        <input type="submit" value="Apply"/>
  </form>
  <br><br><br><a href="student.php">Go to Homepage</a><br>

  <?php
	$servername = "localhost";
	$username = "TeamEighteen";
	$password = "DatabasePassword1!";
	$dbname = "TeamEighteen";	
      // define connection variable
      $conn = mysqli_connect($servername, $username, $password, $dbname);

      $id = $_POST['id'];
      $deptArray = array();
      $numArray = array();
      $gradeArray = array();
      $creditArray = array();
      $compBool = 0;
      // Check connection
      if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
      }
      // check if classes taken are equivalent to form1
      $x = 0;
      $query = "SELECT * FROM formOne WHERE id = '$id'";
      $result = mysqli_query($conn, $query) or die("Bad Query: $query");
      while($row = mysqli_fetch_array($result)) {
          $deptArray[$x] = $row['dept'];
          $numArray[$x] = $row['courseNumber'];
          $x++;
      }
      $numformOne = mysqli_num_rows($result);
      $y = 0;
      $queryTaken = "SELECT * FROM taken WHERE id = '$id'";
      $resultTaken = mysqli_query($conn, $queryTaken) or die("Bad Query: $queryTaken");
      while($row = mysqli_fetch_array($resultTaken)){
        $deptTaken[$y] = $row['dept'];
        $numTaken[$y] = $row['courseNumber'];
        $y++;
      }
      sort($deptArray);
      sort($numArray);
      sort($deptTaken);
      sort($numTaken);

      if($deptArray == $deptTaken && $numArray == $numTaken){
        $compBool = 1;
      }
      for($x = 0; $x < 12; $x++){
        $query2 = "SELECT * FROM taken
                    WHERE dept = '$deptArray[$x]'
                      AND courseNumber = '$numArray[$x]'";
        $result2 = mysqli_query($conn, $query2) or die("Bad Query: $query2");
        while($row = mysqli_fetch_array($result2)){
          $gradeArray[$x] = $row['grade'];
          $creditArray[$x] = $row['creditHours'];
        }
      }
      $creditCount = 0;
      for($x = 0; $x < 12; $x++){
        $creditCount = $creditCount + $creditArray[$x];
      }
        $failCounter = 0;
        $totalGPA = 0.0;
        $error = 0;
        for($x = 0; $x < 12; $x++){
          if($gradeArray[$x] != "A" && $gradeArray[$x] != "A-" && $gradeArray[$x] != "B+" && $gradeArray[$x] != "B"){
            $failCounter++;
          }
          if($gradeArray[$x] == "A"){
            $totalGPA = $totalGPA + (4.0 * $creditArray[$x]);
          }
          if($gradeArray[$x] == "A-"){
            $totalGPA = $totalGPA + (3.7 * $creditArray[$x]);
          }
          if($gradeArray[$x] == "B+"){
            $totalGPA = $totalGPA + (3.3 * $creditArray[$x]);
          }
          if($gradeArray[$x] == "B"){
            $totalGPA = $totalGPA + (3.0 * $creditArray[$x]);
          }
          if($gradeArray[$x] == "B-"){
            $totalGPA = $totalGPA + (2.7 * $creditArray[$x]);
          }
          if($gradeArray[$x] == "C+"){
            $totalGPA = $totalGPA + (2.3 * $creditArray[$x]);
          }
          if($gradeArray[$x] == "C"){
            $totalGPA = $totalGPA + (2.0 * $creditArray[$x]);
          }
          if($gradeArray[$x] == "IP"){
            $error = 1;
          }
        }
        $numClasses = 0;
        $query3 = "SELECT * FROM taken WHERE id = '$id'";
        $result3 = mysqli_query($conn, $query3) or die("Bad Query: $query3");
        $numClasses = mysqli_num_rows($result3);
        $totalGPA = $totalGPA / $creditCount;
        if($error != 1 && $totalGPA >= 3.0 && $failCounter <= 2 && $compBool == 1){
          $query4 = "UPDATE roles SET clearedToGrad = 1 WHERE id = '$id'";
          $result4 = mysqli_query($conn, $query4) or die("Bad Query: $query4");
          header("Location: graduated.php");
        }
        else{
          header("Location: noGraduate.php");
        }


      //close connection
        mysqli_close($conn);
    ?>
</body>
</html>

