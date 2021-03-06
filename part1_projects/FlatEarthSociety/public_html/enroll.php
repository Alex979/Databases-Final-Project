<?php
session_start();

if (empty($_SESSION["uid"])) {
    header("Location: login.php");
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

// Check that current user doesn't need course registration approval first, redirect otherwise
$query = "SELECT needsCourseApproval FROM user WHERE uid=$uid";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if((int)$row["needsCourseApproval"] == 1) {
        // If course approval is needed, redirect to form submission page
        header("Location: courseRegistrationForm.php");
        exit();
    }
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
        <h3>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                /* Make sure this course does not conflict with 
                any other currently enrolled courses */

                // Time allowed between classes in seconds
                $time_buffer = 1800;  // = 30 minutes
                $sid = $_POST["sid"];

                // Get the schedule that the student would like to enroll for
                $query = "SELECT * FROM schedule WHERE sid=" . $sid;
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);

                    // Get the day, start, and end time of the requested course
                    $cid = $row["cid"];
                    $day = $row["day"];
                    $term = $row["term"];
                    $start_time = strtotime($row["start"]);
                    $end_time = strtotime($row["end"]);

                    // Variable to check for a conflict
                    $conflict = "";

                    // Check if student meets the prerequisites
                    $query = "SELECT prereq1_id, prereq2_id FROM course WHERE cid=" . $cid;
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        if ($row["prereq1_id"] !== null) {
                            // Check if user is enrolled in this course
                            $query = "SELECT * FROM enrolls, schedule WHERE enrolls.sid=schedule.sid AND enrolls.uid=" . $uid . " AND schedule.cid=" . $row["prereq1_id"] . " AND grade IS NOT NULL";
                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) == 0) {
                                $conflict = "You do not meet the prerequisites to enroll for this course.";
                            }
                        }
                        if ($row["prereq2_id"] !== null) {
                            // Check if user is enrolled in this course
                            $query = "SELECT * FROM enrolls, schedule WHERE enrolls.sid=schedule.sid AND enrolls.uid=" . $uid . " AND schedule.cid=" . $row["prereq2_id"] . " AND grade IS NOT NULL";
                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) == 0) {
                                $conflict = "You do not meet the prerequisites to enroll for this course.";
                            }
                        }
                    }

                    // If prereqs are met, check for time conflicts
                    if (empty($conflict)) {
                        // Get all of the users currently enrolled courses
                        $query = "SELECT uid, schedule.sid, term, day, start, end, course.cid, dept, courseNumber FROM enrolls, schedule, course WHERE schedule.sid=enrolls.sid AND course.cid=schedule.cid AND grade IS NULL AND enrolls.uid=" . $uid;
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            // Check each enrolled course for a time conflict
                            while ($row = mysqli_fetch_assoc($result)) {
                                $this_day = $row["day"];
                                $this_term = $row["term"];
                                $this_start_time = strtotime($row["start"]);
                                $this_end_time = strtotime($row["end"]);

                                // Check for same day
                                if (strcmp($day, $this_day) == 0 && strcmp($term, $this_term) == 0) {
                                    // Check for overlap
                                    if (
                                        ($start_time >= $this_start_time && $start_time <= $this_end_time)
                                        || ($end_time >= $this_start_time && $end_time <= $this_end_time)
                                    ) {
                                        $conflict = "This course conflicts with " . $row["dept"] . " "  . $row["courseNumber"];
                                    } else {
                                        // Check for 30 minute window before and after class
                                        if (
                                            ($start_time >= $this_end_time && ($start_time - $this_end_time < $time_buffer))
                                            || ($end_time <= $this_start_time && ($this_start_time - $end_time < $time_buffer))
                                        ) {
                                            $conflict = "This course is scheduled too close to " . $row["dept"] . " "  . $row["courseNumber"] . ".  There must be 30 minutes in between courses.";
                                        }
                                    }
                                }
                            }
                        }
                    }

                    // If no conflict, enroll the student in this course
                    if (empty($conflict)) {
                        $query = "INSERT INTO enrolls VALUES (" . $uid . ", " . $sid . ", NULL)";
                        mysqli_query($conn, $query);
                        if (!mysqli_connect_errno()) {
                            echo "Sucessfully enrolled";
                        }
                    } else {
                        echo $conflict;
                    }
                } else {
                    echo "This course does not exist.";
                }
            } else {
                echo "This page must be submitted as POST.";
            }
            ?>
        </h3>
    </div>
</body>

</html> 
