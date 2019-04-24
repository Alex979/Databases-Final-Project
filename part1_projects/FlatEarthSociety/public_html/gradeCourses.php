<?php
session_start();

if (empty($_SESSION["user_id"])) {
    header("Location: index.php");
}
$uid = $_SESSION["user_id"];
?>

<!DOCTYPE html>

<head>
    <title>Grades</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>


<body>

    <?php

    $servername = "127.0.0.1";
    $username = "Team_Name";
    $password = "p@ssW0RD";
    $dbname = "Team_Name";

    include("navbar.php");

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    /*
$query = "select uid from users where uid='$uid'";
$result = mysqli_query($conn,$query);
if(mysqli_num_rows($result)>0){
	echo "";
}
else{
	echo "You must first login";
}
 */
    ?>

    <div class="container pt-3">

        <!--
        <p>Select a class to add grades to:</p>
        <br/>
        -->

        <!--
        <form method="post" action="gradeUsers.php">
        <label for="courseselect">Course ID: </label> <br/>
        <input type="text" name="coursetograde" /><br />
        <input type="submit" value="Enter" name="enter"/><br/><br/>
        </form>
        -->

        <?php
        if (in_array("student", $_SESSION["role"]))
        {
        echo "<h2>Your Grades: </h2><br/>";
        $query = "select course.dept,course.courseNumber,course.title,enrolls.grade from course,enrolls,schedule where enrolls.uid='$uid' and enrolls.sid=schedule.sid and schedule.cid=course.cid and schedule.is_current=1";
        $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
            echo "<table class=\"table\">

                        <tr>
                                <th>Dept</th>
                                <th>Num</th>
                                <th>Title</th>
                                <th>Grade</th>
                        </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                //echo "<td>" . $row["cid"] . "</td>";
                echo "<td>" . $row["dept"] . "</td>";
                echo "<td>" . $row["courseNumber"] . "</td>";
                echo "<td>" . $row["title"] . "</td>";
                if ($row["grade"] == null){
                echo "<td>IP</td>";
                }
                else{
                echo "<td>" . $row["grade"] . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "You have no grades";
        }
        }
        
        if (in_array("instructor", $_SESSION["role"]))
        {
        echo "<h2>Your Courses: </h2><br/>";
        $query = "select c.cid,c.dept,c.courseNumber,c.title,s.sid from course c, schedule s where c.instructor_id='$uid' and s.cid=c.cid and s.is_current=1";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "<table class=\"table\">

                        <tr>
                                <th>Dept</th>
                                <th>Num</th>
                                <th>Title</th>
                                <th></th>
                        </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                //echo "<td>" . $row["cid"] . "</td>";
                echo "<td>" . $row["dept"] . "</td>";
                echo "<td>" . $row["courseNumber"] . "</td>";
                echo "<td>" . $row["title"] . "</td>";
                echo "<td> 
                                <form method=\"post\" action=\"gradeUsers.php\">
                                <input type=\"hidden\" name=\"cid\" value=\"" . $row["cid"] . "\">
                                <input type=\"hidden\" name=\"sid\" value=\"" . $row["sid"] . "\">
                                <button class=\"btn btn-primary\" type=\"submit\">View</button>
                                </form>
                        </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "You teach no courses";
        }
        }
        mysqli_close($conn);
        ?>
    </div>
</body>

</html> 