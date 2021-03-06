<?php 
session_start();

include('connect.php');


$_SESSION['signedin']='false';
$fieldError=0;

$fnameErr=$lnameErr=$unameErr=$emailErr=$pwordErr=$pword2Err=$signupErr="";


function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }


if(isset($_GET['fail']) && !empty($_GET['fail'])){

  if($_GET['fail']=='uname'){
    $signupErr="User name already exists";
  }else if($_GET['fail']=='email'){
    $signupErr="Email already in use";
  }


}
if(isset($_POST['signup'])){

      if (empty($_POST["firstname"])) {
        $fnameErr = "First name is required";
        $fieldError=1;
      }  else {
        $fname = test_input($_POST["firstname"]);
      }

      if (empty($_POST["username"])) {
        $unameErr = "Username is required";
        $fieldError=1;
      }  else {
        $uname = test_input($_POST["username"]);
      }
  
      if (empty($_POST["lastname"])) {
        $lnameErr = "Last name is required";
        $fieldError=1;
      }  else {
        $lname = test_input($_POST["lastname"]);
      }

      if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $fieldError=1;
      }  else {
        $email = test_input($_POST["email"]);
      }

      if (empty($_POST["password"])) {
        $pwordErr = "Password is required";
        $fieldError=1;
      } else {
        $pword = test_input($_POST["password"]);
      }

      if (empty($_POST["password2"])) {
        $pword2Err = "Password verification is required";
        $fieldError=1;
      }  else {
        $pword2 = test_input($_POST["password2"]);
      }
      
      //inserting
      //INSERT INTO applicant (ssn,uname,fname,lname,address,email,phone) VALUES ("0123","bob","rob","robertson","somewherestreet","email","phone");

      //INSERT INTO user VALUES("jake","pword","applicant");


      if($fieldError==0){
        //begin checking to see if user is in database
        $query = "select uname, email from applicant";
        $result = mysqli_query($conn,$query);
        if (mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_assoc($result)){
            
            if($row['uname'] == $_POST["username"]){//user already exists
              header('location:signup.php?fail=uname');exit;
            }
            if($row['email'] == $_POST["email"]){//user already exists
              header('location:signup.php?fail=email');exit;
            }
          }
        }
        //if we get here, the user has entered everything
        //correctly and doesn't exist in the system

        $query = "INSERT INTO applicant (uname,fname,lname,email) VALUES ('$uname','$fname','$lname','$email')";
        $result = mysqli_query($conn,$query);

        $query = "INSERT INTO user (uname,pword,role) VALUES ('$uname','$pword','applicant')";
        $result = mysqli_query($conn,$query);



        // $query = "INSERT INTO user VALUES ('$uname',\"$fname\",'$lname','$pword')";
        // $result = mysqli_query($conn,$query);
        $_SESSION['signedin']="true";
        $_SESSION['username']=$uname;
        
        
        header('location:signup.php?status=success');exit;


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

  <title>SB Admin 2 - Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row justify-content-center">
          <div class="col-lg-5 d-none"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                <span class="error"> <?php echo $signupErr;?></span><br><br><br>
              </div>
              
              <form class="user" method ="post"  action="signup.php">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="exampleFirstName" name="firstname" placeholder="First Name">
                    <span class="error"> <?php echo $fnameErr;?></span><br>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="exampleLastName" name="lastname" placeholder="Last Name">
                    <span class="error"> <?php echo $lnameErr;?></span><br>
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" placeholder="Email Address">
                  <span class="error"> <?php echo $emailErr;?></span><br>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="userame" name="username" placeholder="Username">
                  <span class="error"> <?php echo $unameErr;?></span><br>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password">
                    <span class="error"> <?php echo $pwordErr;?></span><br>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" name="password2" placeholder="Repeat Password">
                    <span class="error"> <?php echo $pword2Err;?></span><br>
                  </div>
                </div>
                <input class="btn btn-primary btn-user btn-block" type="submit" value="Sign Up" name="signup" />
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="login.html">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
