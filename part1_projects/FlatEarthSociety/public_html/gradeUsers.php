<?php
session_start();

if (empty($_SESSION["uid"])) {
    header("Location: login.php");
}
$uid = $_SESSION["uid"];
?>
<!DOCTYPE html>
<head>
    <title>Student Grades</title>

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


    include "navbar.php";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $courseid = $_POST["cid"];
    $scheduleid = $_POST["sid"];
    ?>

    <div class="container pt-3">

        <!--
        <p>Student Grades:</p>
        <br/>
        -->

        <!--
        <form action="addtocart.php" name="adding" method="post">
        <label for="selectstudent">Student ID: </label>
        <input type="text" name="studentid" /><br />
        <label for="grade">Grade: </label>
        <input type="text" name="gradeinput" /><br />

        <input type="submit" value="enter"/><br/>
        </form>
        -->


        <?php
        echo "<h2>Students: </h2><br/>";
        $query = "select enrolls.uid,fname,lname,grade from enrolls,user where enrolls.sid='$scheduleid' and enrolls.uid=user.uid";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "<table class=\"table\">

                        <tr>
                                <th>StudentID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Current Grade</th>
                                <th>Input Grade</th>
                                
                        </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["uid"] . "</td>";
                echo "<td>" . $row["fname"] . "</td>";
                echo "<td>" . $row["lname"] . "</td>";
                if ($row["grade"] == null){
                echo "<td>IP</td>";
                }
                else
                {
                echo "<td>" . $row["grade"] . "</td>";
                }
                //echo "<td> 
                //               <input type=\"text\" name=\"gradeinput\">
                //     </td>";
                
                /*echo "<td>
                <input type=\"hidden\" name=\"student\" value=\"" . $row["uid"] . "\">
	                      <select name=\"inputgrade\" onchange=\"gradeCourses.php\">
                        <option value=\"none\">---</option>
		                    <option value=\"F\">F</option>
                        <option value=\"C\">C</option>
                        <option value=\"C+\">C+</option>
                        <option value=\"B-\">B-</option>
                        <option value=\"B\">B</option>
                        <option value=\"B+\">B+</option>
                        <option value=\"A-\">A-</option>
                        <option value=\"A\">A</option>
	                      </select>
                    </td>";*/
                if ($row["grade"] == null){ 
                echo "<td> 
                
                                <form class=\"form-inline\" method=\"post\" action=\"submitGrade.php\">
                                <div class=\"form-group\">
                                <input class=\"form-control\" type=\"text\" size=\"5\" name=\"gradeinput\">
                                </div>
                                <input type=\"hidden\" name=\"stid\" value=\"" . $row["uid"] . "\">
                                <input type=\"hidden\" name=\"scid\" value=\"$scheduleid\">
                                <button class=\"btn btn-primary ml-3\" type=\"submit\">Submit</button>
                                </form>
                        </td>";
                }
                else
                {
                echo "<td></td>";
                }
                        
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "There are no students enrolled here";
        }
        mysqli_close($conn);
        ?>
    </div>
</body>

</html> 