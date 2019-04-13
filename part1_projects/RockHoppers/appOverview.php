<?php 
session_start();

include('connect.php');


if(isset($_POST['admit'])){

	$uid=$_GET['id'];
	$update = "UPDATE application_status SET admission_status='admit' WHERE uid='$uid'";
	$result = mysqli_query($conn,$update);
	header("location:displayAppStatus.php");exit;
}else if(isset($_POST['reject'])){ 
	$uid=$_GET['id'];
	$update = "UPDATE application_status SET admission_status='reject' WHERE uid='$uid'";
	$result = mysqli_query($conn,$update);
	header("location:displayAppStatus.php");exit;
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
        <?php include('saTopbar.php'); ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Applicant Information</h1>
          </div>

          <!-- Content Column -->
          <div class="container-fluid">

            <!-- Content Row -->
            <div class="row">
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4 w-100 p-3">
                <a href="#appMaterials" class="d-block card-header py-3 w-100 p-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="appMaterials">
                  <h6 class="m-0 font-weight-bold text-primary">Personal Information</h6>
                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse" id="appMaterials">
                  <div class="card-body w-100 p-3">
                    <div class="row">
                      
                      <?php

      if(!isset($_POST["student"])){
      	header("location:displayAppStatus.php");exit;
      }
      $uid = $_POST["student"];
      $_SESSION['applicant-uid']=$uid;
      $uidString = (String)$uid;

      include('connect.php');

      $query = "SELECT * FROM applicant WHERE uid = '$uid'";
      $result = mysqli_query($conn,$query);
      $applicant = mysqli_fetch_assoc($result);

      $firstName = $applicant['fname'];
      $lastName = $applicant['lname'];
      $street = $applicant['street'];
      $city = $applicant['city'];
      $state = $applicant['state'];
      $email = $applicant['email'];
      $phone = $applicant['phone'];
      $zip = $applicant['zip'];




      echo 'Name: '.$lastName.', '.$firstName.'<br />';
      echo 'Student Number: '.$uid.'<br />';
      echo 'Address: '.$street. ', '.$city.', '.$state.', '.$zip.'<br /><br />';
      echo 'Contact Info: <br />';
      echo 'Phone: '. $phone.'<br />';
      echo 'Email: '. $email.'<br />';
      
      

      //need to add letters of recconmendation, and grad committee rating
       ?>
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
                  <h6 class="m-0 font-weight-bold text-primary">Academic Information</h6>
                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse" id="appDecision">
                  <div class="card-body w-100 p-3">
                    <div class="row">
                		<?php
      $uid = $_POST["student"];
      $uidString = (String)$uid;

      include('connect.php');

      $query = "SELECT * FROM applicant WHERE uid = '$uid'";
      $result = mysqli_query($conn,$query);
      $applicant = mysqli_fetch_assoc($result);

      $firstName = $applicant['fname'];
      $lastName = $applicant['lname'];

      $query2 = "SELECT * from application_info where uid = '$uid'";
      $result2 = mysqli_query($conn,$query2);
      $applicationInfo = mysqli_fetch_assoc($result2);

      $semester = $applicationInfo['start_semester'];
      $year = $applicationInfo['start_year'];
      $degreeSought = $applicationInfo['degree_sought'];

      

      $bachDegree = $applicationInfo['b_degree'];
      $bachSchool = $applicationInfo['b_university'];
      $bachGpa = $applicationInfo['b_gpa'];
      $bachDate = $applicationInfo['b_date'];

      $MADegree = $applicationInfo['m_degree'];
      $MASchool = $applicationInfo['m_university'];
      $MAGpa = $applicationInfo['m_gpa'];
      $MADate = $applicationInfo['m_date'];

      $interest = $applicationInfo['area_of_interest'];
      $experience = $applicationInfo['work_experience'];

      $query3 = "SELECT * FROM subject_score where uid='$uid'";
      $result3 = mysqli_query($conn,$query3);



      



      // $greVerbal = $applicationInfo['verbal_gre'];
      // $greQuant = $applicationInfo['quant_gre'];
      // $greTotal = $applicationInfo['total_gre'];
       $greDate = $applicationInfo['gre_date'];
       $toeDate = $applicationInfo['toeffel_date'];



      echo 'Name: '.$lastName.', '.$firstName.'<br />';
      echo 'Student Number: '.$uid.'<br />';
      echo 'Semester and year of application: '.$semester. ' '.$year.'<br />';
      echo 'Degree Sought: '. $degreeSought.'<br /><br />';
      echo 'Summary of Credentials <br />';
      //echo 'GRE Verbal: '.$greVerbal.'   GRE Quantitative: '.$greQuant.'GRE Total: '.$greTotal.'<br />';
      echo 'Year of GRE Exam: '.$greDate.'<br />';
      if(isset($toeDate)){
      			echo 'Year of Toeffel Exam: '.$toeDate.'<br />';
      }
      if(mysqli_num_rows($result) >= 0){

      	while($testInfo = mysqli_fetch_assoc($result3)){

      		echo 'Subject: '.$testInfo['subject'].'  <br/>Score: '.$testInfo['score'].'<br/>';
      	}

      	echo '<br/>';
      }
      
      echo 'Prior Degrees <br />';
      if($MADegree!=0)
      {
        echo 'Masters: <br />   GPA: '.$MAGpa.'<br/>Major: '.$MADegree.'<br/>Year: '.$MADate.'<br/>University: '.$MASchool.'<br />';
      }
      echo 'BS/BA: <br />  GPA: '.$bachGpa.'<br/>Major: '.$bachDegree.'<br/>Year: '.$bachDate.'<br/>University: '.$bachSchool.'<br />';
      
      echo 'Interests: '.$interest.'<br />';
      echo 'Experience: '.$experience.'<br /><br />';

      $query = "SELECT submitted FROM transcript WHERE uid = '$uid'";
      $result = mysqli_query($conn,$query);
      $transcript = mysqli_fetch_assoc($result);
      $submitted = $transcript['submitted'];

      echo 'Transcript Submitted: ';
      if($submitted){
        echo 'Yes<br/>';
      }else{
        echo 'No<br/>';
      }

      //need to add letters of recconmendation, and grad committee rating
       ?>
                    </div>
                    
                  </div>
                  <!-- END CARD BODY -->
                </div>
                <!-- END COLLAPSABLE CONTENT -->
              </div>
              <!-- END CARD -->
            </div>
            <!-- END ROW -->
            <!-- START ROW -->
            <div class="row">
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4 w-100 p-3">
                <a href="#recLetters" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="recLetters">
                  <h6 class="m-0 font-weight-bold text-primary">Reccomendation Letters</h6>
                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse" id="recLetters">
                  <div class="card-body w-100 p-3">
                  	<div class="row">
                  		<?php
                  		$query = "SELECT * FROM rec_letters WHERE uid = '$uid'";
					    $result = mysqli_query($conn,$query);

					    if(mysqli_num_rows($result) >= 0){

					      	while($rec = mysqli_fetch_assoc($result)){

					      		$rec_fname = $rec['rec_fname'];
							    $rec_lname = $rec['rec_lname'];
							    $rec_email = $rec['rec_email'];
							    $rec_title = $rec['rec_title'];
							    $rec_affiliation = $rec['rec_affiliation'];
							    $reccomendation = $rec['reccomendation'];
							    $rating = $rec['rating'];
							    $generic = $rec['generic'];
							    $credible = $rec['credible'];


							    echo 'Reccomender: '.$rec_lname.', '.$rec_fname.'<br/>';
							    echo 'Reccomender title: '.$rec_title.'<br/>';
							    echo 'Reccomender affiliation: '.$rec_affiliation.'<br/>';
							    echo 'Reccomender email: '.$rec_email.'<br/>';
							    echo 'Reccomendation:<br/>'.$reccomendation.'<br/><br/>';
							    echo 'CAC evaluation of letter:<br/>';
							    echo 'Rating: '.$rating.'<br/>';
							    echo 'Generic: '.$generic.'<br/>';
							    echo 'Credible: '.$credible.'<br/>';

					      	}
					      	
					    }
                  		?>

                  	</div>
                  	
                    
                  </div>
                  <!-- END CARD BODY -->
                </div>
                <!-- END COLLAPSABLE CONTENT -->
              </div>
              <!-- END CARD -->
            </div>
            <!-- END ROW -->
            <!-- START ROW -->
            <div class="row">
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4 w-100 p-3">
                <a href="#facEval" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="facEval">
                  <h6 class="m-0 font-weight-bold text-primary">Faculty Evalutations</h6>
                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse" id="facEval">
                  <div class="card-body w-100 p-3">
                  	<div class="row">
                  		<?php
                  		$query = "SELECT fe.comments,fe.reason, fe.ranking,fe.rec_advisor,f.fname,f.lname FROM faculty_evaluation as fe,faculty as f WHERE uid='$uid' AND fe.fid=f.fid";
					    $result = mysqli_query($conn,$query);

					    if(mysqli_num_rows($result) >= 0){

					      	while($rec = mysqli_fetch_assoc($result)){

					      		$facFname = $rec['fname'];
							    $facLname = $rec['lname'];
							    $facDept = $rec['department'];
							    $comments = $rec['comments'];
							    $reason = $rec['reason'];
							    $rank = $rec['ranking'];
							    $rec_advisor = $rec['rec_advisor'];

							    echo 'Faculty Reviewer (from '.$facDept.' department):<br/>';
							    echo 'Name: '.$facLname.', '.$facFname.'<br/>';
							    echo 'Comments:<br/>'.$comments.'<br/>';
							    echo 'Rank: '.$rank.'<br/>';
							    echo 'Reccomendation: ';
							    if($rank==1){
							    	echo 'Reject<br/>';
							    }else if($rank==2){
							    	echo 'Borderline (Not sure about accepting applicant)<br/>';
							    }else if($rank==3){
							    	echo 'Admit without aid<br/>';
							    }else if($rank==4){
							    	echo 'Admit with aid<br/>';
							    }
							    if($reason != 'admitted'){
							    	echo 'Reason: '.$reason.'<br/>';
							    }
							    
							    
							    echo 'Reccomended advisor:<br/>'.$rec_advisor.'<br/><br/>';


					      	}
					      	
					    }
                  		?>

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
