<?php
session_start();

if (empty($_SESSION["uid"])) {
    header("Location: dashboard.php");
}

if (
    !in_array("system-admin", $_SESSION["role"]) &&
    !in_array("gs", $_SESSION["role"]) &&
    !in_array("faculty", $_SESSION["role"]) &&
    !in_array("advisor", $_SESSION["role"])
) {
    header("Location: dashboard.php");
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["nuid"])) {
    $nuid = trim_input($_POST["nuid"]);
    $nfname = trim_input($_POST["nfname"]);
    $nlname = trim_input($_POST["nlname"]);
    $nstreet = trim_input($_POST["nstreet"]);
    $ncity = trim_input($_POST["ncity"]);
    $nstate = trim_input($_POST["nstate"]);
    $nzip = trim_input($_POST["nzip"]);
    $nroles = trim_input($_POST["nroles"]);
    $nusername = trim_input($_POST["nusername"]);
    $npass = trim_input($_POST["npass"]);
    $nemail = trim_input($_POST["nemail"]);

    if (!preg_match("/^[a-zA-Z0-9]*$/", $nuid)) {
        $userIDError = "Only letters and numbers are allowed for UserID";
    } else {
        $sql = "INSERT INTO user
            VALUES ('$nuid', '$nusername', '$npass', '$nfname', '$nlname', '$nstreet', '$ncity', '$nstate', '$nzip', 0, 0, 0, 0, NULL, 0, 'Fall', 2019, '$nemail')";
        echo $sql;
        if (mysqli_query($conn, $sql)) {
            $nroles_array = explode(",", $nroles);
            foreach ($nroles_array as $nrole) {
                $sql = "INSERT INTO role
                    VALUES ('$nuid', '$nrole')";
                if (!mysqli_query($conn, $sql)) {
                    $userAddFail = "Failed to add new user";
                } else {
                    $userAddSuccess = "Add user successfully";
                }
            }
        } else {
            $userAddFail = "Failed to add new user";
        }
    }
} else if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["action"])) {
    if($_POST["action"] == "delete-rating") {
        $query = "DELETE FROM courseRating WHERE rating_id=" . $_POST["rating_id"];
        mysqli_query($conn, $query);
    } else if($_POST["action"] == "clear-reports") {
        $query = "DELETE FROM ratingReport WHERE rating_id=" . $_POST["rating_id"];
        mysqli_query($conn, $query);
    }
}
?>

<!DOCTYPE html>

