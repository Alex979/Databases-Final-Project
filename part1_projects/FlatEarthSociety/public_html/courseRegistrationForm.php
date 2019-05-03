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

$c1 = $c2 = $c3 = $c4 = $c5 = $c6 = $c7 = $c8 = "";
$success = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $c1 = $_POST["c1"];
    $c2 = $_POST["c2"];
    $c3 = $_POST["c3"];
    $c4 = $_POST["c4"];
    $c5 = $_POST["c5"];
    $c6 = $_POST["c6"];
    $c7 = $_POST["c7"];
    $c8 = $_POST["c8"];

    // Delete the existing form if it exists
    $query = "DELETE FROM courseRegistrationForm WHERE uid=$uid";
    mysqli_query($conn, $query);

    // Insert the new form
    $query = "INSERT INTO courseRegistrationForm (uid, c1, c2, c3, c4, c5, c6, c7, c8) VALUES($uid, '$c1', '$c2', '$c3', '$c4', '$c5', '$c6', '$c7', '$c8')";
    $result = mysqli_query($conn, $query);
    $success = $result;
} else {
    // Get values from already submitted form if it exists
    $query = "SELECT * FROM courseRegistrationForm WHERE uid=$uid";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $c1 = $row["c1"];
        $c2 = $row["c2"];
        $c3 = $row["c3"];
        $c4 = $row["c4"];
        $c5 = $row["c5"];
        $c6 = $row["c6"];
        $c7 = $row["c7"];
        $c8 = $row["c8"];
    }
}
?>

<!DOCTYPE html>

<head>
    <title>Registration Form</title>

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
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if($success){
                echo "
                <div class=\"alert alert-success\" role=\"alert\">
                    Successfully submitted the form!
                </div>
                ";
            } else {
                echo "
                <div class=\"alert alert-danger\" role=\"alert\">
                    There was an error submitting the form!
                </div>
                ";
            }
        }
        ?>
        <h1 class="text-primary">Course Registration Form</h1>
        <p>Please list the courses you would like to register for below. 
        Once the form is approved by your advisor, you will be able to 
        register for your courses. You do not need to fill out all 8 boxes.</p>
        <form method="post" style="max-width: 500px">
            <div class="form-group">
                <label>Course 1</label>
                <input type="text" class="form-control" name="c1" value="<?php echo $c1; ?>">
            </div>
            <div class="form-group">
                <label>Course 2</label>
                <input type="text" class="form-control" name="c2" value="<?php echo $c2; ?>">
            </div>
            <div class="form-group">
                <label>Course 3</label>
                <input type="text" class="form-control" name="c3" value="<?php echo $c3; ?>">
            </div>
            <div class="form-group">
                <label>Course 4</label>
                <input type="text" class="form-control" name="c4" value="<?php echo $c4; ?>">
            </div>
            <div class="form-group">
                <label>Course 5</label>
                <input type="text" class="form-control" name="c5" value="<?php echo $c5; ?>">
            </div>
            <div class="form-group">
                <label>Course 6</label>
                <input type="text" class="form-control" name="c6" value="<?php echo $c6; ?>">
            </div>
            <div class="form-group">
                <label>Course 7</label>
                <input type="text" class="form-control" name="c7" value="<?php echo $c7; ?>">
            </div>
            <div class="form-group">
                <label>Course 8</label>
                <input type="text" class="form-control" name="c8" value="<?php echo $c8; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Submit Form</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html> 
