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
?>

<!DOCTYPE html>

<head>
    <title>Delete Rating</title>

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
        // Check that this request was submitted with a rating_id
        $rating_id = $_REQUEST["rating_id"];
        if(empty($rating_id)){
            echo '<p class="text-danger">Error: You must load this page with a rating_id field as either GET or POST</p>';
            exit();
        }

        // Check that this rating exists and it was submitted by this user
        $query = "SELECT * FROM courseRating, course WHERE rating_id=$rating_id AND uid=$uid AND courseRating.cid=course.cid";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 0) {
            echo '<p class="text-danger">Error: This rating does not exist or it was not submitted by you.</p>';
            exit();
        }
        $row = mysqli_fetch_assoc($result);
        $courseName = $row["dept"] . " " . $row["courseNumber"];

        // If this is a GET request, load the form to submit a rating. If this is a POST request, submit the rating into the database and redirect back to the course view
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            echo '
            <p>Are you sure you want to delete your review of ' . $courseName . '?</p>
            <form method="post" style="max-width: 500px">
                <input type="hidden" name="rating_id" value="' . $rating_id . '" />
                <button type="submit" class="btn btn-danger">Yes, delete rating</button>
                <a style="margin-left: 2rem" href="course.php?cid=' . $row["cid"] . '">Go back</a>
            </form>
            ';
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $query = "DELETE FROM courseRating WHERE rating_id=$rating_id";
            $result = mysqli_query($conn, $query);
            if($result) {
                header("Location: course.php?cid=" . $row["cid"]);
            } else {
                echo '<p class="text-danger">There was an error deleting your rating.</p>';
            }
        }
        ?>
    </div>
</body>
</html> 