<?php

	session_start();
	include('connect.php');
	$fid = $_SESSION["uid"];
	$uid = $_POST["uid"];
	$admitted = $_POST["admitCategory"];
	$deficiencies = $_POST["deficiency"];
	$reason = $_POST["reason"];
	$comments = $_POST["comments"];
	$recAdvisor = $_POST["advisor"];
	$ranking = 0;
	if($admitted == 'Reject')
	{
		$ranking = 0;
	}
	else if($admitted == 'badmit')
	{
		$ranking = 1;
	}
	else if($admitted == 'admit')
	{
		$ranking = 2;
	}
	else if($admitted == 'admitwaid')
	{
		$ranking = 3;
	}

	//:w
	//in_array("faculty", $_SESSION["role"])


	$query = "INSERT INTO faculty_evaluation VALUES ('$uid','$fid', '$comments', '$ranking', '$recAdvisor', '$reason')";
	$result = mysqli_query($conn,$query);

	$query2 = "SELECT * FROM application_status where uid = '$uid'";
	$result2 = mysqli_query($conn,$query2);
	$row = mysqli_fetch_assoc($result2);
	$numEvaluations=$row["num_evaluations"];
	$numEvaluations++;

	$query3="UPDATE application_status SET num_evaluations = '$numEvaluations' where uid = '$uid'";
	$result3 = mysqli_query($conn,$query3);

	$query4 = "SELECT * FROM faculty_evaluation where uid = '$uid'";
	$result4 = mysqli_query($conn,$query4);
	$sum = 0;
	$count = 0;
	if(mysqli_num_rows($result4) >= 0){
        while($row4 = mysqli_fetch_assoc($result4)){
        	$sum = $sum + $row4["ranking"];
        	$count++;
        }
    }
    $avg = $sum/$count;
    $query5 = "UPDATE application_status SET avg_rank = '$avg' where uid = '$uid'";
    $result5 = mysqli_query($conn,$query5);
    if($_POST["processLetter"]=='yes')
    {
    
    	$rating = $_POST["letterRating"];
    	$generic = $_POST["generic"];
    	$credible = $_POST["credible"];

    	$query6 = "UPDATE rec_letters SET rating='$rating', generic = '$generic', credible = '$credible', complete = '1' where uid = '$uid'";
    	$result6 = mysqli_query($conn,$query6);
    }
    
    header('location:applicant_display.php?status=success');
?>
