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
    <title>Report Rating</title>

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
    <div class="container mt-3">
        <?php
        // Check that this request was submitted with a rating_id
        $rating_id = $_GET["rating_id"];
        if(empty($rating_id)){
            echo '<p class="text-danger">Error: You must submit a report as a GET request with a rating_id field</p>';
            exit();
        }

        // Check that this rating_id exists
        $query = "SELECT * FROM courseRating WHERE rating_id=$rating_id";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 0) {
            echo '<p class="text-danger">Error: This rating does not exist.</p>';
            exit();
        }

        // Check if this user has already reported this comment
        $query = "SELECT * FROM ratingReport WHERE uid=$uid AND rating_id=$rating_id";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "<p>You have already reported this comment. You cannot report the same rating twice.</p>";
        } else {
            // Otherwise submit a new report
            $query = "INSERT INTO ratingReport VALUES ($rating_id, $uid)";
            $result = mysqli_query($conn, $query);
            if($result){
                echo '<p>Rating has been successfully reported. We will look into this review and remove it if deemed necessary.</p>';
            } else {
                echo '<p class="text-danger">There was an error reporting this review.</p>';
            }
        }
        ?>
    </div>
</body>
</html> 