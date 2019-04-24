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
      $error = $_SESSION["error"];
      echo $error;
    ?>
    <a href="form1.html">Go Back</a><br>
  </p>
</body>
</html>

