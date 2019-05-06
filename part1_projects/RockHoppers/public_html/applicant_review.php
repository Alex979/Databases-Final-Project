<?php session_start(); 
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
<style>
table, th, td {
  border: 1px solid black;
}
</style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Review Applicant</title>

  <!-- Custom fonts for this template -->
  <link href="apps/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="apps/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="apps/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include('../../FlatEarthSociety/public_html/navbar.php');?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
         <!--  <h1 class="h3 mb-4 text-gray-800">Application</h1> -->
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
      $major = $applicationInfo['major'];
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
       if($_POST["button"]=='Make Decision')
       {
          ?>
            <!-- START ROW -->
            <div class="row">
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4 w-100 p-3"">
                <a href="#facEval" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="facEval">
                  <h6 class="m-0 font-weight-bold text-primary">Faculty Evalutations</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="facEval">
                  <div class="card-body w-100 p-3"">
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
                  if($rank==0){
                    echo 'Reject<br/>';
                  }else if($rank==1){
                    echo 'Borderline (Not sure about accepting applicant)<br/>';
                  }else if($rank==2){
                    echo 'Admit without aid<br/>';
                  }else if($rank==3){
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

          <?php
       }
       
       echo '<table>';
       
       if($_POST["button"]=='Review')
       {
          echo '<tr> <th>Application</th><th>Review</th></tr>';
       }
       else
       {
        echo '<tr> <th>Application</th><th>Make Decision</th></tr>';
       }
       echo '<tr>';
       echo '<td>';
      echo 'Name: '.$lastName.', '.$firstName.'<br />';
      echo 'Student Number: '.$uid.'<br />';
      echo 'Semester and year of application: '.$semester. ' '.$year.'<br />';
      echo 'Degree Sought: '. $degreeSought.' in '.$major.'<br /><br />';
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
      if(isset($MADegree))
      {
        echo 'Masters: <br />   GPA: '.$MAGpa.'<br/>Major: '.$MADegree.'<br/>Year: '.$MADate.'<br/>University: '.$MASchool.'<br />';
      }
      echo 'BS/BA: <br />  GPA: '.$bachGpa.'<br/>Major: '.$bachDegree.'<br/>Year: '.$bachDate.'<br/>University: '.$bachSchool.'<br />';
      
      echo 'Interests: '.$interest.'<br />';
      echo 'Experience: '.$experience.'<br />';
      echo '</td>';
      //need to add letters of recconmendation, and grad committee rating
       ?>

<br /><br />
  <td valign="top">
    <?php if($_POST["button"]=='Review')
    {?>
       Grad Admissions Committee (GAS) Review Rating: <br /><br />
       <form method="post" action="processReviewData.php">
        Admit or Reject Applicant: 
       	<select name="admitCategory">
  			<option value="Reject">Reject</option>
  			<option value="badmit">Borderline Admit</option>
  			<option value="admit">Admit without Aid</option>
  			<option value="admitwaid">Admit with Aid</option>
		</select>
		<br /><br />
		
		Reason(s) for reject (select "Admitted" if you have not rejected the applicant): <select name="reason">
    <option value="admitted" checked> Admitted</option>
  		<option value="incomplete"> Incomplete Record</option>
  		<option value="inadequate"> Does not meet requirements</option>
  		<option value="letterIssues"> Problems with Letters</option>
  		<option value="uncompetitive"> Not Competitive</option>
  		<option value="else"> Other reasons</option>
    </select><br /><br />
      <input type="text" name ="comments" placeholder="GAS Reviewer Comments"><br />
      <input type = "hidden" name = "uid" value = <?php echo $uid; ?>><br />
      Recommended Advisor: 
    <select name = "advisor">
        <?php 
            $query4 = "SELECT * FROM faculty WHERE department='$major'";
            $result4 = mysqli_query($conn,$query4);
            if(mysqli_num_rows($result4) >= 0){
              while($advisors = mysqli_fetch_assoc($result4)){
                 echo '<option value='.$advisors["fname"].' '.$advisors["lname"].'>'.$advisors["fname"].' '.$advisors["lname"].'</option>';
        }
      }
        ?>
    </select><br /><br />
    <?php 
        $query5 = "SELECT num_evaluations FROM application_status WHERE uid = '$uid'";
        $result5 = mysqli_query($conn,$query5);
        $row5 = mysqli_fetch_assoc($result5);
        $numEvals=$row5["num_evaluations"];
        
          $query6="SELECT * FROM rec_letters where uid = '$uid'";
          $result6=mysqli_query($conn,$query6);
          $row6 = mysqli_fetch_assoc($result6);
          if($row6["complete"] == 1){
          echo 'Letter of Recomendation: <br />';
          echo 'Sender: '.$row6["rec_title"].' '.$row6["rec_fname"].' '.$row6["rec_lname"].'<br />';
          echo 'Sender Email '.$row6["rec_email"].'<br />';
          echo 'Sender Affiliation: '.$row6["rec_affiliation"].'<br />';
          echo 'Contents: '.$row6["reccomendation"].'<br /><br />';
          if($row6["rating"]!=NULL)
          {
            echo 'Rating: '.$row6["rating"].'<br />';
          }
          if($row6["generic"]!=NULL)
          {
            echo 'Generic: '.$row6["generic"].'<br />';
          }
          if($row6["credible"]!=NULL)
          {
            echo 'Credible: '.$row6["credible"].'<br /><br />';
	  }

          if($numEvals>1 && in_array("faculty", $_SESSION["role"]) && $row6["rating"]==NULL)
          { ?>
            <input type = "hidden" name ="processLetter" value = "yes">
            Please rate this letter: <br />
            Rating: 
            <select name = "letterRating">
              <option value="5">5 (best)</option>
              <option value="4">4</option>
              <option value="3">3</option>
              <option value="2">2</option>
              <option value="1">1 (worst)</option>
            </select>
            Generic: 
            <select name = "generic">
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select>
            Credible: 
            <select name = "credible">
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select>
            <br /><br />
    <?php
          }
        }
    ?>
		<input type ="submit" name="submit" value = "Submit">
	</form>
<?php }
  elseif(in_array("cac", $_SESSION["role"]))
  {
?>
  <form method = "post" action="updateDecision.php">
    <input type = "hidden" name = "uid" value = <?php echo $uid; ?>>
    <input type = submit name = "decision" value = "admit with aid">
    <input type = submit name = "decision" value = "admit">
    <input type = submit name = "decision" value = "reject">
</form>
  <?php 
}
 ?>
</td>
</tr>
</table>

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
  <script src="apps/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="apps/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="apps/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
