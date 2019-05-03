
<html>
<head>
  <title>ADS</title>
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="http://www.gwrha.com/uploads/1/7/9/9/17997469/gw_atx_4cp_pos.png">
 
</head>
<body>
  <h1>Apply to Graduate</h1>
  <form action="applyToGraduate.php" method="post">
        <b>Student Number</b><br><input type="text" name="uid" required ><br><br>
        <b>Degree Type</b><br>
        <input type="radio" name="degree" value="masters">Masters<br>
        <input type="radio" name="degree" value="phd">PhD<br><br>
        <input type="submit" value="Apply"/>
  </form>
  <br>
  <form action="student.php" method = "post">
  <input type="hidden" name="uid" value = "'.$uid.'"/>
  <input type="hidden" name="permission" value = 1/>
  <button class="button" style="vertical-align:middle"><span>Return to Student Page</span></button>
  </form>
</body>
</html>
