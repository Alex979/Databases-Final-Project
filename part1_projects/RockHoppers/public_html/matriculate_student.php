<?php
  session_start();
  include('connect.php');

  $successMessage = $successMessagePayment = "";

  if(isset($_POST['submitPayment'])){
    $successMessagePayment =  " Thank you for your payment";

  }

  if(isset($_POST['acceptAdmission'])){
    $successMessage =  " You are now a Student";

    $query = "SELECT uid from applicant WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    $uid = mysqli_fetch_assoc($result);

    //change role to student
    $email = $_POST["email"];
    $query = "UPDATE role SET type='student' WHERE UID='$uid'";
    $result = mysqli_query($conn, $query);

    //update course approval
    $query = "UPDATE user SET  needsCourseApproval=1 WHERE UID='$uid'";
    $result = mysqli_query($conn, $query);

   $query = "UPDATE user SET email='$email' WHERE uid='$uid'";
   $result = mysqli_query($conn, $query); 


    header('Location: http://gwupyterhub.seas.gwu.edu/~sp19DBp2-Team_Name/Team_Name/part1_projects/FlatEarthSociety/public_html/dashboard.php');exit;

  }
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register</title>

  <!-- Custom fonts for this template-->
  <link href="apps/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="apps/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          <!-- Topbar -->
          <?php include('../../FlatEarthSociety/public_html/navbar.php'); ?>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Register As a Student</h1>
            </div>

            <!-- Content Column -->
            <div class="container-fluid">

              <!-- Content Row -->
              <div class="row">
                <!-- Collapsable Card Example -->
                <div class="card shadow mb-4 w-100 p-3">
                  <a href="#submitPayment" class="d-block card-header py-3 w-100 p-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="appMaterials">
                    <h6 class="m-0 font-weight-bold text-primary">Submit Payment</h6><span class="text-success"><?php echo  $successMessagePayment;?></span>
                  </a>

                  <!-- Card Content - Collapse -->
                  <div class="collapse" id="submitPayment">
                    <div class="card-body w-100 p-3">
                      <form method="post" action="matriculate_student.php">
                        <!-- CONTACT -->
                        <h6 class="m-0 font-weight-bold text-primary">Enter Payment Information</h6>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="recFName">Card Number</label><span class="text-danger">
                            <input type="text" class="form-control" id="recFName" name="recFName">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="recLName1">Expiration Date</label><span class="text-danger">
                            <input type="text" class="form-control" id="recLName" name="recLName">
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="recEmail">Security Code</label><span class="text-danger">
                            <input type="text" class="form-control" id="recEmail" name="recEmail">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="recEmail">Amount</label><span class="text-danger">
                            <input type="text" class="form-control" id="recEmail" name="recEmail" value="$70.00">
                          </div>
                        </div>
                        <button type="submit" name="submitPayment" class="btn btn-primary">Submit Payment</button>
                      </form>
                    </div>
                    <!-- END CARD BODY -->
                    </div>
                  <!-- END COLLAPSABLE CONTENT -->


                </div>
                <!-- END CARD -->
              </div>

              <div class="row">
                <!-- Collapsable Card Example -->
              <div class="card shadow mb-4 w-100 p-3">
                <a href="#acceptAdmit" class="d-block card-header py-3 w-100 p-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="recOne">
                  <h6 class="m-0 font-weight-bold text-primary">Accept Addmission</h6><span class="text-success"><?php echo  $successMessage;?></span>
                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse" id="acceptAdmit">
                  <div class="card-body w-100 p-3">
                    <form method="post" action="matriculate_student.php">
                      <!-- CONTACT -->
                      <h6 class="m-0 font-weight-bold text-primary">Enter Payment Information</h6>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="FName">First Name</label><span class="text-danger">
                          <input type="text" class="form-control" id="FName" name="rFName">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="LName">Last Name</label><span class="text-danger">
                          <input type="text" class="form-control" id="LName" name="LName">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="Email">Email</label><span class="text-danger">
                          <input type="text" class="form-control" id="Email" name="Email">
                        </div>
                        <div class="form-group col-md-6">
                          <input type="checkBox" class="form-control" id="recAffiliation" name="recAffiliation"><label for="recAffiliation">I Accept the Terms and Conditions</label>
                        </div>
                      </div>
                      <button type="submit" name="acceptAdmission" class="btn btn-primary">Accept Addmission</button>
                    </form>
                  </div>
                  <!-- END CARD BODY -->
                  </div>
                <!-- END COLLAPSABLE CONTENT -->
                </div>
                <!-- END CARD -->
              </div>
              <!-- END ROW -->

            </div>

          </div>
          <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; RockHoppers 2019</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="apps/vendor/jquery/jquery.min.js"></script>
    <script src="apps/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="apps/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="apps/sjs/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="app/svendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="apps/js/demo/chart-area-demo.js"></script>
    <script src="apps/js/demo/chart-pie-demo.js"></script>

  </body>

</html>
