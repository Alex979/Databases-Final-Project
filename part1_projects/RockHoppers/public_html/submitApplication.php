<?php 

session_start();
include('connect.php');
$uid = $_SESSION['uid'];
$personalComplete =  $academicComplete = $recComplete = $transcriptComplete = "";
$submitApplication = false;
//Use Query to obtain personalComplete
              $query = "select * from applicant where uid='$uid'";
              $result = mysqli_query($conn,$query);
              if (mysqli_num_rows($result) > 0){
                      while($row = mysqli_fetch_assoc($result)){
                      $personalComplete = $row['complete'];
			
                      }
              }   
//Use Query to obtain academicComplete
              $query = "select * from application_info where uid='$uid'";
              $result = mysqli_query($conn,$query);
              if (mysqli_num_rows($result) > 0){
                      while($row = mysqli_fetch_assoc($result)){
                      $academicComplete = $row['complete'];
                      }
              }

//Use Query to obtain academicComplete
              $query = "select * from rec_letters where uid='$uid'";
              $result = mysqli_query($conn,$query);
              if (mysqli_num_rows($result) > 0){
                      while($row = mysqli_fetch_assoc($result)){
                      $recComplete = $row['complete'];
                      }
              }

//Use Query to obtain academicComplete
              $query = "select * from transcript where uid='$uid'";
              $result = mysqli_query($conn,$query);
              if (mysqli_num_rows($result) > 0){
                      while($row = mysqli_fetch_assoc($result)){
                      $transcriptComplete = $row['submitted'];
                      }
              }




   if(($personalComplete == 1) && ($academicComplete == 1) && ($recComplete == 1) && ($transcriptComplete == 1)){
		$submitApplication = true;
		$date = date("Y-m-d");
		$update = "UPDATE application_status SET ready_for_evaluation='yes', admission_status='complete', date_completed='$date' WHERE uid='$uid'";
        $result = mysqli_query($conn,$update);
   }

   if($submitApplication){
   		header('location:userDashboard.php?status=success');exit;
   }else{
   	 	header('location:userDashboard.php?status=failed');exit;
   }

 ?>























