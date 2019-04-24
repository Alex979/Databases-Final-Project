<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
        <?php
        if (empty($_SESSION["user_id"])) {
            echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"login.php\">Login</a></li>");
        } else {
            if (in_array("student", $_SESSION["user_role"])) {
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"courses.php\">Courses</a></li>");
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"transcript.php\">Transcript</a></li>");
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"gradeCourses.php\">Grades</a></li>");
            }
            if (in_array("instructor", $_SESSION["user_role"])) {
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"courses.php\">Courses</a></li>");
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"gradeCourses.php\">Grades</a></li>");
            }
            if (in_array("admin", $_SESSION["user_role"]) || in_array("gs", $_SESSION["user_role"]) || in_array("instructor", $_SESSION["user_role"])) {
                echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"manage.php\">Manage</a></li>");
            }
            echo ("<li class=\"nav-item\"><a class=\"nav-link\" href=\"info.php\">Info</a></li>");
        }
        ?>
    </ul>
  </div>
</nav>