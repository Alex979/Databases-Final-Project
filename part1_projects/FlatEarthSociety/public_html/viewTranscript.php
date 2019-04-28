<?php
session_start();

if (empty($_SESSION["user_id"])) {
    header("Location: index.php");
}

if (
    !in_array("admin", $_SESSION["role"]) &&
    !in_array("gs", $_SESSION["role"]) &&
    !in_array("faculty", $_SESSION["role"])
) {
    header("Location: index.php");
}

$uid = $_POST["uid"];

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
    <title>Enroll</title>

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
        <h1 class="text-primary">Transcript</h1>
        <?php
        // Show the users currently enrolled courses and their grade if entered
        $query = "SELECT user.uid, fname, lname, schedule.sid, section, term, day, start, end, grade, course.cid, dept, courseNumber, title FROM enrolls, schedule, course, user WHERE schedule.sid=enrolls.sid AND course.cid=schedule.cid AND enrolls.uid=" . $uid . " AND user.uid=" . $uid . " ORDER BY term";
        $result = mysqli_query($conn, $query);

        // Generate a table of all the enrolled courses
        if (mysqli_num_rows($result) > 0) {
            echo "<table class=\"table\">
                <tr>
                    <th>Course</th>
                    <th>Title</th>
                    <th>Section</th>
                    <th>Term</th>
                    <th>Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Grade</th>
                </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td><a href=\"transcriptCourse.php?cid=" . $row["cid"] . "\">" . $row["dept"] . " " . $row["courseNumber"] . "</a></th>";
                echo "<td>" . $row["title"] . "</td>";
                echo "<td>" . $row["section"] . "</td>";
                echo "<td>" . $row["term"] . "</td>";
                echo "<td>" . $row["day"] . "</td>";
                echo "<td>" . $row["start"] . "</td>";
                echo "<td>" . $row["end"] . "</td>";
                if ($row["grade"] !== null) {
                    echo "<td>" . $row["grade"] . "</td>";
                } else {
                    echo "<td>IP</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
        ?>
    </div>
</body>

</html> 