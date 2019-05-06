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
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$grade = $_POST["gradeinput"];
$suid = $_POST["stid"];
$scheduleid = $_POST["scid"];

if($grade == "A" || $grade == "A-" || $grade == "B+" || $grade == "B" || $grade == "B-" || $grade == "C+" || $grade == "C" || $grade == "F")
{
    $query = "update enrolls set grade = '$grade' where uid = '$suid' and sid = '$scheduleid'";
    mysqli_query($conn,$query);
}

mysqli_close($conn);
header("Location: gradeCourses.php");
?>