<html>
<head>
  <title>Error</title>
  <link rel="icon" href="http://www.gwrha.com/uploads/1/7/9/9/17997469/gw_atx_4cp_pos.png">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>GWU Advising</h1>
  <p>
     <?php 
      session_start();
      $errorMessage = $_SESSION["errorMessage"];
      echo $errorMessage;
    ?>
    <a href="../FlatEarthSociety/public_html/dashboard.php">Go Back</a><br>
  </p>
</body>
</html>

