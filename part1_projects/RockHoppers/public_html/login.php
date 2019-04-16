<?php 
session_start();

include('connect.php');

if($_SESSION['signedin']!= 'true' && $_SESSION['signedin']!= 'false'){
	$_SESSION['signedin'] = 'false';
	
	//echo 'holla';
}


$unameErr=$pwordErr="";
if(isset($_POST['login'])){ 

	
      if (empty($_POST["username"])) {
        $unameErr = "Username is required";

      } 

      if (empty($_POST["password"])) {
        $pwordErr = "Password is required";

      } 
      
      if($unameErr=="" && $pwordErr==""){
        //begin checking to see if user is in database
        $query = "select uname,pword,role from user";
        $result = mysqli_query($conn,$query);
        if (mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_assoc($result)){
            
            //if(strcasecmp($row['uname'], $_POST["username"])==0 && $row['pword']==$_POST["password"] && strcasecmp($row['role'], $_POST["userRole"])==0){
            if(strcasecmp($row['uname'], $_POST["username"])==0 && $row['pword']==$_POST["password"]){
              $_SESSION['signedin']="true";
              $_SESSION['username']=$row['uname'];//keep track of user
              $uname = $row['uname'];
              $_SESSION['role']=$row['role'];

              $query = "SELECT role FROM user WHERE uname='$uname'";
              $result = mysqli_query($conn,$query);
              $row = mysqli_fetch_assoc($result);
              $role = $row['role'];

              if($row['role']=='applicant'){
                //$uname = $row['uname'];
                $query = "SELECT uid FROM applicant WHERE uname='$uname'";
                $result = mysqli_query($conn,$query);
                $info = mysqli_fetch_assoc($result);
                $uid = $info['uid'];
                $_SESSION['uid']=$uid;
              }else{
                //$uname = $row['uname'];
                $query = "SELECT fid FROM faculty WHERE uname='$uname'";
                $result = mysqli_query($conn,$query);
                $info = mysqli_fetch_assoc($result);
                $fid = $info['fid'];
                $_SESSION['fid']=$fid;
              }


              






              
              header('location:userDashboard.php');exit;
            }
          }
          //if we get here the user doesn't exist in database
          header('location:login.php?status=failed');exit;
        }



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

  <title>APPS User - Login</title>

  <!-- Custom fonts for this template-->
  <link href="apps/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="apps/css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row justify-content-center">
              <div class="col-lg-6 d-none  "></div>
              <div class="col-lg-6 ">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  
                  <form class="user" method ="post"  action="login.php">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="unameinput" name="username" aria-describedby="emailHelp" placeholder="Enter Username...">
                      <span class="error"> <?php echo $unameErr;?></span><br>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="passwordinput" name="password" placeholder="Password">
                      <span class="error"> <?php echo $pwordErr;?></span><br>
                    </div>
                    
                    
                    <input class="btn btn-primary btn-user btn-block" type="submit" value="Log In" name="login" />
                   
                   
                    
                  </form>

                  <hr>
                  
                  <div class="text-center">
                    <a class="small" href="signup.php">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
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

</body>

</html>
