<?php
session_start();
?>
<html>
	<head>

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
<?php
  	$id = $_SESSION["user_id"];

	$servername = "127.0.0.1";
	$username = "Team_Name";
	$password = "p@ssW0RD";
	$dbname = "Team_Name";

      $courseInt = 0;
      $creditInt = 0;
      $courseBool = 0;
      $hoursBool = 0;
      $courseOutsideBool = 1;
      $alreadyBool = 1;
      $error = "Error: ";

      $uid = $_POST['uid'];
      $deptArray = array(
        $_POST['d1'], $_POST['d2'], $_POST['d3'],
        $_POST['d4'], $_POST['d5'], $_POST['d6'],
        $_POST['d7'], $_POST['d8'], $_POST['d9'],
        $_POST['d10'], $_POST['d11'], $_POST['d12']
      );

      $numArray = array(
        $_POST['num1'], $_POST['num2'], $_POST['num3'],
        $_POST['num4'], $_POST['num5'], $_POST['num6'],
        $_POST['num7'], $_POST['num8'], $_POST['num9'],
        $_POST['num10'], $_POST['num11'], $_POST['num12']
      );


      // define connection variable
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      // Check connection
      if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
      }

      $queryAlready = "SELECT * FROM formOne WHERE uid = '$uid'";
      $alreadyResult = mysqli_query($conn, $queryAlready);
      if(mysqli_num_rows($alreadyResult) > 0){
        $alreadyBool = 0;
      }
      if($alreadyBool == 0){
        $queryDeleteForm = "DELETE FROM formOne WHERE uid = '$uid'";
        $resultDeleteForm = mysqli_query($conn, $queryDeleteForm);
      }

        // add form data to testing database
        for($x = 0; $x < 12; $x++) {
          $queryInsert = "INSERT INTO formOneValid(uid, courseNumber, dept)
            VALUES ('$uid', '$numArray[$x]', '$deptArray[$x]')";
          $result = mysqli_query($conn, $queryInsert);
        }
        // delete all null rows from table
        $queryRemoveNull = "DELETE FROM formOneValid WHERE dept = '' OR courseNumber = ''";
        $result8 = mysqli_query($conn, $queryRemoveNull);

        // check if user chose CSCI 6212
        $queryCourse1 = "SELECT * FROM formOneValid WHERE dept = 'CSCI' AND courseNumber = '6212'";
        $result1 = mysqli_query($conn, $queryCourse1);
        if($result1){
          $courseInt++;
        }

        // check if user chose CSCI 6221
        $queryCourse2 = "SELECT * FROM formOneValid WHERE dept = 'CSCI' AND courseNumber = '6221'";
        $result2 = mysqli_query($conn, $queryCourse2);
        if($result2){
          $courseInt++;
        }

        // check if user chose CSCI 6461
        $queryCourse3 = "SELECT * FROM formOneValid WHERE dept = 'CSCI' AND courseNumber = '6461'";
        $result3 = mysqli_query($conn, $queryCourse3);
        if($result3){
          $courseInt++;
        }

        // check passes if all three courses are chosen
        if($courseInt == 3){
          $courseBool = 1;
        }
	else{
	  $error .= "You have not submitted all of the required courses: CSCI 6212, CSCI 6221, and CSCI 6461. ";
	}
        for($x = 0; $x < 12; $x++){
          $queryCredits = "SELECT credits FROM course
            WHERE dept = '$deptArray[$x]'
              AND courseNumber = '$numArray[$x]'";
          $result4 = mysqli_query($conn, $queryCredits) or die("Bad Query: $query");
          while($row = mysqli_fetch_array($result4)){
            $creditInt = $creditInt + $row['credits'];
            echo "<p>creditInt = ".$creditInt."</p><br>";
          }

        }
        // check passes if the number of credits is over 30
        if($creditInt >= 30){
          $hoursBool = 1;
        }
	else{
	  $error .= "You have not submitted 30 credits. ";
	}
        // check to see if the number of outside classes is at most 2
        $queryOutside = "SELECT * FROM formOneValid WHERE NOT dept = 'CSCI'";
        $result5 = mysqli_query($conn, $queryOutside);

        // check passes if the number of outside classes is at most 2
        if(mysqli_num_rows($result5) > 2){
          $courseOutsideBool = 0;
	  echo "<p>".mysqli_num_rows($result5)."</p>";
	  $error .= "You have submitted more than 2 classes outside of your major. ";
        }
        echo "<p>courseBool = ".$courseBool."</p><br>";
        echo "<p>hoursBool = ".$hoursBool."</p><br>";
        echo "<p>courseOutsideBool = ".$courseOutsideBool."</p><br>";
        echo "<p>alreadyBool = ".$alreadyBool."</p>";
	echo "<p>".$error."</p>";
        // insert the data into form 1 database if all checks pass
        if($courseBool == 1 && $hoursBool == 1 && $courseOutsideBool == 1){
          $deleteQuery = "DELETE FROM formOneValid WHERE uid = $uid";
          $deleteResult = mysqli_query($conn, $deleteQuery);
          for($x = 0; $x < 12; $x++) {
            if($numArray[$x] != '' && $deptArray[$x] != ''){
              $queryValid = "INSERT INTO formOne(uid, courseNumber, dept)
                VALUES ('$uid', '$numArray[$x]', '$deptArray[$x]')";
              $result7 = mysqli_query($conn, $queryValid) or die("Bad Query: $queryValid");
            }
          }
          header("Location: successSubmit.php");
        }
	
        else{
	  $queryDeleteTest = "DELETE FROM formOneValid WHERE uid = '$uid'";
          $resultDeleteTest = mysqli_query($conn, $queryDeleteTest);
	  session_start();
	  $_SESSION["error"] = $error;
          header("Location: form1Error.php");
          exit();
        }
	


      mysqli_close($conn);
    ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>

