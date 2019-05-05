<?php
session_start();
?>
<html>

<head>
  <title>ADS</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
  <?php
  include('../FlatEarthSociety/public_html/navbar.php');
  ?>
  <div class="container mt-3">
    <h1 class="text-primary">Apply to Graduate</h1>
    <form action="applyToGraduate.php" method="post" style="max-width: 500px">
      <div class="form-group">
        <label>Student Number</label>
        <input class="form-control" type="text" name="uid" required>
      </div>
      <div class="form-group">
        <label>Degree Type</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="degree" value="masters">
          <label class="form-check-label">Masters</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="degree" value="phd">
          <label class="form-check-label">PhD</label>
        </div>
      </div>
      <input class="btn btn-primary" type="submit" value="Apply" />
    </form>

    <?php
    $servername = "127.0.0.1";
    $username = "Team_Name";
    $password = "p@ssW0RD";
    $dbname = "Team_Name";
    $errorMessage = "";
    // define connection variable
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $degree = $_POST['degree'];
    echo "<p>Degree: ".$degree."</p><br>";
    $uid = $_POST['uid'];
    $deptArray = array();
    $numArray = array();
    $gradeArray = array();
    $creditArray = array();
    $compBool = 0;
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    // check if classes taken are equivalent to form1
    if($degree = 'phd'){
      $queryThesis = "SELECT approveThesis FROM user WHERE uid = '$uid'";
      $resultThesis = mysqli_query($conn, $queryThesis) or die("Bad Query: $queryThesis");
      while ($row = mysqli_fetch_array($resultThesis)){
        $thesis = $row['approveThesis'];
      }
    }
    $x = 0;
    $query = "SELECT * FROM formOne WHERE uid = '$uid'";
    $result = mysqli_query($conn, $query) or die("Bad Query: $query");
    while ($row = mysqli_fetch_array($result)) {
      $deptArray[$x] = $row['dept'];
      $numArray[$x] = $row['courseNumber'];
      $x++;
    }
    $numformOne = mysqli_num_rows($result);
    $y = 0;
    $queryTaken = "SELECT uid, schedule.sid, course.cid, dept, courseNumber
		FROM enrolls, schedule, course 
			WHERE schedule.sid = enrolls.sid 
				AND course.cid = schedule.cid AND enrolls.uid = '$uid'";
    $resultTaken = mysqli_query($conn, $queryTaken) or die("Bad Query: $queryTaken");
    while ($row = mysqli_fetch_array($resultTaken)) {
      $deptTaken[$y] = $row['dept'];
      $numTaken[$y] = $row['courseNumber'];
      $y++;
    }
    sort($deptArray);
    sort($numArray);
    sort($deptTaken);
    sort($numTaken);

    if ($deptArray == $deptTaken && $numArray == $numTaken) {
      $compBool = 1;
    }
    else{
      $errorMessage .= "Your Form 1 does not match your courses taken. ";
    }
    for ($x = 0; $x < 12; $x++) {
      $query2 = "SELECT uid, schedule.sid, course.cid, dept, courseNumber, enrolls.grade, course.credits
		FROM enrolls, schedule, course 
			WHERE schedule.sid=enrolls.sid 
				AND course.cid=schedule.cid AND enrolls.uid = '$uid' AND dept = '$deptArray[$x]' AND courseNumber = '$numArray[$x]'";
      $result2 = mysqli_query($conn, $query2) or die("Bad Query: $query2");
      while ($row = mysqli_fetch_array($result2)) {
        $gradeArray[$x] = $row['grade'];
        $creditArray[$x] = $row['credits'];
      }
    }
    $creditCount = 0;
    if ($degree = 'masters'){
      for ($x = 0; $x < 12; $x++) {
        $creditCount = $creditCount + $creditArray[$x];
      }
      if($creditCount < 30){
        $errorMessage .= " You have taken less than 30 credits.";
      }
    }
    else if ($degree = 'phd') {
      for ($x = 0; $x < 12; $x++) {
        if ($deptArray[$x] = 'CSCI') {
	  $creditCount = $creditCount + $creditArray[$x];	
	}
      }
      if($creditCount < 30){
        $errorMessage .= " You have taken less than 30 credits in the CSCI department.";
      }
    }
    $gradeLength = sizeof($gradeArray);
    echo "<p>Grade Length: ". $gradeLength . " </p><br>";
    $failCounter = 0;
    $totalGPA = 0.0;
    $error = 0;
    for ($x = 0; $x < $gradeLength; $x++) {
      if ($gradeArray[$x] != "A" && $gradeArray[$x] != "A-" && $gradeArray[$x] != "B+" && $gradeArray[$x] != "B") {
        $failCounter++;
      }
      if ($gradeArray[$x] == "A") {
        $totalGPA = $totalGPA + (4.0 * $creditArray[$x]);
      }
      if ($gradeArray[$x] == "A-") {
        $totalGPA = $totalGPA + (3.7 * $creditArray[$x]);
      }
      if ($gradeArray[$x] == "B+") {
        $totalGPA = $totalGPA + (3.3 * $creditArray[$x]);
      }
      if ($gradeArray[$x] == "B") {
        $totalGPA = $totalGPA + (3.0 * $creditArray[$x]);
      }
      if ($gradeArray[$x] == "B-") {
        $totalGPA = $totalGPA + (2.7 * $creditArray[$x]);
      }
      if ($gradeArray[$x] == "C+") {
        $totalGPA = $totalGPA + (2.3 * $creditArray[$x]);
      }
      if ($gradeArray[$x] == "C") {
        $totalGPA = $totalGPA + (2.0 * $creditArray[$x]);
      }
      if ($gradeArray[$x] == "") {
        $error = 1;
	$errorMessage .= "You currently have a class in progress (IP). ";
      }
    }
    $numClasses = 0;
    $query3 = "SELECT uid, schedule.sid, course.cid, dept, courseNumber
		FROM enrolls, schedule, course 
			WHERE schedule.sid = enrolls.sid 
				AND course.cid = schedule.cid AND enrolls.uid = '$uid'";
    $result3 = mysqli_query($conn, $query3) or die("Bad Query: $query3");
    $numClasses = mysqli_num_rows($result3);
    $totalGPA = $totalGPA / $creditCount;
    if($totalGPA < 3.0 && $degree = 'masters'){
	$errorMessage .= "You have a GPA below 3.0. ";    
    }
    if($totalGPA < 3.5 && $degree = 'phd'){
	$errorMessage .= "You have a GPA below 3.5. ";    
    }
    echo "<p>Total GPA = " . $totalGPA . "</p><br>";
    echo "<p>Error = " . $error . "</p><br>";
    echo "<p>failCounter = " . $failCounter . "</p><br>";
    echo "<p>compBool = " . $compBool . "</p><br>";
    echo "<p>creditCount = " . $creditCount . "</p><br>";
    for ($x = 0; $x < 10; $x++) {
      echo "<p>grade:" . $gradeArray[$x] . "   dept: ".$deptArray[$x]."     course number: ".$numArray[$x]."</p><br>";
    }
    if ($error != 1 && $totalGPA >= 3.0 && $failCounter <= 2 && $compBool == 1 && $creditCount >= 30 && $degree == 'masters') {
      $query4 = "UPDATE user SET clearedToGrad = 1 WHERE uid = '$uid'";
      $result4 = mysqli_query($conn, $query4) or die("Bad Query: $query4");
      //header("Location: graduated.php");
    } 
    else if ($error != 1 && $totalGPA >= 3.5 && $thesis == 1 && $degree == 'phd' && $creditCount >= 30 && $failCounter <= 1){
      $query5 = "UPDATE user SET clearedToGrad = 1 WHERE uid = '$uid'";
      $result5 = mysqli_query($conn, $query5) or die("Bad Query: $query5");
      //header("Location: graduated.php");
    }
    else {
      session_start();
      $_SESSION["errorMessage"] = $errorMessage;
      //header("Location: noGraduate.php");
    }


    //close connection
    mysqli_close($conn);
    ?>

  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
