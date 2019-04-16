<?php 
session_start();

?>
<div id="content">

        <!-- Topbar -->
          <?php include('applicantTopbar.php'); ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Profile Overview</h1>
            <form method="post" action="submitApplication.php">
              <input type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Submit Application</input>
            </form>
          </div>


          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-5">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Personal Information</h6>
                </div>
                <div class="card-body">
                  <p></p>
                  <a rel="nofollow" href="personalInfo.php">Enter Personal Information &rarr;</a>
                </div>
              </div>

              <!-- Letters of Rec -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Letters of Recomendation</h6>
                </div>
                <div class="card-body">
                  <p></p>
                  <a rel="nofollow" href="recomendations.php">Request Letters &rarr;</a>
                </div>
              </div>
            </div>

            <div class="col-lg-6 mb-4">
              <!-- Academic Info-->
              <div class="card shadow mb-5">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Academic Information</h6>
                </div>
                <div class="card-body">
                  <p></p>
                  <a rel="nofollow" href="academicInfo.php">Enter Academic Information &rarr;</a>
                </div>
              </div>

              <!-- Application Status -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">View Application Status</h6>
                </div>
                <div class="card-body">
                  <p></p>
                  <a rel="nofollow" href="applicationStatus.php">View Status &rarr;</a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
