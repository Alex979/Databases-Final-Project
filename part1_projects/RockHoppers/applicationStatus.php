<?php 

  include('connect.php');
  $uid = $_SESSION['uid'];

  $personalComplete = $academicComplete = $recComplete = $transcriptComplete = "";
  $admitDecision = $readyForEval = ""; 
  //Use Query to obtain personalComplete
              $query = "select * from applicant where uid='$uid'";
              $result = mysqli_query($conn,$query);
              if (mysqli_num_rows($result) > 0){
                      while($row = mysqli_fetch_assoc($result)){
                      $personalComplete = $row['complete'];
			
                      }
              }   
//Use Query to obtain academicComplete
              $query = "select * from application_info where uid='$uid'";
              $result = mysqli_query($conn,$query);
              if (mysqli_num_rows($result) > 0){
                      while($row = mysqli_fetch_assoc($result)){
                      $academicComplete = $row['complete'];
                      }
              }

//Use Query to obtain academicComplete
              $query = "select * from rec_letters where uid='$uid'";
              $result = mysqli_query($conn,$query);
              if (mysqli_num_rows($result) > 0){
                      while($row = mysqli_fetch_assoc($result)){
                      $recComplete = $row['complete'];
                      }
              }

//Use Query to obtain academicComplete
              $query = "select * from transcript where uid='$uid'";
              $result = mysqli_query($conn,$query);
              if (mysqli_num_rows($result) > 0){
                      while($row = mysqli_fetch_assoc($result)){
                      $transcriptComplete = $row['submitted'];
                      }
              }


//Use Query to obtain academicComplete
              $query = "select * from transcript where uid='$uid'";
              $result = mysqli_query($conn,$query);
              if (mysqli_num_rows($result) > 0){
                      while($row = mysqli_fetch_assoc($result)){
                      $transcriptComplete = $row['submitted'];
                      }
              }

//Use Query to obtain admitDecision
              $query = "select * from application_status where uid='$uid'";
              $result = mysqli_query($conn,$query);
              if (mysqli_num_rows($result) > 0){
                      $row = mysqli_fetch_assoc($result);
                      $admitDecision = $row['admission_status'];                    
              }

//Use Query to obtain admitDecision
              $query = "select * from application_status where uid='$uid'";
              $result = mysqli_query($conn,$query);
              if (mysqli_num_rows($result) > 0){
                      while($row = mysqli_fetch_assoc($result)){
                      $readyForEval = $row['admission_status'];
                      }
              }


   if($personalComplete == 1){
	$personalComplete = "Complete";
   }else{
	$personalComplete = "Incomplete";
   } 


   if($academicComplete == 1){
	$academicComplete = "Complete";
   } else {
	$academicComplete = "Incomplete";
   }

   if($recComplete == 1){
        $recComplete = "Complete";
   } else {
        $recComplete = "Incomplete";
   }

   if($transcriptComplete == 1){
        $transcriptComplete = "Complete";
   } else {
        $transcriptComplete = "Incomplete";
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

  <title>Application Status</title>

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
        <?php include('applicantTopbar.php'); ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Application Status</h1>
          </div>

          <!-- Content Column -->
          <div class="container-fluid">

            <!-- Content Row -->
            <div class="row">
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4 w-100 p-3">
                <a href="#appMaterials" class="d-block card-header py-3 w-100 p-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="appMaterials">
                  <h6 class="m-0 font-weight-bold text-primary">Application Materials</h6>
                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse" id="appMaterials">
                  <div class="card-body w-100 p-3">
                    <div class="row">
                      <p>Personal Information: <?php echo  $personalComplete;?></span></p>
                    </div>
                    <div class="row">
                      <p>Academic Information: <?php echo  $academicComplete;?></span></p>
                    </div>
                    <div class="row">
                      <p>Letters of Recomendation: <?php echo  $recComplete;?></span></p>
                    </div>
                    <div class="row">
                      <p>Transcripts: <?php echo  $transcriptComplete;?></span></p>
                    </div>
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
                <a href="#appDecision" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="appDecision">
                  <h6 class="m-0 font-weight-bold text-primary">Application Decision</h6>
                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse" id="appDecision">
                  <div class="card-body w-100 p-3">
                    <div class="row">
                      <p>Decision:<?php echo  $admitDecision;?></span> </p>
                    </div>
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

