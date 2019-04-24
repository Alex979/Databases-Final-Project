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
?>

<!DOCTYPE html>

<head>
    <title>Home</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css"> -->

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
    <form action="reset.php" method="post" style="position: fixed; left: 10px; bottom: 10px;">
        <button type="submit" class="btn btn-primary" style="display: block; margin: 0 auto;">Reset</button>
    </form>
    <div class="container pt-3">
        <h1 style="text-align: center; font-size: 40px;">Flat Earth Society</h1>
        <img style="width: 100%" src="img/flat_earth.png">
    </div>
</body>

</html> 
