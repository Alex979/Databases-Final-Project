<?php
session_start();
?>
<html>
<head>

    <title>GWU Advising</title>
  <link rel="icon" href="http://www.gwrha.com/uploads/1/7/9/9/17997469/gw_atx_4cp_pos.png">
  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<?php
  session_start();
  $paper = $_POST["paper"];
  $uid = $_SESSION["user_id"];
  echo "<p>uid: ".$uid."   paper: ".$paper."</p>";
  $servername="localhost";
  $username = "Team_Name";
  $password = "p@ssW0RD";
  $dbname = "Team_Name";
  $conn=mysqli_connect($servername,$username,$password, $dbname);
  if (!$conn){
    die("Connection failed:".mysqli_connect_error());
  }
  if (!empty($paper)){
    $query = "SELECT * FROM thesis WHERE uid = '$uid'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result) > 0){
      echo "<p>You already submitted a thesis.</p>";
    }
    else{
      $query2 = "INSERT INTO thesis(uid, paper) VALUES ('$uid', '$paper')";
      $result=mysqli_query($conn,$query);
      //header("Location: ../FlatEarthSociety/public_html/dashboard.php");
      //exit();
    }
  }
  
  mysqli_close($conn);
  ?>
<body>
<?php
 include('../FlatEarthSociety/public_html/navbar.php');
 ?>
 <div class="container mt-3">
<?php
  echo '<h1 class="text-primary">Enter Your Thesis Below</h1>';
  echo '<form action="thesis.php" method="post" style="max-width: 500px" >';
  echo '<div class="form-group"><label>Thesis</label><textarea class="form-control rounded-0" rows = "25" type="text" ID="paper" name="paper"></textarea></div>';
  echo '<button class="btn btn-primary" style="vertical-align:middle"><span>Submit</span></button>';
  echo '</form><br>';

  echo '<form action="../FlatEarthSociety/public_html/dashboard.php" method="post" style="max-width: 500px" >';
  echo '<button class="btn btn-primary" style="vertical-align:middle"><span>Go to Homepage</span></button>';
  echo '</form><br><br>';

     ?>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
