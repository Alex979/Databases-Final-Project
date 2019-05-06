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

function trim_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["logout"])) {
        session_destroy();
        mysqli_close($conn);
        header("Location: dashboard.php");
        die();
    }

    $npass = trim_input($_POST["npass"]);

    $sql = "UPDATE user SET password = '$npass' WHERE uid = '$uid'";
    if (mysqli_query($conn, $sql)) {
        $passwordChangeMessage = "Password Changed successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>

<head>
    <title>Info Page</title>

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
        <h1 class="text-primary">User Info</h1>
        <?php
        $query = "SELECT * FROM user WHERE uid = '$uid'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "<table class=\"table\">
                    <tr>
                        <th>User Name</th>
                        <th>User ID</th>
                        <th>Address</th>
                        <th>Balance</th>
                    </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["fname"] . " " . $row["lname"] . " " . "</td>";
                echo "<td>" . $row["uid"] . "</td>";
                echo "<td>" . $row["street"] . ", " . $row["city"] . ", " . $row["state"] . " " . $row["zip"] . "</td>";
                echo "<td>" . $row["balance"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        ?>
        <a href="../../ben_new_code/editPersonalInfo.php"><button class="btn btn-primary">Edit personal info</button></a>
        <br><br>
        <h1 class="text-primary">Your Current Roles</h1>
        <?php
        $query = "SELECT * FROM role WHERE uid = '$uid'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "<table class=\"table\">
                    <tr>
                        <th>Roles</th>
                    </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["type"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        ?>
        <h1 class="text-danger">Change Password</h1>
        <form method="post" style="max-width: 500px">
            <div class="form-group">
                <input class="form-control" type="password" name="npass" id="npass" placeholder="Enter new password">
            </div>
            <p class="text-success"><?php if(isset($passwordChangeMessage)){echo $passwordChangeMessage;}?></p>
            <button type="submit" class="btn btn-danger">Change</button>
        </form>
        <br>
        <h1 class="text-primary">Log out</h1>
        <form method="post">
            <input type="hidden" name="logout" value="true">
            <button type="submit" class="btn btn-primary">Logout</button>
        </form>
    </div>
</body>

</html> 
<?php mysqli_close($conn); ?>