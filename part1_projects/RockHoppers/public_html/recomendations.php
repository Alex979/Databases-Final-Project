<?php

  session_start();
  include('connect.php');
  $uid = $_SESSION['uid'];


  //Define Error Messages
  $recFNameOErr= $recLNameOErr = $recEmailOErr = $recTitleOErr = $recAffOErr = "";
  $recFNameTErr= $recLNameTErr = $recEmailTErr = $recTitleTErr = $recAffTErr = "";
  $recFNameThErr= $recLNameThErr = $recEmailThErr = $recTitleThErr = $recAffThErr = "";

  $successMessage = $successMessageT = $successMessageTh = "";
  $completeForm = true;

  if(isset($_POST['recLetterO'])){
    //check the degree name requirements
    if (empty($_POST["recFName"])) {
      $recFNameErr = " *Required Field"; //name field was empty so change the error message
      $completeForm = false;
    } else {
      if(!preg_match("/^[a-zA-Z ]*$/",$_POST["recFName"])){
        $recFNameErr = " *Invalid Entry"; //name field was entered but not valid so change error message
        $completeForm = false;
      }
    }

    //check the degree name requirements
    if (empty($_POST["recLName"])) {
      $recLNameErr = " *Required Field"; //name field was empty so change the error message
      $completeForm = false;
    } else {
      if(!preg_match("/^[a-zA-Z ]*$/",$_POST["recLName"])){
        $recLNameErr = " *Invalid Entry"; //name field was entered but not valid so change error message
        $completeForm = false;
      }
    }

    //check the rec email requirements
    if (empty($_POST["recEmail"])) {
      $recEmailErr = " *Required Field"; //name field was empty so change the error message
      $completeForm = false;
    } else {
      if(!filter_var($_POST["recEmail"], FILTER_VALIDATE_EMAIL)){
        $recEmailErr = " *Invalid Entry"; //name field was entered but not valid so change error message
        $completeForm = false;
      }
    }

    //check the Rec title requirements
    if (empty($_POST["recTitle"])) {
      $recTitleErr = " *Required Field"; //name field was empty so change the error message
      $completeForm = false;
    } else {
      if(!preg_match("/^[a-zA-Z ]*$/",$_POST["recTitle"])){
        $recTitleErr = " *Invalid Entry"; //name field was entered but not valid so change error message
        $completeForm = false;
      }
    }

    //check the degree name requirements
    if (empty($_POST["recAffiliation"])) {
      $recAffErr = " *Required Field"; //name field was empty so change the error message
      $completeForm = false;
    } else {
      if(!preg_match("/^[a-zA-Z ]*$/",$_POST["recAffiliation"])){
        $recAffErr = " *Invalid Entry"; //name field was entered but not valid so change error message
        $completeForm = false;
      }
    }

      if($completeForm == true){
        $fname = $_POST["recFname"];
        $lname = $_POST["recLname"];
        $email = $_POST["recEmail"];
        $title = $_POST["recTitle"];
        $affliation = $_POST["recAffiliation"];
        $recomendation = "Letter has been Requested";

        $query = "INSERT INTO rec_letters(uid, rec_fname, rec_lname, rec_email, rec_title, rec_affiliation, reccomendation, complete) VALUES ('$uid', '$fname', '$lname', '$email', '$title', '$affliation','$recomendation', 0)";
        $result = mysqli_query($conn,$query);
        $successMessage = "Letter Requested";
        $_SESSION['recEmail'] = $email;
        
        //Send the Email 
        $msg = "Hello, ".$fName." ".$lName."   Please go to: https://bit.ly/2H1PGnZ to enter your recomendation. Use UID:" .$uid." ";
        $subject = 'Letter of Recomendation';
        
        $msg = wordwrap($msg, 70);
        $ret = mail($email, $subject, $msg);
        if($ret){
               
        }
    }else {
        $successMessage = "Please Enter All The Information";
      }

  }

  if(isset($_POST['recLetterT'])){
    //check the degree name requirements
    if (empty($_POST["recFName"])) {
      $recFNameTErr = " *Required Field"; //name field was empty so change the error message
      $completeForm = false;
    } else {
      if(!preg_match("/^[a-zA-Z ]*$/",$_POST["recFName"])){
        $recFNameTErr = " *Invalid Entry"; //name field was entered but not valid so change error message
        $completeForm = false;
      }
    }

    //check the degree name requirements
    if (empty($_POST["recLName"])) {
      $recLNameTErr = " *Required Field"; //name field was empty so change the error message
      $completeForm = false;
    } else {
      if(!preg_match("/^[a-zA-Z ]*$/",$_POST["recLName"])){
        $recLNameTErr = " *Invalid Entry"; //name field was entered but not valid so change error message
        $completeForm = false;
      }
    }

    //check the rec email requirements
    if (empty($_POST["recEmail"])) {
      $recEmailTErr = " *Required Field"; //name field was empty so change the error message
      $completeForm = false;
    } else {
      if(!filter_var($_POST["recEmail"], FILTER_VALIDATE_EMAIL)){
        $recEmailTErr = " *Invalid Entry"; //name field was entered but not valid so change error message
        $completeForm = false;
      }
    }

    //check the Rec title requirements
    if (empty($_POST["recTitle"])) {
      $recTitleTErr = " *Required Field"; //name field was empty so change the error message
      $completeForm = false;
    } else {
      if(!preg_match("/^[a-zA-Z ]*$/",$_POST["recTitle"])){
        $recTitleTErr = " *Invalid Entry"; //name field was entered but not valid so change error message
        $completeForm = false;
      }
    }

    //check the degree name requirements
    if (empty($_POST["recAffiliation"])) {
      $recAffTErr = " *Required Field"; //name field was empty so change the error message
      $completeForm = false;
    } else {
      if(!preg_match("/^[a-zA-Z ]*$/",$_POST["recAffiliation"])){
        $recAffTErr = " *Invalid Entry"; //name field was entered but not valid so change error message
        $completeForm = false;
      }
    }

      if($completeForm == true){
        $fname = $_POST["recFname"];
        $lname = $_POST["recLname"];
        $email = $_POST["recEmail"];
        $title = $_POST["recTitle"];
        $affliation = $_POST["recAffiliation"];
        $recomendation = "Letter has been Requested";

        $query = "INSERT INTO rec_letters(uid, rec_fname, rec_lname, rec_email, rec_title, rec_affiliation, reccomendation, complete) VALUES ('$uid', '$fname', '$lname', '$email', '$title', '$affliation','$recomendation', 0)";
        $result = mysqli_query($conn,$query);
        $successMessageT = "Letter Requested";
        $_SESSION['recEmail'] = $email;

         //Send the Email 
         $msg = 'Hello, '.$fName.' '.$lName.'   Please go to: https://bit.ly/2H1PGnZ to enter your recomendation. Use UID:'.$uid;
         $subject = 'Letter of Recomendation';
         
         $msg = wordwrap($msg, 70);
         $ret = mail($email, $subject, $msg);
         if($ret){
        
	}
      } else {
      	$successMessageT = "Please Enter All The Information";
      }
  }

  if(isset($_POST['recLetterTh'])){
    //check the degree name requirements
    if (empty($_POST["recFName"])) {
      $recFNameThErr = " *Required Field"; //name field was empty so change the error message
      $completeForm = false;
    } else {
      if(!preg_match("/^[a-zA-Z ]*$/",$_POST["recFName"])){
        $recFNameThErr = " *Invalid Entry"; //name field was entered but not valid so change error message
        $completeForm = false;
      }
    }

    //check the degree name requirements
    if (empty($_POST["recLName"])) {
      $recLNameThErr = " *Required Field"; //name field was empty so change the error message
      $completeForm = false;
    } else {
      if(!preg_match("/^[a-zA-Z ]*$/",$_POST["recLName"])){
        $recLNameThErr = " *Invalid Entry"; //name field was entered but not valid so change error message
        $completeForm = false;
      }
    }

    //check the rec email requirements
    if (empty($_POST["recEmail"])) {
      $recEmailThErr = " *Required Field"; //name field was empty so change the error message
      $completeForm = false;
    } else {
      if(!filter_var($_POST["recEmail"], FILTER_VALIDATE_EMAIL)){
        $recEmailThErr = " *Invalid Entry"; //name field was entered but not valid so change error message
        $completeForm = false;
      }
    }

    //check the Rec title requirements
    if (empty($_POST["recTitle"])) {
      $recTitleThErr = " *Required Field"; //name field was empty so change the error message
      $completeForm = false;
    } else {
      if(!preg_match("/^[a-zA-Z ]*$/",$_POST["recTitle"])){
        $recTitleThErr = " *Invalid Entry"; //name field was entered but not valid so change error message
        $completeForm = false;
      }
    }

    //check the degree name requirements
    if (empty($_POST["recAffiliation"])) {
      $recAffThErr = " *Required Field"; //name field was empty so change the error message
      $completeForm = false;
    } else {
      if(!preg_match("/^[a-zA-Z ]*$/",$_POST["recAffiliation"])){
        $recAffThErr = " *Invalid Entry"; //name field was entered but not valid so change error message
        $completeForm = false;
      }
    }

      if($completeForm == true){
        $fname = $_POST["recFname"];
        $lname = $_POST["recLname"];
        $email = $_POST["recEmail"];
        $title = $_POST["recTitle"];
        $affliation = $_POST["recAffiliation"];
        $recomendation = "Letter has been Requested";

        $query = "INSERT INTO rec_letters(uid, rec_fname, rec_lname, rec_email, rec_title, rec_affiliation, reccomendation, complete) VALUES ('$uid', '$fname', '$lname', '$email', '$title', '$affliation','$recomendation', 0)";
        $result = mysqli_query($conn,$query);
        $successMessageTh = "Letter Requested";
        $_SESSION['recEmail'] = $email;

        //Send the Email 
        $msg = 'Hello, '.$fName.' '.$lName.'   Please go to: https://bit.ly/2H1PGnZ to enter your recomendation. Use UID:'.$uid;
        $subject = 'Letter of Recomendation';
        
        $msg = wordwrap($msg, 70);
        $ret = mail($email, $subject, $msg);
        echo $ret;
        if($ret){
               
        }
    }else {
        $successMessageTh = "Please Enter All The Information";
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

  <title>Recomendations</title>

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
            <h1 class="h3 mb-0 text-gray-800">Request Letters of Recomendation</h1>
          </div>

          <!-- Content Column -->
          <div class="container-fluid">

            <!-- Content Row -->
            <div class="row">
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4 w-100 p-3">
                <a href="#recOne" class="d-block card-header py-3 w-100 p-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="recOne">
                  <h6 class="m-0 font-weight-bold text-primary">Recomender One</h6><span class="text-success"><?php echo  $successMessage;?></span>
                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse" id="recOne">
                  <div class="card-body w-100 p-3">
                    <form method="post" action="recomendations.php">
                      <!-- CONTACT -->
                      <h6 class="m-0 font-weight-bold text-primary">Contact Information</h6>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="recFName">First Name</label><span class="text-danger"><?php echo  $recFNameErr;?></span>
                          <input type="text" class="form-control" id="recFName" name="recFName">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="recLName1">Last Name</label><span class="text-danger"><?php echo  $recLNameErr;?></span>
                          <input type="text" class="form-control" id="recLName" name="recLName">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="recEmail">Email</label><span class="text-danger"><?php echo  $recEmailErr;?></span>
                          <input type="text" class="form-control" id="recEmail" name="recEmail">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="recTitle">Title</label><span class="text-danger"><?php echo  $recTitleErr;?></span>
                          <input type="text" class="form-control" id="recTitle" name="recTitle">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="recAffiliation">Affiliation</label><span class="text-danger"><?php echo  $recAffErr;?></span>
                          <input type="text" class="form-control" id="recAffiliation" name="recAffiliation">
                        </div>
                      </div>
                      <button type="submit" name="recLetterO" class="btn btn-primary">Request Letter</button>
                    </form>
                  </div>
                  <!-- END CARD BODY -->
                </div>
                <!-- END COLLAPSABLE CONTENT -->
              </div>


	      <!-- Collapsable Card Example -->
              <div class="card shadow mb-4 w-100 p-3">
                <a href="#recTwo" class="d-block card-header py-3 w-100 p-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="recTwo">
                  <h6 class="m-0 font-weight-bold text-primary">Recomender Two</h6><span class="text-success"><?php echo  $successMessageT;?></span>
                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse" id="recTwo">
                  <div class="card-body w-100 p-3">
                    <form method="post" action="recomendations.php">
                      <!-- CONTACT -->
                      <h6 class="m-0 font-weight-bold text-primary">Contact Information</h6>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="recFName">First Name</label><span class="text-danger"><?php echo  $recFNameTErr;?></span>
                          <input type="text" class="form-control" id="recFName" name="recFName">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="recLName1">Last Name</label><span class="text-danger"><?php echo  $recLNameTErr;?></span>
                          <input type="text" class="form-control" id="recLName" name="recLName">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="recEmail">Email</label><span class="text-danger"><?php echo  $recEmailTErr;?></span>
                          <input type="text" class="form-control" id="recEmail" name="recEmail">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="recTitle">Title</label><span class="text-danger"><?php echo  $recTitleTErr;?></span>
                          <input type="text" class="form-control" id="recTitle" name="recTitle">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="recAffiliation">Affiliation</label><span class="text-danger"><?php echo  $recAffTErr;?></span>
                          <input type="text" class="form-control" id="recAffiliation" name="recAffiliation">
                        </div>
                      </div>
                      <button type="submit" name="recLetterT" class="btn btn-primary">Request Letter</button>
                    </form>
                  </div>
                  <!-- END CARD BODY -->
                </div>
                <!-- END COLLAPSABLE CONTENT -->
              </div>


 	      <!-- Collapsable Card Example -->
              <div class="card shadow mb-4 w-100 p-3">
                <a href="#recThree" class="d-block card-header py-3 w-100 p-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="recThree">
                  <h6 class="m-0 font-weight-bold text-primary">Recomender Three</h6><span class="text-success"><?php echo  $successMessageTh;?></span>
                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse" id="recThree">
                  <div class="card-body w-100 p-3">
                    <form method="post" action="recomendations.php">
                      <!-- CONTACT -->
                      <h6 class="m-0 font-weight-bold text-primary">Contact Information</h6>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="recFName">First Name</label><span class="text-danger"><?php echo  $recFNameThErr;?></span>
                          <input type="text" class="form-control" id="recFName" name="recFName">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="recLName1">Last Name</label><span class="text-danger"><?php echo  $recLNameThErr;?></span>
                          <input type="text" class="form-control" id="recLName" name="recLName">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="recEmail">Email</label><span class="text-danger"><?php echo  $recEmailThErr;?></span>
                          <input type="text" class="form-control" id="recEmail" name="recEmail">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="recTitle">Title</label><span class="text-danger"><?php echo  $recTitleThErr;?></span>
                          <input type="text" class="form-control" id="recTitle" name="recTitle">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="recAffiliation">Affiliation</label><span class="text-danger"><?php echo  $recAffThErr;?></span>
                          <input type="text" class="form-control" id="recAffiliation" name="recAffiliation">
                        </div>
                      </div>
                      <button type="submit" name="recLetterTh" class="btn btn-primary">Request Letter</button>
                    </form>
                  </div>
                  <!-- END CARD BODY -->
                </div>
                <!-- END COLLAPSABLE CONTENT -->
              </div>


              <!-- END CARD -->
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