<head>
    <title>Manage Page</title>

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
    <div class="container mt-3">
        <?php
        if (in_array("system-admin", $_SESSION["role"]) || in_array("gs", $_SESSION["role"])) {
            echo '
            <h1 class="text-primary">View Transcript</h1>
            <form action="viewTranscript.php" method="post" style="max-width: 500px">
                <div class="form-group">
                    <label>Student ID</label>
                    <input class="form-control" ype="text" name="uid" id="uid">
                </div>
                <button class="btn btn-primary" type="submit">View</button>
            </form>
            <br>
            ';
        }
        ?>
        <?php
        if (in_array("advisor", $_SESSION["role"])) {
            echo '<h1 class="text-primary">Students you advise</h1>';
            $query = "select uid, fname, lname from user where advisorid=$uid";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                echo '<table class="table">
                <tr>
                    <th>UID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th></th>
                </tr>';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                    <tr>
                        <td>' . $row["uid"] . '</td>
                        <td>' . $row["fname"] . '</td>
                        <td>' . $row["lname"] . '</td>
                        <td>
                            <form class="d-inline" method="post" action="../../ben_new_code/viewForm1.php">
                                <input type="hidden" name="uid" value="' . $row["uid"] . '" />
                                <button type="submit" class="btn btn-primary">View Form 1</button>
                            </form>
                            <form class="d-inline" method="post" action="../../ben_new_code/transcript.php">
                                <input type="hidden" name="uid" value="' . $row["uid"] . '" />
                                <button type="submit" class="btn btn-primary">View Transcript</button>
                            </form>
                            <form class="d-inline" method="post" action="../../ben_new_code/viewStudentInfo.php">
                                <input type="hidden" name="uid" value="' . $row["uid"] . '" />
                                <button type="submit" class="btn btn-primary">View Info</button>
                            </form>
                        </td>
                    </tr>
                    ';
                }
                echo '
                </table>
                <br>';
            } else {
                echo '<p>You do not advise any students</p>';
            }
            
            echo '<h1 class="text-primary">Course Registration Forms</h1>
            ';
            $query = "select u.uid, fname, lname from user u, courseRegistrationForm c where u.advisorid=$uid and u.uid=c.uid";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                echo '
                <table class="table">
                    <tr>
                        <th>UID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th></th>
                    </tr>
                ';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                    <tr>
                        <td>' . $row["uid"] . '</td>
                        <td>' . $row["fname"] . '</td>
                        <td>' . $row["lname"] . '</td>
                        <td>
                            <form class="d-inline" method="get" action="courseRegistrationForm.php">
                                <input type="hidden" name="uid" value="' . $row["uid"] . '" />
                                <button type="submit" class="btn btn-primary">View Form</button>
                            </form>
                        </td>
                    </tr>
                    ';
                }
                echo '</table>';
            } else {
                echo '<p>There are no registration forms that require your approval.</p>';
            }
        }
        if (in_array("gs", $_SESSION["role"])) {
            echo '
            <h1 class="text-primary">Advisee list</h1>
            <form style="max-width: 500px" method="post">
                <input type="hidden" name="action" value="show-advisee-list" />
                <div class="form-group">
                    <label>Advisor</label>
                    <select class="form-control" name="advisor">';
            
            $query = "SELECT * FROM user, role WHERE user.uid=role.uid AND role.type='advisor'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row["uid"] . '" ';
                    if(!empty($_POST["advisor"]) && $_POST["advisor"] == $row["uid"]){
                        echo 'selected';
                    }
                    echo '>' . $row["fname"] . ' ' . $row["lname"] . '</option>';
                }
            }

            echo '</select>
                </div>
                <button type="submit" class="btn btn-primary">Show advisees</button>
            </form>
            <br>';

            if(!empty($_POST["action"]) && $_POST["action"] == "show-advisee-list" && !empty($_POST["advisor"])){
                $query = "select uid, fname, lname from user where advisorid=" . $_POST["advisor"];
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    echo '<table class="table">
                    <tr>
                        <th>UID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                    </tr>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '
                        <tr>
                            <td>' . $row["uid"] . '</td>
                            <td>' . $row["fname"] . '</td>
                            <td>' . $row["lname"] . '</td>
                        </tr>
                        ';
                    }
                    echo '</table>';
                } else {
                    echo '<p>This advisor currently has no advisees.</p>';
                }
            }
        }
        ?>
        <?php
        if (in_array("system-admin", $_SESSION["role"])) {
                    echo "<h1 class=\"text-primary\">Add Account</h1>";
                    echo "<form method=\"post\" style=\"max-width: 500px\">";
                    echo "<div class=\"form-group\">";
                    echo "<label>ID</label>";
                    echo "<input class=\"form-control\" type=\"text\" name=\"nuid\" id=\"nuid\">";
                    if(isset($userIDError)){echo "<p class=\"text-danger\">" . $userIDError . "</p>";}
                    echo "</div>";
                    echo "<div class=\"form-group\">";
                    echo "<label>First Name</label>";
                    echo "<input class=\"form-control\" type=\"text\" name=\"nfname\" id=\"nfname\">";
                    echo "</div>";
                    echo "<div class=\"form-group\">";
                    echo "<label>Last Name</label>";
                    echo "<input class=\"form-control\" type=\"text\" name=\"nlname\" id=\"nlname\">";
                    echo "</div>";
                    echo "<div class=\"form-group\">";
                    echo "<label>Email</label>";
                    echo "<input class=\"form-control\" type=\"email\" name=\"nemail\" id=\"nemail\">";
                    echo "</div>";
                    echo "<div class=\"form-group\">";
                    echo "<label>Street</label>";
                    echo "<input class=\"form-control\" type=\"text\" name=\"nstreet\" id=\"nstreet\">";
                    echo "</div>";
                    echo "<div class=\"form-group\">";
                    echo "<label>City</label>";
                    echo "<input class=\"form-control\" type=\"text\" name=\"ncity\" id=\"ncity\">";
                    echo "</div>";
                    echo "<div class=\"form-group\">";
                    echo "<label>State</label>";
                    echo "<input class=\"form-control\" type=\"text\" name=\"nstate\" id=\"nstate\">";
                    echo "</div>";
                    echo "<div class=\"form-group\">";
                    echo "<label>Zip</label>";
                    echo "<input class=\"form-control\" type=\"number\" name=\"nzip\" id=\"nzip\">";
                    echo "</div>";
                    echo "<div class=\"form-group\">";
                    echo "<label>Roles (multiple roles are seperated by ',')</label>";
                    echo "<input class=\"form-control\" type=\"text\" name=\"nroles\" id=\"nroles\">";
                    echo "</div>";
                    echo "<div class=\"form-group\">";
                    echo "<label>Username</label>";
                    echo "<input class=\"form-control\" type=\"text\" name=\"nusername\" id=\"nusername\">";
                    echo "</div>";
                    echo "<div class=\"form-group\">";
                    echo "<label>Password</label>";
                    echo "<input class=\"form-control\" type=\"password\" name=\"npass\" id=\"npass\">";
                    echo "</div>";
                    echo "<button class=\"btn btn-primary\" type=\"submit\">Add</button>";
                    echo "</form>";
                    echo "<br>";
                    if(isset($userAddSuccess)){echo "<p class=\"text-success\">" . $userAddSuccess . "</p>";}
                    if(isset($userAddFail)){echo "<p class=\"text-danger\">" . $userAddFail . "</p>";}
                }
        if (in_array("system-admin", $_SESSION["role"])) {
            echo "<h1 class=\"text-primary\">Reported course reviews</h1>";
            $query = "SELECT courseRating.uid, fname, lname, ratingReport.rating_id, rating, comment, COUNT(ratingReport.rating_id) FROM ratingReport, courseRating, user WHERE user.uid=courseRating.uid AND ratingReport.rating_id=courseRating.rating_id GROUP BY courseRating.rating_id ORDER BY COUNT(ratingReport.rating_id) DESC";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                echo '
                <table class="table">
                    <tr>
                        <th>UID</th>
                        <th>Name</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th># of Reports</th>
                        <th>Actions</th>
                    </tr>
                ';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                    <tr>
                        <td>' . $row["uid"] . '</td>
                        <td>' . $row["fname"] . ' ' . $row["lname"] . '</td>
                        <td>' . $row["rating"] . '</td>
                        <td>' . $row["comment"] . '</td>
                        <td>' . $row["COUNT(ratingReport.rating_id)"] . '</td>
                        <td>
                            <form class="d-inline" method="post">
                                <input type="hidden" name="action" value="delete-rating">
                                <input type="hidden" name="rating_id" value="' . $row["rating_id"] . '">
                                <button type="submit" class="btn btn-primary m-1">Delete Review</button>
                            </form>
                            <form class="d-inline" method="post">
                                <input type="hidden" name="action" value="clear-reports">
                                <input type="hidden" name="rating_id" value="' . $row["rating_id"] . '">
                                <button type="submit" class="btn btn-primary m-1">Clear Reports</button>
                            </form>
                        </td>
                    </tr>
                    ';
                }
                echo '</table>';
            } else {
                echo '<p>No course ratings have been reported</p>';
            }
        }
        if (in_array("system-admin", $_SESSION["role"]) || in_array("gs", $_SESSION["role"])) {
            echo "<h1 class=\"text-primary\">Change Grade</h1>";
            echo "<form method=\"post\" style=\"max-width: 500px\">";
            echo "<div class=\"form-group\">";
            echo "<label>Student ID</label>";
            echo "<input class=\"form-control\" type=\"text\" name=\"suid\" id=\"suid\">";
            echo "</div>";
            echo "<div class=\"form-group\">";
            echo "<label>Schedule ID</label>";
            echo "<input class=\"form-control\" type=\"text\" name=\"sid\" id=\"sid\">";
            echo "</div>";
            echo "<div class=\"form-group\">";
            echo "<label>Grade</label>";
            echo "<input class=\"form-control\" type=\"text\" name=\"grade\" id=\"grade\">";
            echo "</div>";
            echo "<button class=\"btn btn-primary\" type=\"submit\">Change</button>";
            echo "</form><br>";
        }
        if (in_array("system-admin", $_SESSION["role"]) || in_array("gs", $_SESSION["role"])) {
            echo '<h1 class="text-primary">Student List</h1>';
            echo '
            <form method="post" style="max-width: 500px">
                <input type="hidden" name="action" value="search-students" />
                <h4>Filters</h4>
                <div class="form-group">
                    <label>Year</label>
                    <select class="form-control" name="student-year">
                        <option value=""></option>';
            $query = "SELECT DISTINCT admitYear FROM user, role WHERE user.uid=role.uid AND role.type='student' ORDER BY admitYear";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row["admitYear"] . '" ';
                    if(!empty($_POST["student-year"]) && $row["admitYear"] == $_POST["student-year"]) {
                        echo 'selected';
                    }
                    echo '>' . $row["admitYear"] . '</option>';
                }
            }
            echo '</select>
                </div>
                <div class="form-group">
                <label>Degree Type</label>
                <select class="form-control" name="student-degree">
                    <option value=""></option>
                    <option value="phd" ';
                    if(!empty($_POST["student-degree"]) && $_POST["student-degree"] == "phd"){
                        echo 'selected';
                    }
                    echo '>PhD</option>
                    <option value="master" ';
                    if(!empty($_POST["student-degree"]) && $_POST["student-degree"] == "master"){
                        echo 'selected';
                    }
                    echo '>Master</option>
                </select>
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form><br>
            ';
            if(!empty($_POST["action"]) && $_POST["action"] == "search-students"){
                $query = "SELECT * FROM user, role WHERE user.uid=role.uid AND role.type='student'";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    echo '
                    <table class="table">
                        <tr>
                            <th>UID</th>
                            <th>Name</th>
                            <th>Degree</th>
                            <th>Admit Term</th>
                            <th>Admit Year</th>
                        </tr>
                    ';
                    while ($row = mysqli_fetch_assoc($result)) {
                        $degree_query = "SELECT * FROM role WHERE uid=" . $row["uid"];
                        $degree_result = mysqli_query($conn, $degree_query);
                        $roles = array();
                        if (mysqli_num_rows($degree_result) > 0) {
                            while ($degree_row = mysqli_fetch_assoc($degree_result)) {
                                array_push($roles, $degree_row["type"]);
                            }
                        }

                        if(!((!empty($_POST["student-degree"]) && !in_array($_POST["student-degree"], $roles)) || (!empty($_POST["student-year"]) && $row["admitYear"] != $_POST["student-year"]))){
                            echo '
                            <tr>
                                <td>' . $row["uid"] . '</td>
                                <td>' . $row["fname"] . ' ' . $row["lname"] . '</td>';
                            if(in_array("phd", $roles)){
                                echo '<td>PhD</td>';
                            }
                            if(in_array("master", $roles)){
                                echo '<td>Master</td>';
                            }
                            echo '<td>' . $row["admitTerm"] . '</td>
                                <td>' . $row["admitYear"] . '</td>
                            </tr>';
                        }
                    }
                    echo '
                    </table>
                    ';
                }
            }

            echo '<h1 class="text-primary">Alumni List</h1>';
            echo '
            <form method="post" style="max-width: 500px">
                <input type="hidden" name="action" value="search-alumni" />
                <h4>Filters</h4>
                <div class="form-group">
                    <label>Term</label>
                    <select class="form-control" name="alumni-term">
                        <option value=""></option>';
            $query = "SELECT DISTINCT admitTerm FROM user, role WHERE user.uid=role.uid AND role.type='alumni' ORDER BY admitTerm";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row["admitTerm"] . '" ';
                    if(!empty($_POST["alumni-term"]) && $row["admitTerm"] == $_POST["alumni-term"]) {
                        echo 'selected';
                    }
                    echo '>' . $row["admitTerm"] . '</option>';
                }
            }
            echo '</select>
                </div>
                <div class="form-group">
                    <label>Year</label>
                    <select class="form-control" name="alumni-year">
                        <option value=""></option>';
            $query = "SELECT DISTINCT admitYear FROM user, role WHERE user.uid=role.uid AND role.type='alumni' ORDER BY admitYear";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row["admitYear"] . '" ';
                    if(!empty($_POST["alumni-year"]) && $row["admitYear"] == $_POST["alumni-year"]) {
                        echo 'selected';
                    }
                    echo '>' . $row["admitYear"] . '</option>';
                }
            }
            echo '</select>
                </div>
                <div class="form-group">
                <label>Degree Type</label>
                <select class="form-control" name="alumni-degree">
                    <option value=""></option>
                    <option value="phd" ';
                    if(!empty($_POST["alumni-degree"]) && $_POST["alumni-degree"] == "phd"){
                        echo 'selected';
                    }
                    echo '>PhD</option>
                    <option value="master" ';
                    if(!empty($_POST["alumni-degree"]) && $_POST["alumni-degree"] == "master"){
                        echo 'selected';
                    }
                    echo '>Master</option>
                </select>
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form><br>
            ';
            if(!empty($_POST["action"]) && $_POST["action"] == "search-alumni"){
                $query = "SELECT * FROM user, role WHERE user.uid=role.uid AND role.type='alumni'";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    echo '
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Degree</th>
                            <th>Admit Term</th>
                            <th>Admit Year</th>
                        </tr>
                    ';
                    while ($row = mysqli_fetch_assoc($result)) {
                        $degree_query = "SELECT * FROM role WHERE uid=" . $row["uid"];
                        $degree_result = mysqli_query($conn, $degree_query);
                        $roles = array();
                        if (mysqli_num_rows($degree_result) > 0) {
                            while ($degree_row = mysqli_fetch_assoc($degree_result)) {
                                array_push($roles, $degree_row["type"]);
                            }
                        }

                        if(!((!empty($_POST["alumni-degree"]) && !in_array($_POST["alumni-degree"], $roles)) || (!empty($_POST["alumni-year"]) && $row["admitYear"] != $_POST["alumni-year"]) || (!empty($_POST["alumni-term"]) && $row["admitTerm"] != $_POST["alumni-term"]))){
                            echo '
                            <tr>
                                <td>' . $row["fname"] . ' ' . $row["lname"] . '</td>
                                <td>' . $row["email"] . '</td>';
                            if(in_array("phd", $roles)){
                                echo '<td>PhD</td>';
                            }
                            if(in_array("master", $roles)){
                                echo '<td>Master</td>';
                            }
                            echo '<td>' . $row["admitTerm"] . '</td>
                                <td>' . $row["admitYear"] . '</td>
                            </tr>';
                        }
                    }
                    echo '
                    </table>
                    ';
                }
            }

            echo "<h1 class=\"text-primary\">Schedule List</h1>";
            $query = "SELECT * FROM schedule INNER JOIN course ON schedule.cid = course.cid ORDER BY schedule.sid";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                echo "<table class=\"table\">
                    <tr>
                        <th>Schedule ID</th>
                        <th>Course Title</th>
                        <th>Course ID</th>
                        <th>Section</th>
                        <th>Term</th>
                    </tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["sid"] . "</td>";
                    echo "<td>" . $row["title"] . "</td>";
                    echo "<td>" . $row["cid"] . "</td>";
                    echo "<td>" . $row["section"] . "</td>";
                    echo "<td>" . $row["term"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        }
        if(in_array("system-admin", $_SESSION["role"])){
            echo "<h1 class=\"text-primary\">User List</h1>";
            $query = "SELECT * FROM user";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                echo "<table class=\"table\">
                    <tr>
                        <th>User Name</th>
                        <th>User ID</th>
                        <th>Address</th>
                        <th>Role</th>
                    </tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["fname"] . " " . $row["lname"] . " " . "</td>";
                    echo "<td>" . $row["uid"] . "</td>";
                    echo "<td>" . $row["street"] . ", " . $row["city"] . ", " . $row["state"] . " " . $row["zip"] . "</td>";
                    echo "<td>";
                    $role_query = "SELECT * FROM role WHERE uid=" . $row["uid"];
                    $role_result = mysqli_query($conn, $role_query);
                    $roles = array();
                    if (mysqli_num_rows($role_result) > 0) {
                        while ($role_row = mysqli_fetch_assoc($role_result)) {
                            array_push($roles, $role_row["type"]);
                        }
                    }
                    echo implode(', ', $roles);
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["sid"])) {
            $suid = trim_input($_POST["suid"]);
            $sid = trim_input($_POST["sid"]);
            $grade = trim_input($_POST["grade"]);

            $sql = "UPDATE enrolls SET grade = '$grade' WHERE uid = '$suid' AND sid='$sid'";
            if (mysqli_query($conn, $sql)) {
                $message = "Grade changed";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                $message = "Failed to change grade";
                echo "<script type='text/javascript'>alert('$message');</script>";
                die();
            }
        }
        ?>
    </div>
</body>

</html> 