<?php
session_start($options = []);
$servername = "127.0.0.1";
$username = "Team_Name";
$password = "p@ssW0RD";
$dbname = "Team_Name";

function trim_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    // Redirect to user friendly error page
    die('Error: ' . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = trim_input($_POST["user_id"]);
    $password = trim_input($_POST["password"]);

    if (!preg_match("/^[a-zA-Z0-9]*$/", $user_id)) {
        $userIDError = "Only letters and numbers are allowed for UserID";
    }else{
        $query = "SELECT uid FROM user WHERE uid = '$user_id' AND password = '$password'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = $result->fetch_assoc();

            $user_name = $row["name"];

            $_SESSION["user_name"] = $user_name;
            $_SESSION["user_id"] = $user_id;

            $query = "SELECT type FROM role WHERE uid = '$user_id'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $_SESSION["role"] = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($_SESSION["role"], $row["type"]);
                }
            } else {
                die("Error: Failed to get roles<br>");
            }
            header("Location: dashboard.php");
        } else {
            $passwordError = "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <title>Login</title>
</head>

<body>
    <?php
    include "navbar.php";
    ?>
    <div class="container pt-3">
        <h1 class="text-primary">Login</h1>
        <form method="post" style="max-width: 500px">
            <div class="form-group">
                <label for="inputUserID">User ID</label>
                <input type="text" class="form-control" id="inputUserID" placeholder="Enter User ID" name="user_id">
                <p class="text-danger"><?php if(isset($userIDError)){echo $userIDError;} ?></p>
            </div>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" class="form-control" id="inputPassword" placeholder="Enter Password" name="password">
            </div>
            <p class="text-danger"><?php if(isset($passwordError)){echo $passwordError;} ?></p>
            <button type="submit" value="Submit" class="btn btn-primary">Submit</button>
        </form>
        <br>
    </div>
</body>
</html> 
<?php mysqli_close($conn); ?>