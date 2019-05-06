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

<body>
<?php
 include('../FlatEarthSociety/public_html/navbar.php');
 ?>
 <div class="container mt-3">
<?php
$uid = $_SESSION["uid"];
$servername="localhost";
$username = "Team_Name";
$password = "p@ssW0RD";
$dbname = "Team_Name";
$conn=mysqli_connect($servername,$username,$password, $dbname);
if (!$conn){
     die("Connection failed:".mysqli_connect_error());
}
echo '
          <h1 class="text-primary">Students that submitted a thesis</h1>
          <table class="table">
              <tr>
                  <th>UID</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th></th>
              </tr>';
          $query = "select user.uid, fname, lname from user, thesis where user.uid = thesis.uid and approveThesis = 0";
          $result = mysqli_query($conn, $query);
          if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                  echo '
                  <tr>
                      <td>' . $row["uid"] . '</td>
                      <td>' . $row["fname"] . '</td>
                      <td>' . $row["lname"] . '</td>
                      <td>
                          <form class="d-inline" method="post" action="viewThesis.php">
                              <input type="hidden" name="uid" value="' . $row["uid"] . '" />
                              <button type="submit" class="btn btn-primary">View Thesis</button>
                          </form>
                          <form class="d-inline" method="post" action="../../ben_new_code/thesisSuccess.php">
                              <input type="hidden" name="uid" value="' . $row["uid"] . '" />
                              <button type="submit" class="btn btn-primary">Approve Thesis</button>
                          </form>
                      </td>
                  </tr>
                  ';
              }
          }
          echo '</table>';

     ?>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
