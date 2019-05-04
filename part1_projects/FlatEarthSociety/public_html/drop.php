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
    <title>Drop</title>

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
                $sid = $_POST["sid"];

                // Get the course that the student would like to drop
                $query = "SELECT * FROM schedule WHERE sid=" . $sid;
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);

                    // Check that this is the current semester
                    if($row["is_current"] == 1){
                        // Drop the course
                        $query = "DELETE FROM enrolls WHERE sid=" . $sid . " AND uid=" . $uid;
                        mysqli_query($conn, $query);
                        if (!mysqli_connect_errno()) {
                            echo "Sucessfully dropped";
                        }
                    } else {
                        echo "You cannot drop a course that was taken in a past semester.";
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