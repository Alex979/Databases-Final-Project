<?php
    session_start();
   include('connect.php');
$uname = $_SESSION['username'];
$uid = $_SESSION['uid'];
$fNameErr = $lNameErr = $emailErr = $ssnErr = "";
$phoneErr = $streetErr = $cityErr = $stateErr = $zipErr = "";
$successMessage = "";
$completeForm = true;

//$firstNameText = $lastNameText = $emailText;
$query = "select fname, lname, email from applicant where uid=$uid";
$result = mysqli_query($conn,$query);
$info = mysqli_fetch_assoc($result);
$firstNameText = $info['fname'];
$lastNameText = $info['lname'];
$emailText = $info['email'];

if(isset($_POST['submit'])){
      //check the first name requirements
	if (empty($_POST["fName"])) {
		$fNameErr  = " *Required Field"; //name field was empty so change the error message
	         $completeForm = false;
	} else {
		if(!preg_match("/^[a-zA-Z ]*$/",$_POST["fName"])){
			$fNameErr = " *Invalid Entry"; //name field was entered but not valid so change error message
		        $completeForm = false;
		}
	}
	//check the last name requirements
        if (empty($_POST["lName"])) {
                $lNameErr  = " *Required Field"; //name field was empty so change the error message
		$completeForm = false;
	} else {
                if(!preg_match("/^[a-zA-Z ]*$/",$_POST["lName"])){
                        $lNameErr = " *Invalid Entry"; //name field was entered but not valid so change error message
			$completeForm = false;
		}
	}
	//check the email requirements
        if (empty($_POST["email"])) {
                $emailErr  = " *Required Field"; //name field was empty so change the error message
		$completeForm = false;
	} else {
                if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                        $emailErr = " *Invalid Entry"; //name field was entered but not valid so change error message
			$completeForm = false;
		}
	}
	//check the ssn requirements
        if (empty($_POST["ssn"])) {
                $ssnErr  = " *Required Field"; //name field was empty so change the error message
                $completeForm = false;
        } else {
                if(!preg_match("/^[0-9-]*$/",$_POST["ssn"])){
                        $ssnErr = " *Invalid Entry"; //name field was entered but not valid so change error message
                        $completeForm = false;
                }
	}
	//check the phone number requirements
        if (empty($_POST["phone"])) {
                $phoneErr  = " *Required Field"; //name field was empty so change the error message
                $completeForm = false;
        } else {
                if(!preg_match("/^[0-9-]*$/",$_POST["phone"])){
                        $phoneErr = " *Invalid Entry"; //name field was entered but not valid so change error message
                        $completeForm = false;
                }
        }
	//check the street name requirements
        if (empty($_POST["street"])) {
                $streetErr  = " *Required Field"; //name field was empty so change the error message
                $completeForm = false;
        } else {
                if(!preg_match("/^[a-zA-Z0-9 ]*$/",$_POST["street"])){
                        $streetErr = " *Invalid Entry"; //name field was entered but not valid so change error message
                        $completeForm = false;
                }
	}
	//check the last name requirements
        if (empty($_POST["city"])) {
                $cityErr  = " *Required Field"; //name field was empty so change the error message
                $completeForm = false;
        } else {
                if(!preg_match("/^[a-zA-Z ]*$/",$_POST["city"])){
                        $cityErr = " *Invalid Entry"; //name field was entered but not valid so change error message
                        $completeForm = false;
                }
        }
	//check the state name requirements
        if (empty($_POST["state"])) {
                $stateErr  = " *Required Field"; //name field was empty so change the error message
                $completeForm = false;
        } else {
                if(!preg_match("/^[a-zA-Z ]*$/",$_POST["state"])){
                        $stateErr = " *Invalid Entry"; //name field was entered but not valid so change error message
                        $completeForm = false;
                }
	}
	//check the ssn requirements
        if (empty($_POST["zip"])) {
                $zipErr  = " *Required Field"; //name field was empty so change the error message
                $completeForm = false;
        } else {
                if(!preg_match("/^[0-9]*$/",$_POST["zip"])){
                        $zipErr = " *Invalid Entry"; //name field was entered but not valid so change error message
                        $completeForm = false;
                }
        }
	if($completeForm == true){
		$ssn = $_POST["ssn"];
		$fName = $_POST["fName"];
		$lName = $_POST["lName"];
		$street = $_POST["street"];
		$city = $_POST["city"];
		$state = $_POST["state"];
		$email = $_POST["email"];
		$phone = $_POST["phone"];
		$zip = $_POST["zip"];
		$complete = true;
        	$query = "UPDATE applicant SET fname='$fName', lname='$lName', email='$email', ssn='$ssn', street='$street', city='$city', state='$state', phone='$phone', zip='$zip', complete='1' WHERE uid='$uid'" ;
		$ret = mysqli_query($conn, $query);
		if($ret){
		//echo "New Record created successfully";
		} else {
		echo "Error: " .$query . "<br/>" . mysqli_error($conn);
		}

		$successMessage = " *Your Information was processed";
	}
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Personal Info</title>

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
        

          <!-- Topbar Navbar -->
          <?php include('applicantTopbar.php');?>
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
              <!-- Basic Card Example -->
              <div class="card shadow mb-4 w-100 p-3">
                <div class="card-header py-3">
                  <h4 class="m-0 font-weight-bold text-primary">Personal Information</h4><span class="text-success"><?php echo  $successMessage;?></span>
                </div>
                <div class="card-body">
                  <!-- BEGIN FORM-->
                  <form method="post" action="personalInfo.php">
                    <!-- CONTACT -->
                    <h6 class="m-0 font-weight-bold text-primary">Contact Information</h6>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="inputFName">First Name</label><span class="text-danger"><?php echo  $fNameErr;?></span>
                        <input type="text" class="form-control" id="inputFName" name="fName" value="<?php echo  $firstNameText;?>" >
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputLName">Last Name</label><span class="text-danger"><?php echo  $lNameErr;?></span>
                        <input type="text" class="form-control" id="inputLName" name="lName" value="<?php echo  $lastNameText;?>">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="inputEmail">Email</label><span class="text-danger"><?php echo  $emailErr;?></span>
                        <input type="text" class="form-control" id="inputEmail" name="email" value="<?php echo  $emailText;?>">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputSSN">SSN</label><span class="text-danger"><?php echo $ssnErr;?></span>
                        <input type="text" class="form-control" id="inputSSN" name="ssn">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputPhone">Phone Number</label><span class="text-danger"><?php echo  $phoneErr;?></span>
                        <input type="text" class="form-control" id="inputPhone" name="phone">
                      </div>
                    </div>
                    <!-- ADDRESS-->
                    <h6 class="m-0 font-weight-bold text-primary">Address</h6>
                    <div class="form-group">
                      <label for="inputAddress">Street</label><span class="text-danger"><?php echo  $streetErr;?></span>
                      <input type="text" class="form-control" id="inputAddress" name="street" >
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="inputCity">City</label><span class="text-danger"><?php echo  $cityErr;?></span>
                        <input type="text" class="form-control" id="inputCity" name="city">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputState">State</label><span class="text-danger"><?php echo  $stateErr;?></span>
                        <input type="text" class="form-control" id="inputState" name="state">
                      </div>
                      <div class="form-group col-md-2">
                        <label for="inputZip">Zip</label><span class="text-danger"><?php echo  $zipErr;?></span>
                        <input type="text" class="form-control" id="inputZip" name="zip">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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
