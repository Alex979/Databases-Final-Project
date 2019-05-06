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
        if (empty($_SESSION["uid"])) {
            echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/FlatEarthSociety/public_html/login.php\">Login</a></li>");
        } else {
            if (in_array("student", $_SESSION["role"])) {
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/FlatEarthSociety/public_html/courses.php\">Courses</a></li>");
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/FlatEarthSociety/public_html/transcript.php\">Transcript</a></li>");
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/ben_new_code/gradForm.php\">Graduate</a></li>");
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/ben_new_code/form1Submit.php\">Submit Form 1</a></li>");
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/ben_new_code/viewForm1.php\">View Form 1</a></li>");
            }
            if (in_array("student", $_SESSION["role"]) && in_array("phd", $_SESSION["role"])) {
              echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/ben_new_code/thesis.php\">Submit Thesis</a></li>");
            }
            if (in_array("alumni", $_SESSION["role"])) {
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/FlatEarthSociety/public_html/transcript.php\">Transcript</a></li>");
            }
            if (in_array("faculty", $_SESSION["role"])) {
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/FlatEarthSociety/public_html/courses.php\">Courses</a></li>");
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/FlatEarthSociety/public_html/gradeCourses.php\">Grades</a></li>");
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/RockHoppers/public_html/applicant_display.php\">Applicant Review</a></li>");
            }
            if (in_array("gs", $_SESSION["role"])) {
              echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/ben_new_code/assignAdvisor.php\">Assign advisors</a></li>");
              echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/ben_new_code/clearedGrad.php\">Graduation list</a></li>");
              echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/RockHoppers/public_html/displayAppStatus.php\">Application Statuses</a></li>");
              echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/RockHoppers/public_html/updateTranscript.php\">Update Transcript</a></li>");
              echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/ben_new_code/approveThesis.php\">Thesis Submissions</a></li>");
            }
            if (in_array("system-admin", $_SESSION["role"])) {
              echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/FlatEarthSociety/public_html/courses.php\">Courses</a></li>");
              echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/RockHoppers/public_html/viewApps.php\">Applicant List</a></li>");
              echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/RockHoppers/public_html/viewFac.php\">Faculty List</a></li>");
            }
            if (in_array("system-admin", $_SESSION["role"]) || in_array("gs", $_SESSION["role"]) || in_array("advisor", $_SESSION["role"])) {
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/FlatEarthSociety/public_html/manage.php\">Manage</a></li>");
            }
            if (in_array("applicant", $_SESSION["role"])) {
              echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/RockHoppers/public_html/academicInfo.php\">Academic Info</a></li>");
              echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/RockHoppers/public_html/recomendations.php\">Recommendations</a></li>");
              echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/RockHoppers/public_html/applicationStatus.php\">Application Status</a></li>");
              echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/RockHoppers/public_html/personalInfo.php\">Info</a></li>");
            } else {
              echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/FlatEarthSociety/public_html/info.php\">Info</a></li>");
            }
            echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~sp19DBp2-Team_Name/Team_Name/part1_projects/FlatEarthSociety/public_html/logout.php\">Log Out</a></li>");
        }
        ?>
    </ul>
  </div>
</nav>