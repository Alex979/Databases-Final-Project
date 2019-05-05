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

  <title>Faculty</title>

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

      if(isset($_POST['Update'])){
      	if($_POST['displayFac']=='all'){
      		$query = "SELECT  r.uid, r.type, u.uid, u.fname, u.lname FROM role as r, user as u WHERE r.uid =u.uid AND r.type='Faculty'";
      	}else{
          $dept = $_POST['dept'];
      		$query = "SELECT * FROM faculty WHERE department='$dept'";
      	}


      }else{
      	$query = "SELECT  r.uid, r.type, u.uid, u.fname, u.lname FROM role as r, user as u WHERE r.uid =u.uid AND r.type='Faculty'";

      }










      
      $result = mysqli_query($conn,$query);
      if(mysqli_num_rows($result) >= 0){

?>

        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Current Faculty</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Filter Results</h6>
              <form method="post" action="viewFac.php">
              	<div class="form-group">
                      <a class="small">Which faculty do you want to see?: </a>
                      <select name="displayFac">
                        <option value="all">All Faculty</option>
                        <option value="specific">Specific Department</option>
                        
                      </select>

                      <div class="form-group col-md-4">
                        <label for="inputDept">Department</label>
                        <select name="dept" class="bodyFont">
        
        
        <option value="ACA" >Academy for Classical Acting</option>
        
        <option value="ACCY" >Accountancy</option>
        
        <option value="AMST" >American Studies</option>
        
        <option value="ANAT" >Anatomy & Regenerative Biology</option>
        
        <option value="ANTH" >Anthropology</option>
        
        <option value="APSC" >Applied Science</option>
        
        <option value="ARAB" >Arabic</option>
        
        <option value="AH" >Art/Art History</option>
        
        <option value="FA" >Art/Fine Arts</option>
        
        <option value="ASTR" >Astronomy</option>
        
        <option value="BIOC" >Biochemistry</option>
        
        <option value="BISC" >Biological Sciences</option>
        
        <option value="BME" >Biomedical Engineering</option>
        
        <option value="BMSC" >Biomedical Sciences</option>
        
        <option value="BIOS" >Biostatistics</option>
        
        <option value="BADM" >Business Administration</option>
        
        <option value="CANC" >Cancer Biology</option>
        
        <option value="CHEM" >Chemistry</option>
        
        <option value="CHIN" >Chinese</option>
        
        <option value="CE" >Civil Engineering</option>
        
        <option value="CLAS" >Classical Studies</option>
        
        <option value="CCAS" >Columbian College</option>
        
        <option value="COMM" >Communication</option>
        
        <option value="CSCI" >Computer Science</option>
        
        <option value="CNSL" >Counseling</option>
        
        <option value="CPED" >Curriculum and Pedagogy</option>
        
        <option value="DATS" >Data Science</option>
        
        <option value="DNSC" >Decision Sciences</option>
        
        <option value="EALL" >East Asian Lang & Lit</option>
        
        <option value="ECON" >Economics</option>
        
        <option value="EDUC" >Educational Leadership</option>
        
        <option value="ECE" >Electrical & Computer Engring</option>
        
        <option value="EHS" >Emergency Health Services</option>
        
        <option value="ENGL" >English</option>
        
        <option value="EAP" >English for Academic Purposes</option>
        
        <option value="EMSE" >Engr Mgt & Systems Engineering</option>
        
        <option value="ENRP" >Environmental Resource Policy</option>
        
        <option value="ENVR" >Environmental Studies</option>
        
        <option value="EPID" >Epidemiology</option>
        
        <option value="EXNS" >Exercise & Nutrition Sciences</option>
        
        <option value="FILM" >Film Studies</option>
        
        <option value="FINA" >Finance</option>
        
        <option value="FORS" >Forensic Sciences</option>
        
        <option value="FREN" >French</option>
        
        <option value="GTCH" >GWTeach</option>
        
        <option value="GENO" >Genomics and Bioinformatics</option>
        
        <option value="GEOG" >Geography</option>
        
        <option value="GEOL" >Geology</option>
        
        <option value="GER" >Germanic Language & Literature</option>
        
        <option value="GCON" >Government Contracts</option>
        
        <option value="SEHD" >Graduate School of Ed & HD</option>

        <option value="GD" >Graphic Design</option>
        
        <option value="GREK" >Greek</option>
        
        <option value="HSCI" >Health Sciences Programs</option>
        
        <option value="HLWL" >Health and Wellness</option>
        
        <option value="HSML" >HealthServicesMgt&Leadership</option>
        
        <option value="HEBR" >Hebrew</option>
        
        <option value="HIST" >History</option>
        
        <option value="HOMP" >Hominid Paleobiology</option>
        
        <option value="HONR" >Honors</option>
        
        <option value="HOL" >Human Organizational Learning</option>
        
        <option value="HSSJ" >Human Services&Social Justice</option>
        
        <option value="ISTM" >InfSystemsTechnologyManagement</option>
        
        <option value="IDIS" >Interdisciplinary Courses</option>
        
        <option value="IA" >Interior Architecture</option>
        
        <option value="IAFF" >International Affairs</option>
        
        <option value="IBUS" >International Business</option>
        
        <option value="ITAL" >Italian</option>
        
        <option value="JAPN" >Japanese</option>
        
        <option value="JSTD" >Judaic Studies</option>
        
        <option value="KOR" >Korean</option>
        
        <option value="LATN" >Latin</option>
        
        <option value="LSPA" >Lifestyle,Sport& Phys Activity</option>
        
        <option value="LING" >Linguistics</option>
        
        <option value="MGT" >Management</option>
        
        <option value="MKTG" >Marketing</option>
        
        <option value="MBAD" >Master of Business Administrtn</option>
        
        <option value="MATH" >Mathematics</option>
        
        <option value="MAE" >Mechanical & Aerospace Engring</option>
        
        <option value="MICR" >Microbio, Immun & Tropical Med</option>
        
        <option value="MMED" >Molecular Medicine</option>
        
        <option value="MSTD" >Museum Studies</option>
        
        <option value="MUS" >Music</option>
        
        <option value="NSC" >Naval Science</option>
        
        <option value="NRSC" >Neuroscience</option>
        
        <option value="ORSC" >Organizational Sciences</option>
        
        <option value="PATH" >Pathology</option>
        
        <option value="PSTD" >Peace Studies</option>
        
        <option value="PERS" >Persian</option>
        
        <option value="PHAR" >Pharmacology</option>
        
        <option value="PHIL" >Philosophy</option>

        <option value="PH" >Photography</option>

        <option value="PJ" >Photojournalism</option>
        
        <option value="PT" >Physical Therapy</option>
        
        <option value="PA" >Physician Assistant</option>
        
        <option value="PHYS" >Physics</option>
        
        <option value="PHYL" >Physiology</option>
        
        <option value="PMGT" >Political Management</option>
        
        <option value="PPSY" >Political Psychology</option>
        
        <option value="PSC" >Political Science</option>
        
        <option value="PSYD" >Professional Psychology</option>
        
        <option value="PSYC" >Psychology</option>
        
        <option value="PUBH" >Public Health</option>
        
        <option value="PPPA" >Public Policy and Public Admin</option>
        
        <option value="REL" >Religion</option>
        
        <option value="SEAS" >School of Eng & Applied Sci</option>
        
        <option value="SMPA" >School of Media&Public Affairs</option>
        
        <option value="SLAV" >Slavic Languages & Lit</option>
        
        <option value="SOC" >Sociology</option>
        
        <option value="SPAN" >Spanish</option>
        
        <option value="SPED" >Special Education</option>
        
        <option value="SPHR" >Speech, Lang., & Hearing Sci.</option>
        
        <option value="STAT" >Statistics</option>
        
        <option value="SMPP" >Strategic Mgt & Public Policy</option>
        
        <option value="SUST" >Sustainability</option>
        
        <option value="TSAP" >Teaching in Sci. & Professions</option>
        
        <option value="TRDA" >Theatre and Dance</option>
        
        <option value="TSTD" >Tourism Studies</option>
        
        <option value="UW" >University Writing</option>
        
        <option value="WLP" >Women and Leadership Program</option>
        
        <option value="WGSS" >Women's,Gender&SexualityStudy</option>
        
        </select>
        <span class="error"> <?php echo $deptErr;?></span><br>
                      </div>
                      
                    


              	<input class="btn btn-primary btn-user btn-block" type="submit" value="update" name="Update" />
              	</div>
              	</form>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <tr>
                    
                    <th>FID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Department</th>
                   
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
                    
                    <td> <?php echo $row['uid']; ?></td>
                    <td> <?php echo $row['fname'];  ?></td>
                    <td> <?php echo $row['lname']; ?></td>   
                    <td> <?php echo $row['department']; ?></td>   
                      
          </tr>
          <?php
        }
        ?>
                </table>
                

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
