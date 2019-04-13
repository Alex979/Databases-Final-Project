<? php 
session_start();

include('connect.php');



?>
<!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          
          <div class="row">
            <br><br>
          </div>

          <!-- Topbar Navbar -->
          
          <ul class="navbar-nav ml-auto">

            <div class="form-group">
              <ul class="navbar-nav ml-auto">
                <li class="text-primary"><a href="userDashboard.php">Dashboard</a></li>
                <div class="topbar-divider d-none d-sm-block"></div>
                <li class="text-primary"><a href="personalInfo.php">Personal Info</a></li>
                <div class="topbar-divider d-none d-sm-block"></div>
                <li class="text-primary"><a href="academicInfo.php">Academic Info</a></li>
                <div class="topbar-divider d-none d-sm-block"></div>
                <li class="text-primary"><a href="recomendations.php">Recommendation Letters</a></li>
                <div class="topbar-divider d-none d-sm-block"></div>
                <li class="text-primary"><a href="applicationStatus.php">Application Status</a></li>


              </ul>
            </div>




            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php
                session_start();
                echo $_SESSION['username']
                 ?></span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->



