<?php 
session_start();

include('connect.php');
 
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Transcripts</title>

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

    	<?php include('../../FlatEarthSociety/public_html/navbar.php');?>
      <!-- Main Content -->
      <?php 
      //$query = "SELECT a.uid, a.fname, a.lname, s.decision, s.admission_status, s.date_completed, s.num_evaluations FROM applicant as a, application_status as s WHERE a.uid=s.uid";
      //$query = "SELECT a.uid, a.fname, a.lname, s.decision, s.admission_status, s.date_completed, s.num_evaluations FROM applicant as a, application_status as s WHERE a.uid=s.uid";

      if(isset($_POST['update'])){
      	if($_POST['displayApps']=='all'){
      		$query = "SELECT a.uid,a.fname,a.lname,t.submitted FROM applicant as a, transcript as t WHERE a.uid=t.uid";
      	}else if($_POST['displayApps']=='need'){
      		$query = "SELECT a.uid,a.fname,a.lname,t.submitted FROM applicant as a, transcript as t WHERE a.uid=t.uid AND t.submitted=0";

      	}


      }else{
        $query = "SELECT a.uid,a.fname,a.lname,t.submitted FROM applicant as a, transcript as t WHERE a.uid=t.uid";

      }

      if(isset($_POST['add'])){
          if(isset($_POST["student"])){
            $uid = $_POST["student"];
            $update = "UPDATE transcript SET submitted=true WHERE uid='$uid'";
            $result = mysqli_query($conn,$update);

          }
          $query = "SELECT a.uid,a.fname,a.lname,t.submitted FROM applicant as a, transcript as t WHERE a.uid=t.uid";

      }










      
      $result = mysqli_query($conn,$query);
      if(mysqli_num_rows($result) >= 0){

?>

        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Student Transcripts</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Select an application to update</h6>
              <form method="post" action="updateTranscript.php">
              	<div class="form-group">
                      <a class="small">Which applications do you want to see?: </a>
                      <select name="displayApps">
                        <option value="all">All applications</option>
                        <option value="need">In need of a transcript</option>
                      </select>
                      <span class="error"> <?php echo $roleErr;?></span><br>
                    


              	<input class="btn btn-primary btn-user btn-block" type="submit" value="update" name="update" />
              	</div>
              	</form>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <form method="post" action="updateTranscript.php">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <tr>
                    <th>Select</th>
                    <th>UID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Transcript Submitted</th>
                </tr>
                <?php
        while($row = mysqli_fetch_assoc($result))
        {           
            //$uid = $row['uid'];
            //$query2 = "SELECT * FROM applicant where uid='$uid'";
            //$result2 = mysqli_query($conn,$query2);
            //$row2 = mysqli_fetch_assoc($result2);
          ?>
          <tr>
                    <td><input type="radio" name="student" value=<?php echo $row['uid']; ?> required></td>
                    <td> <?php echo $row['uid']; ?></td>
                    <td> <?php echo $row['fname'];  ?></td>
                    <td> <?php echo $row['lname']; ?></td>   
                    <td> 
                      <?php 
                        if($row['submitted']==0){
                          echo 'No';
                        }else{
                          echo 'Yes';
                        }
                        

                    ?></td>   
                      
          </tr>
          <?php
        }
        ?>
                </table>
                <input type="submit" name="add" value="The University has recieved this transcript" align="right">
</form>

              </form>
              </div>
            </div>

          </div>

        </div>
              <?php } ?>

        <!-- /.container-fluid -->

      </div>
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
