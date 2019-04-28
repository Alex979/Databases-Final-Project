<nav class="navbar navbar-expand-lg navbar-light bg-light" style="box-shadow: 0 0 15px rgba(0, 0, 0, 0.3)">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/~sp19DBp2-Team_Name/Team_Name/part1_projects/FlatEarthSociety/public_html/dashboard.php">Home</a>
      </li>
        <?php
        if (empty($_SESSION["user_id"])) {
            echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/FlatEarthSociety/public_html/login.php\">Login</a></li>");
        } else {
            if (in_array("student", $_SESSION["role"])) {
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/FlatEarthSociety/public_html/courses.php\">Courses</a></li>");
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/FlatEarthSociety/public_html/transcript.php\">Transcript</a></li>");
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/ben_new_code/applyToGraduate.php\">Graduate</a></li>");
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/ben_new_code/form1Submit.php\">Submit Form 1</a></li>");
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/ben_new_code/viewForm1.php\">View Form 1</a></li>");
            }
            if (in_array("alumni", $_SESSION["role"])) {
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/FlatEarthSociety/public_html/transcript.php\">Transcript</a></li>");
            }
            if (in_array("faculty", $_SESSION["role"])) {
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/FlatEarthSociety/public_html/courses.php\">Courses</a></li>");
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/FlatEarthSociety/public_html/gradeCourses.php\">Grades</a></li>");
            }
            if (in_array("gs", $_SESSION["role"])) {
              echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/ben_new_code/assignAdvisor.php\">Assign advisors</a></li>");
              echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/ben_new_code/clearedGrad.php\">Graduation list</a></li>");
            }
            if (in_array("system-admin", $_SESSION["role"]) || in_array("gs", $_SESSION["role"]) || in_array("faculty", $_SESSION["role"])) {
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/FlatEarthSociety/public_html/manage.php\">Manage</a></li>");
            }
            echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/FlatEarthSociety/public_html/info.php\">Info</a></li>");
        }
        ?>
    </ul>
  </div>
</nav>