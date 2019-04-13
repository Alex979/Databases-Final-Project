<?php


  session_start();
  include('connect.php');
  $uname = $_SESSION['username'];
  //echo $uname;
  
  $completeForm = true;

//   if (empty($_POST["sUID"])) {
//                 $uidErr  = " *Required Field"; //name field was empty so change the error message
//                 $completeForm = false;
//   } else {
//                 if(!preg_match("/^[0-9 ]*$/",$_POST["sUID"])){
//                         $uidErr = " *Invalid Entry"; //name field was entered but not valid so change error message
//                         $completeForm = false;
//                 }
//    }
  
  
  if($completeForm == true){
 		 $recFName = $_POST["recFName"];
  	$recLName = $_POST["recLName"];
 		 $recEmail = $_POST["recEmail"];
 		 $recTitle = $_POST["recTitle"];
 		 $recAffiliation = $_POST["recAffiliation"];
 		 $recLetter = $_POST["recLetter"];
		 $uid = $_POST["sUID"];
                 $complete = true;
                $query = "INSERT INTO rec_letters(uid,rec_fname,rec_lname,rec_email,rec_title,rec_affiliation,reccomendation, complete) VALUES ('$uid','$recFName', '$recLName','$recEmail','$recTitle','$recAffiliation', '$recLetter', 1)";
                $ret = mysqli_query($conn, $query);
                if($ret){
                //echo "New record created successfully <br/>";
                } else {
                echo "Error: " .$query . "<br/>" . mysqli_error($conn);
                }

                $successMessage = " *Your Information was processed";
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
        
        <!-- End of Topbar -->

        
        
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Enter Letters of Recomendation</h1>
          </div>

          <!-- Content Column -->
          <div class="container-fluid">

            <!-- Content Row -->
            <div class="row">
              <!-- Basic Card Example -->
              <div class="card shadow mb-4 w-100 p-3">
                <div class="card-header py-3">
                  <h4 class="m-0 font-weight-bold text-primary">Recomendation Form</h4><!-- <span class="text-success"><?php echo  $successMessage;?></span> -->
                </div>
                <div class="card-body">
                  <!-- BEGIN FORM-->
                  <form method="post" action="enterRecomendations.php">
                    <!-- CONTACT -->
                    <h6 class="m-0 font-weight-bold text-primary">Student Information</h6>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="inputFName">First Name</label><span class="text-danger"><?php echo  $fNameErr;?></span>
                        <input type="text" class="form-control" id="inputFName" name="sFName" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputLName">Last Name</label><span class="text-danger"><?php echo  $lNameErr;?></span>
                        <input type="text" class="form-control" id="inputLName" name="sLName" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputLName">Student UID</label><span class="text-danger">
                        <input type="text" class="form-control" id="inputLName" name="sUID" required>
                      </div>
                    </div>

                    <h6 class="m-0 font-weight-bold text-primary">Recomender Information</h6>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="recFName">First Name</label><span class="text-danger"><?php echo  $recFNameErr;?></span>
                        <input type="text" class="form-control" id="recFName" name="recFName" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="recLName1">Last Name</label><span class="text-danger"><?php echo  $recLNameErr;?></span>
                        <input type="text" class="form-control" id="recLName" name="recLName" required>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="recEmail">Email</label><span class="text-danger"><?php echo  $recEmailErr;?></span>
                        <input type="text" class="form-control" id="recEmail" name="recEmail" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="recTitle">Title</label><span class="text-danger"><?php echo  $recTitleErr;?></span>
                        <input type="text" class="form-control" id="recTitle" name="recTitle" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="recAffiliation">Affiliation</label><span class="text-danger"><?php echo  $recAffErr;?></span>
                        <input type="text" class="form-control" id="recAffiliation" name="recAffiliation" required>
                      </div>
                    </div>

                    <!-- RECOMENDATION-->
                    <h6 class="m-0 font-weight-bold text-primary">Please Enter your Recomendation Below</h6><span class="text-danger"><?php echo  $recLetterErr;?></span>
                    <div class="form-group">
                      <textarea class="form-control" id="recLetter" name="recLetter" rows="6" maxlength="500"></textarea>
                    </div>
		    <h6>Click Here to Submit</h6>
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
