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
    <title>Course List</title>

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
        <h1 class="text-primary">Course List</h1>
        <?php
        // Get a list of courses
        $query = "SELECT *, fname, lname FROM course LEFT JOIN user ON course.instructor_id=user.uid";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "<table class=\"table\">
                    <tr>
                        <th>Course</th>
                        <th>Title</th>
                        <th>Instructor</th>
                        <th>Credits</th>
                    </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td><a href=\"course.php?cid=" . $row["cid"] . "\">" . $row["dept"] . " " . $row["courseNumber"] . "</a></th>";
                echo "<td>" . $row["title"] . "</td>";
                echo "<td>" . $row["fname"] . " " . $row["lname"] . "</td>";
                echo "<td>" . $row["credits"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "There are no courses being offered at this time.";
        }
        ?>
    </div>
</body>

</html> 