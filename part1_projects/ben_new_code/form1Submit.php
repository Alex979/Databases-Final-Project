<?php
session_start();
$id = $_SESSION["id"];

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
    <h1 class="text-primary">Form1: Program of Study for MS in Computer Science</h1>
    <form action="form1.php" method="post">Please enter the courses you plan to take to earn your MS degree in Computer
      Science. You
      must enter at most 12 courses, and your Form 1 must meet the degree requirements.<br><br>
      <table class="table">
        <tr>
          <th>Univ ID</th>
          <th>Last Name</th>
          <th>First Name</th>
        </tr>
        <tr>
          <th><input class="form-control" type="text" ID="uid" name="uid" required></th>
          <th><input class="form-control" type="text" ID="lname" name="lname" required></th>
          <th><input class="form-control" type="text" ID="fname" name="fname" required></th>
        </tr>
        <tr>
          <th>Courses In Program:</th>
          <th>DEPT/SUBJECT</th>
          <th>CourseNumber</th>
        </tr>
        <tr>
          <th>1</th>
          <th><input class="form-control" type="text" ID="d1" name="d1"></th>
          <th><input class="form-control" type=" text" ID="num1" name="num1"></th>
        </tr>
        <tr>
          <th>2</th>
          <th><input class="form-control" type="text" ID="d2" name="d2"></th>
          <th><input class="form-control" type="text" ID="num2" name="num2"></th>
        </tr>
        <tr>
          <th>3</th>
          <th><input class="form-control" type="text" ID="d3" name="d3"></th>
          <th><input class="form-control" type="text" ID="num3" name="num3"></th>
        </tr>
        <tr>
          <th>4</th>
          <th><input class="form-control" type="text" ID="d4" name="d4"></th>
          <th><input class="form-control" type="text" ID="num4" name="num4"></th>
        </tr>
        <tr>
          <th>5</th>
          <th><input class="form-control" type="text" ID="d5" name="d5"></th>
          <th><input class="form-control" type="text" ID="num5" name="num5"></th>
        </tr>
        <tr>
          <th>6</th>
          <th><input class="form-control" type="text" ID="d6" name="d6"></th>
          <th><input class="form-control" type="text" ID="num6" name="num6"></th>
        </tr>
        <tr>
          <th>7</th>
          <th><input class="form-control" type="text" ID="d7" name="d7"></th>
          <th><input class="form-control" type="text" ID="num7" name="num7"></th>
        </tr>
        <tr>
          <th>8</th>
          <th><input class="form-control" type="text" ID="d8" name="d8"></th>
          <th><input class="form-control" type="text" ID="num8" name="num8"></th>
        </tr>
        <tr>
          <th>9</th>
          <th><input class="form-control" type="text" ID="d9" name="d9"></th>
          <th><input class="form-control" type="text" ID="num9" name="num9"></th>
        </tr>
        <tr>
          <th>10</th>
          <th><input class="form-control" type="text" ID="d10" name="d10"></th>
          <th><input class="form-control" type="text" ID="num10" name="num10"></th>
        </tr>
        <tr>
          <th>11</th>
          <th><input class="form-control" type="text" ID="d11" name="d11"></th>
          <th><input class="form-control" type="text" ID="num11" name="num11"></th>
        </tr>
        <tr>
          <th>12</th>
          <th><input class="form-control" type="text" ID="d12" name="d12"></th>
          <th><input class="form-control" type="text" ID="num12" name="num12"></th>
        </tr>
      </table>
      <br><br>
      <button class="btn btn-primary" style="vertical-align:middle"><span>Submit</span></button>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
