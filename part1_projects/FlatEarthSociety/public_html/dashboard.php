<?php
session_start();

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

function create_link($title, $description, $link_text, $url) {
    echo "<div class=\"col-sm-6 mb-3\">
            <div class=\"card\" style=\"box-shadow: 0 0 15px rgba(0, 0, 0, 0.1)\">
                <div class=\"card-body\">
                    <h5 class=\"card-title text-primary\">$title</h5>
                    <p class=\"card-text\">$description</p>
                </div>
                <div class=\"card-footer\">
                    <a href=\"$url\" class=\"btn btn-primary\">$link_text</a>
                </div>
            </div>
        </div>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>User Dashboard</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>
    <?php
    include("navbar.php");
    ?>
    <div class="container-fluid mt-4">
        <h1 class="text-dark mb-3">User Dashboard</h1>
        <div class="row">
                <?php
                if (empty($_SESSION["user_id"])) {
                    create_link("Log in", "Log in to the portal.", "Go to login", "login.php");
                } else {
                    if (in_array("student", $_SESSION["role"])) {
                        create_link("Courses", "View all the courses offerred.", "Go to course list", "courses.php");
                        create_link("Transcript", "View the courses you currently are taken and have taken in the past.", "View transcript", "transcript.php");
                        create_link("Apply To Graduate", "Apply to graduate.", "Go to application", "../../ben_new_code/applyToGraduate.php");
                        create_link("Submit Form 1", "Submit the form required to graduate.", "Go to form 1", "../../ben_new_code/form1.html");
                    }
                    if (in_array("faculty", $_SESSION["role"])) {
                        create_link("Courses", "View all the courses offerred.", "Go to course list", "courses.php");
                        create_link("Grades", "View the courses you teach and assign grades to students.", "View courses you teach", "gradeCourses.php");
                    }
                    if (in_array("admin", $_SESSION["role"]) || in_array("gs", $_SESSION["role"]) || in_array("faculty", $_SESSION["role"])) {
                        create_link("Manage", "Management panel for faculty and staff.", "Go to manage page", "manage.php");
                    }
                    create_link("Info", "View personal information and logout.", "Go to info page", "info.php");
                }
                ?>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>