<?php
session_start();

if (empty($_SESSION["user_id"])) {
    header("Location: index.php");
}
$uid = $_SESSION["user_id"];
?>

<!DOCTYPE html>
<head>
    <title>Reset</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include "navbar.php";
    ?>

    <div class="container pt-3">
        <?php
        chdir('/home/ead/sp19DBp1-FlatEarthSociety');
        $command = "mysql --user=FlatEarthSociety --password=N@S@l1es " . "-h 127.0.0.1 -D FlatEarthSociety < ./";
        $output = shell_exec($command . '/schema.sql');
        header("Location: index.php");
        ?>
    </div>
</body>

</html> 