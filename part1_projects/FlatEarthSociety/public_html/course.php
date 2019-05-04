<?php
session_start();

if (empty($_SESSION["uid"])) {
    header("Location: index.php");
}
$uid = $_SESSION["uid"];

$servername = "127.0.0.1";
$username = "Team_Name";
$password = "p@ssW0RD";
$dbname = "Team_Name";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    // Redirect to user friendly error page
    die('Error: ' . mysqli_connect_error());
}
?>

<!DOCTYPE html>

<head>
    <title>View Course</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
    <?php
    include "navbar.php";
    ?>
    <div class="container pt-3">
        <?php
        // Get all info for this course
        $query = "SELECT c.*, p1.dept AS p1dept, p1.courseNumber AS p1num, p2.dept AS p2dept, p2.courseNumber AS p2num, fname, lname FROM course c LEFT JOIN course p1 ON c.prereq1_id=p1.cid LEFT JOIN course p2 ON c.prereq2_id=p2.cid LEFT JOIN user ON user.uid=c.instructor_id WHERE c.cid=" . $_GET["cid"];
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Display course num and title
            echo "<h1 class=\"text-primary\">" . $row["dept"] . " " . $row["courseNumber"] . ": " . $row["title"] . "</h1>";
            
            // Display instructor if available
            if($row["instructor_id"] !== null) {
                echo "<h2><small>Taught by </small>" . $row["fname"] . " " . $row["lname"] . "</h2>";
            }

            // Display prerequisites if they exist
            if ($row["prereq1_id"] !== null) {
                echo "<p><b>Prerequisite 1: </b><a href=\"course.php?cid=" . $row["prereq1_id"] . "\">" . $row["p1dept"] . " " . $row["p1num"] . "</a></p>";
            }
            if ($row["prereq2_id"] !== null) {
                echo "<p><b>Prerequisite 2: </b><a href=\"course.php?cid=" . $row["prereq2_id"] . "\">" . $row["p2dept"] . " " . $row["p2num"] . "</a></p>";
            }

            // Get the schedule for this course
            $query = "SELECT * FROM schedule WHERE is_current=1 AND cid=" . $_GET["cid"];
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                echo "<h2 class=\"text-dark\">Schedule</h2>
                <table class=\"table\">
                    <tr>
                        <th>Section</th>
                        <th>Term</th>
                        <th>Day</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th></th>
                    </tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["section"] . "</td>";
                    echo "<td>" . $row["term"] . "</td>";
                    echo "<td>" . $row["day"] . "</td>";
                    echo "<td>" . $row["start"] . "</td>";
                    echo "<td>" . $row["end"] . "</td>";
                    if(in_array("student", $_SESSION["role"])) {
                        echo "<td>
                            <form method=\"post\" action=\"enroll.php\">
                                <input type=\"hidden\" name=\"sid\" value=\"" . $row["sid"] . "\">
                                <button type=\"submit\" class=\"btn btn-primary\">Enroll</button>
                            </form>
                        </td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "This course has no available sections to register for.";
            }
        } else {
            echo "This course does not exist.";
        }
        ?>
    </div>
</body>

</html> 