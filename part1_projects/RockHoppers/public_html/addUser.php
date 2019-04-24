<?php 
session_start();

include('connect.php');

//define error messages
$fnameErr=$lnameErr=$unameErr=$deptErr=$roleErr=$genErr=$signupErr="";

function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }


if(isset($_GET['fail']) && !empty($_GET['fail'])){

  if($_GET['fail']=='uname'){
    $signupErr="Username already exists";
  }else if($_GET['fail']=='pword'){
    $signupErr="Passwords must match";
  }


}


if(isset($_POST['submit'])){
	
	if (empty($_POST["username"])) {
        $unameErr = "*Username is required";
        $genErr="true";
    } else {
    	$uname = test_input($_POST["username"]);
    }

    if (empty($_POST["lastname"])) {
        $lnameErr = "*Last name is required";
        $genErr="true";
    } else {
    	$lname = test_input($_POST["lastname"]);
    }

    if (empty($_POST["firstname"])) {
        $fnameErr = "*First name is required";
        $genErr="true";
    } else {
    	$fname = test_input($_POST["firstname"]);
    }

    if ($_POST["dept"]=="") {//"" is default selected value
        $deptErr = "*Choose a department";
        $genErr="true";
    } else {
    	$dept = $_POST["dept"];
    }

    if ($_POST["userRole"]=="") {//"" is default selected value
        $roleErr = "*Choose a role";
        $genErr="true";
    } else {
    	$role = $_POST["userRole"];
    }

    if (empty($_POST["password"])) {
        $pwordErr = "*Password is required";
        $genErr="true";
    } else {
        $pword = test_input($_POST["password"]);
    }

    if (empty($_POST["password2"])) {
        $pword2Err = "*Password verification is required";
        $genErr="true";
    }  else {
        $pword2 = test_input($_POST["password2"]);
    }


    if($genErr == ""){//if no errors
    	//header('location:addUser.php?status=yay');exit;
    	if($pword != $pword2){
          header('location:addUser.php?fail=pword');exit;
        }



    	$query = "select username from user";
        $result = mysqli_query($conn,$query);
        if (mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_assoc($result)){
            
            if($row['username'] == $_POST["username"]){//user already exists
              header('location:addUser.php?fail=uname');exit;
            }
            
          }
        } 
        //if we get here, the user has entered everything
        //correctly and doesn't exist in the system

        $query = "INSERT INTO faculty (uname,fname,lname,department) VALUES ('$uname','$fname','$lname','$dept')";
        $result = mysqli_query($conn,$query);

        $query = "INSERT INTO user (username,password,role) VALUES ('$uname','$pword','$role')";
        $result = mysqli_query($conn,$query);

        header('location:userDashboard.php');exit;



    }







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

  <title>Add User</title>

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
            <h1 class="h3 mb-0 text-gray-800">Employee Information</h1>
          </div>

          <!-- Content Column -->
          <div class="container-fluid">

            <!-- Content Row -->
            <div class="row">
              <!-- Basic Card Example -->
              <div class="card shadow mb-4 w-100 p-3">
                <div class="card-header py-3">
                  <h4 class="m-0 font-weight-bold text-primary">Personal Information</h4>
                </div>
                <div class="card-body">
                  <!-- BEGIN FORM-->
                  <form class="user" method ="post"  action="addUser.php">
                  	<span class="error"> <?php echo $signupErr;?></span><br>
                    <!-- CONTACT -->
                    <h6 class="m-0 font-weight-bold text-primary">Contact Information</h6>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="inputFName">First Name</label>
                        <input type="text" class="form-control" id="inputFName" name="firstname">
                        <span class="error"> <?php echo $fnameErr;?></span><br>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputLName">Last Name</label>
                        <input type="text" class="form-control" id="inputLName" name="lastname">
                        <span class="error"> <?php echo $lnameErr;?></span><br>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="inputUname">Username</label>
                        <input type="text" class="form-control" id="inputEmail" name="username">
                        <span class="error"> <?php echo $unameErr;?></span><br>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputDept">Department</label>
                        <select name="dept" class="bodyFont">
				<option value="">Select Department</option>
				
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
                      
                    
                    <div class="form-group">
                      <a class="small">User-Role: </a>
                      <select name="userRole">
                        <option value="">Select Role</option>
                        <option value="system-admin">System Administrator</option>
                        <option value="faculty">Faculty</option>
                        <option value="cac">Chair of Admissionsm Comm</option>
                        <option value="gs">Grad Secretary</option>
                      </select>
                      <span class="error"> <?php echo $roleErr;?></span><br>
                    </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="inputPword">Password</label>
                        <input type="text" class="form-control" id="inputPword" name="password">
                        <span class="error"> <?php echo $pwordErr;?></span><br>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputPword2">Verify Password</label>
                        <input type="text" class="form-control" id="inputPword2" name="password2">
                        <span class="error"> <?php echo $pword2Err;?></span><br>
                      </div>
                    </div>
                    <!-- ADDRESS-->
                    
                    <input class="btn btn-primary btn-user btn-block" type="submit" value="Submit" name="submit" />
                  </form>
                  <!-- END FORM-->
                </div>
              </div>
            </div>
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
