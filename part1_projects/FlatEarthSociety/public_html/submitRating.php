<?php
session_start();

if (empty($_SESSION["uid"])) {
    header("Location: login.php");
}
if(!in_array("student", $_SESSION["role"])){
    header("Location: dashboard.php");
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
    <title>Submit Rating</title>

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
        // Check that this request was submitted with a cid
        $cid = $_REQUEST["cid"];
        if(empty($cid)){
            echo '<p class="text-danger">Error: You must load this page with a cid field as either GET or POST</p>';
            exit();
        }

        // Check that this course exists
        $query = "SELECT * FROM course WHERE cid=$cid";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 0) {
            echo '<p class="text-danger">Error: This course does not exist.</p>';
            exit();
        }
        $row = mysqli_fetch_assoc($result);
        $courseName = $row["dept"] . " " . $row["courseNumber"];

        // Check that user has taken this course
        $query = "SELECT * FROM enrolls, schedule WHERE schedule.cid=$cid AND enrolls.sid=schedule.sid AND enrolls.uid=$uid AND grade IS NOT NULL";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 0) {
            echo '<p class="text-danger">You cannot rate a course that you haven\'t already completed.</p>';
            exit();
        }

        // Check that user has not already submitted a rating for this course
        $query = "SELECT * FROM courseRating WHERE cid=$cid AND uid=$uid";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo '<p>You cannot submit more than one rating for a course. If you would like to modify your previous rating, find your rating on the course page and click "Edit Rating".</p>';
        } else {
            // If this is a GET request, load the form to submit a rating. If this is a POST request, submit the rating into the database and redirect back to the course view
            if($_SERVER['REQUEST_METHOD'] == 'GET') {
                echo '
                <h1 class="text-primary">Rating for ' . $courseName . '</h1>
                <form method="post" style="max-width: 500px">
                    <input type="hidden" name="cid" value="' . $cid . '" />
                    <div class="form-group">
                        <label>How would you rate this course on a scale from 1 to 5?</label>
                        <input name="rating" type="number" min="1" max="5" class="form-control" placeholder="Enter rating" required>
                    </div>
                    <div class="form-group">
                        <label>Leave a comment reviewing this course below.</label>
                        <textarea name="comment" maxlength="500" class="form-control" placeholder="Enter comment" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit rating</button>
                </form>
                ';
            } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $rating = (int)$_POST["rating"];
                $comment = $_POST["comment"];

                if($rating < 1 || $rating > 5) {
                    echo '<p class="text-danger">Error: Rating must be between 1 and 5</p>';
                    exit(); 
                }

                if(empty($comment)){
                    echo '<p class="text-danger">Error: You must submit a comment along with your rating.</p>';
                    exit(); 
                }

                $todaysDate = date("Y-m-d");

                $query = "INSERT INTO courseRating (uid, cid, rating, comment, dateSubmitted) VALUES ($uid, $cid, $rating, \"" . htmlspecialchars($comment) . "\", '$todaysDate')";
                $result = mysqli_query($conn, $query);
                if($result){
                    header("Location: course.php?cid=$cid");
                }else {
                    echo '<p class="text-danger">There was an error submitting your rating.</p>';
                }
            }
        }
        ?>
    </div>
</body>
</html> 