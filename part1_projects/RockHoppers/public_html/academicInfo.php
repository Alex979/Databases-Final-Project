<?php
  session_start();
  $uname = $_SESSION['username'];
  $uid = $_SESSION['uid'];
  include('connect.php');
  //Define Error Messages
  $degNameErr = $admitSemErr = $admitYearErr = $bachTitleErr = "";
  $bachGradErr = $bachUniErr = $bachGPAErr = "";
  $mastTitleErr = $mastGradErr = $mastUniErr = $mastGPAErr = $bachErr = "";
  $greTotErr = $greVerbErr = $greQuantErr = $toeffelErr = "";
  $interestErr = $priorWorkErr = $majorErr = $transMethodErr = $transUploadErr = "";
  $successMessage = "";
  $completeForm = true;
  
  if(empty($_POST["major"])) {
    $majorErr = " *Required Field"; //name field was empty so change the error message
    $completeForm = false;
  } else {
    if(!preg_match("/^[a-zA-Z& ]*$/",$_POST["major"])){
      $majorErr = " *Invalid Entry"; //name field was entered but not valid so change error message
      $completeForm = false;
    }
  }

  //check the degree name requirements
  if (empty($_POST["degName"])) {
    $degNameErr = " *Required Field"; //name field was empty so change the error message
    $completeForm = false;
  } else {
    if(!preg_match("/^[a-zA-Z ]*$/",$_POST["degName"])){
      $degnameErr = " *Invalid Entry"; //name field was entered but not valid so change error message
      $completeForm = false;
    }
  }
  //check the Admit semster requirements
  if (empty($_POST["admitSemester"])) {
    $admitSemErr = " *Required Field"; //name field was empty so change the error message
    $completeForm = false;
  } else {
    if(!preg_match("/^[a-zA-Z ]*$/",$_POST["admitSemester"])){
      $admitSemErr = " *Invalid Entry"; //name field was entered but not valid so change error message
      $completeForm = false;
    }
  }
  //check the Admit year requirements
  if (empty($_POST["admitYear"])) {
    $admitYearErr = " *Required Field"; //name field was empty so change the error message
    $completeForm = false;
  } else {
    if(!preg_match("/^[0-9 ]*$/",$_POST["admitYear"])){
      $admitYearErr = " *Invalid Entry"; //name field was entered but not valid so change error message
      $completeForm = false;
    }
  }
  //check the Bachelors Degree Title requirements
  if (empty($_POST["bachTitle"])) {
    $bachTitleErr  = " *Required Field"; //name field was empty so change the error message
    $completeForm = false;
  } else {
    if(!preg_match("/^[a-zA-Z ]*$/",$_POST["bachTitle"])){
      $bachTitleErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
      $completeForm = false;
    }
  }
  //check the Bachelors Degree Year requirements
  if (empty($_POST["bachGrad"])) {
    $bachGradErr  = " *Required Field"; //name field was empty so change the error message
    $completeForm = false;
  } else {
    if(!preg_match("/^[0-9 ]*$/",$_POST["bachGrad"])){
      $bachGradErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
      $completeForm = false;
    }
  }
  //check the Bachelors Degree University Name requirements
  if (empty($_POST["bachUni"])) {
    $bachUniErr  = " *Required Field"; //name field was empty so change the error message
    $completeForm = false;
  } else {
    if(!preg_match("/^[a-zA-Z ]*$/",$_POST["bachUni"])){
      $bachUniErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
      $completeForm = false;
    }
  }
  //check the Bachlores Degree GPA requirements
  if (empty($_POST["bachGPA"])) {
    $bachGPAErr  = " *Required Field"; //name field was empty so change the error message
    $completeForm = false;
  } else {
    if(!preg_match("/^[0-9. ]*$/",$_POST["bachGPA"])){
      $bachGPAErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
      $completeForm = false;
    }
  }
  //check the Masters Degree Title requirements
  if (empty($_POST["mastTitle"])) {
    //$mastTitleErr  = " *Enter NA if not applicable"; //name field was empty so change the error message
    //$completeForm = false;
  } else {
    if(!preg_match("/^[a-zA-Z ]*$/",$_POST["mastTitle"])){
      $mastTitleErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
      $completeForm = false;
    }
  }
  //check the Masters Degree Year requirements
  if (empty($_POST["mastGrad"])) {
    //$mastGradErr  = " *Enter NA if not applicable"; //name field was empty so change the error message
    //$completeForm = false;
  } else {
    if(!preg_match("/^[a-zA-Z0-9 ]*$/",$_POST["mastGrad"])){
      $mastGradErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
      $completeForm = false;
    }
  }
  //check the Masters Degree University name requirements
  if (empty($_POST["mastUni"])) {
    //$mastUniErr  = " *Enter NA if not applicable"; //name field was empty so change the error message
    //$completeForm = false;
  } else {
    if(!preg_match("/^[a-zA-Z ]*$/",$_POST["mastUni"])){
      $mastUniErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
      $completeForm = false;
    }
  }
  //check the Masters Degree University GPA requirements
  if (empty($_POST["mastGPA"])) {
    //$mastGPAErr  = " *Enter NA if not applicable"; //name field was empty so change the error message
    //$completeForm = false;
  } else {
    if(!preg_match("/^[0-9. ]*$/",$_POST["mastGPA"])){
      $mastGPAErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
      $completeForm = false;
    }
  }
  //IF APPLICANT IS PhD they must enter values else make them neter NA
  if($_POST["degName"] == 'PhD') {
    //check the GRE Total requirements
    if (empty($_POST["greTot"])) {
      $greTotErr  = " *Required Field for PhD Applicants"; //name field was empty so change the error message
      $completeForm = false;
    } else {
      if(!preg_match("/^[0-9 ]*$/",$_POST["greTot"])){
        $greTotErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
        $completeForm = false;
      }
    }
    //check the GRE Verbal requirements
    if (empty($_POST["greVerb"])) {
      $greVerbErr  = " *Required Field for PhD Applicants"; //name field was empty so change the error message
      $completeForm = false;
    } else {
      if(!preg_match("/^[0-9 ]*$/",$_POST["greVerb"])){
        $greVerbErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
        $completeForm = false;
      }
    }
    //check the GRE Quant requirements
    if (empty($_POST["greQuant"])) {
      $greQuantErr  = " *Required Field for PhD Applicants"; //name field was empty so change the error message
      $completeForm = false;
    } else {
      if(!preg_match("/^[0-9 ]*$/",$_POST["greQuant"])){
        $greQuantErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
        $completeForm = false;
      }
    }
  } else {
    //check the GRE Total requirements
    if (empty($_POST["greTot"])) {
  //    $greTotErr  = " *Enter NA if not applicable"; //name field was empty so change the error message
  //    $completeForm = false;
    } else {
      if(!preg_match("/^[0-9 ]*$/",$_POST["greTot"])){
        $greTotErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
        $completeForm = false;
      }
    }
    //check the GRE Verbal requirements
    if (empty($_POST["greVerb"])) {
      //$greVerbErr  = " *Enter NA if not applicable"; //name field was empty so change the error message
      //$completeForm = false;
    } else {
      if(!preg_match("/^[0-9 ]*$/",$_POST["greVerb"])){
        //$greVerbErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
        //$completeForm = false;
      }
    }
    //check the GRE Quantitative requirements
    if (empty($_POST["greQuant"])) {
      //$greQuantErr  = " *Enter NA if not applicable"; //name field was empty so change the error message
      //$completeForm = false;
    } else {
      if(!preg_match("/^[0-9 ]*$/",$_POST["greQuant"])){
        //$greQuantErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
        //$completeForm = false;
      }
    }
  }
  //check the GRE Biology requirements
  if (empty($_POST["greBio"])) {
    //$greBioErr  = " *Enter NA"; //name field was empty so change the error message
    //$completeForm = false;
  } else {
    if(!preg_match("/^[0-9 ]*$/",$_POST["greBio"])){
      $greBioErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
      $completeForm = false;
    }
  }
  //check the GRE Chemistry requirements
  if (empty($_POST["greChem"])) {
   // $greChemErr  = " *Enter NA"; //name field was empty so change the error message
   // $completeForm = false;
  } else {
    if(!preg_match("/^[0-9 ]*$/",$_POST["greChem"])){
      $greChemErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
      $completeForm = false;
    }
  }
  //check the GRE English requirements
  if (empty($_POST["greEng"])) {
    //$greEngErr  = " *Enter NA"; //name field was empty so change the error message
    //$completeForm = false;
  } else {
    if(!preg_match("/^[0-9 ]*$/",$_POST["greEng"])){
      $greEngErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
      $completeForm = false;
    }
  }
  //check the GRE Math requirements
  if (empty($_POST["greMath"])) {
   // $greMathErr  = " *Enter NA"; //name field was empty so change the error message
   // $completeForm = false;
  } else {
    if(!preg_match("/^[0-9 ]*$/",$_POST["greMath"])){
      $greMathErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
      $completeForm = false;
    }
  }
  //check the GRE Physics requirements
  if (empty($_POST["grePhysics"])) {
    //$grePhysicsErr  = " *Enter NA"; //name field was empty so change the error message
    //$completeForm = false;
  } else {
    if(!preg_match("/^[0-9 ]*$/",$_POST["grePhysics"])){
      $grePhysicsErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
      $completeForm = false;
    }
  }
  //Check the GRE Psych Requiremnts
  if (empty($_POST["grePsych"])) {
   // $grePsychErr  = " *Enter NA"; //name field was empty so change the error message
   // $completeForm = false;
  } else {
    if(!preg_match("/^[0-9 ]*$/",$_POST["grePsych"])){
      $grePsychErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
      $completeForm = false;
    }
  }
  //check the toeffel requirements
  if (empty($_POST["toeffel"])) {
    //$toeffelErr  = " *Enter NA if not applicable"; //name field was empty so change the error message
    //$completeForm = false;
  } else {
    if(!preg_match("/^[0-9 ]*$/",$_POST["toeffel"])){
      $toeffelErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
      $completeForm = false;
    }
  }
  //check the toeffel requirements
  if (empty($_POST["toeffelDate"])) {
   // $toeffelDateErr  = " *Enter NA"; //name field was empty so change the error message
   // $completeForm = false;
  } else {
    if(!preg_match("/^[a-zA-Z0-9\/ ]*$/",$_POST["toeffelDate"])){
      $toeffelDateErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
      $completeForm = false;
    }
  }
  //check the Areas of Interest requirements
  if (empty($_POST["interests"])) {
    $interestErr  = " *Required Field"; //name field was empty so change the error message
    $completeForm = false;
  } else {
    if(!preg_match("/^[a-zA-Z ]*$/",$_POST["interests"])){
      $interestErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
      $completeForm = false;
    }
  }
  //check the Prior Work requirements
  if (empty($_POST["priorWork"])) {
    $priorWorkErr  = " *Required Field"; //name field was empty so change the error message
    $completeForm = false;
  } else {
    if(!preg_match("/^[a-zA-Z ]*$/",$_POST["priorWork"])){
      $priorWorkErr  = " *Invalid Entry"; //name field was entered but not valid so change error message
      $completeForm = false;
    }
  }
  
  if($completeForm == true){
    //define variables
		$degName = $_POST["degName"];
		$major = $_POST["major"];
		$admitSemester = $_POST["admitSemester"];
		$admitYear = $_POST["admitYear"];
		$bachTitle = $_POST["bachTitle"];
		$bachGrad = $_POST["bachGrad"];
		$bachUni = $_POST["bachUni"];
		$bachGPA = $_POST["bachGPA"];
	    	$mastTitle = $_POST["mastTitle"];
		$mastGrad = $_POST["mastGrad"];
		$mastUni = $_POST["mastUni"];
		if($_POST["mastGPA"]){
			$mastGPA = $_POST["mastGPA"];
		} else {
			$mastGPA = 0.00;
		}
    		$greTot = $_POST["greTot"];
		$greVerb = $_POST["greVerb"];
		$greQuant = $_POST["greQuant"];
		$greDate = $_POST["gredate"];
		$toeflDate = $_POST["toeffelDate"];
    		$toeffel = $_POST["toeffel"];
    		$interest = $_POST["interest"];
    		$priorWork = $_POST["priorWork"];
		$transcript = "false";
		$complete = 1;
   // 		//Use Query to obtain UID of given Applicant
   //		$query = "select * from applicant where uname='$uname'";
   // 		$result = mysqli_query($conn,$query);
   // 		if (mysqli_num_rows($result) > 0){
   //       		while($row = mysqli_fetch_assoc($result)){
   //         		$uid = $row['uid'];
   //         		echo $uid;
   //	  		}
   // 		}	
    //Perform an insert query to place data into the databse
		$query = "select * from application_info where uid='$uid'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result)>0) { //this means there is already information – We need to update it
			 $query = "UPDATE application_info SET degree_sought='$degName', major='$major', start_year='$admitYear', start_semester='$admitSemester', b_degree='$bachTitle', b_university='$bachUni', b_gpa='$bachGPA', b_date='$bachGrad', m_degree='$mastTitle', m_university='$mastUni', m_gpa='$mastGPA', m_date='$mastGrad', gre_date='$greDate', toeffel_date='$toeffelDate', area_of_interest='$interest', work_experience='$priorWork' WHERE uid='$uid'";
			$ret = mysqli_query($conn, $query);
			$successMessage = " *Your Information was updated";
		} else { //there is no information – Do an insert query 
			$query ="INSERT INTO application_info(uid, degree_sought, major,  start_year, start_semester, b_degree, b_university, b_gpa, b_date, m_degree, m_university, m_gpa, m_date,gre_date,toeffel_date, area_of_interest, work_experience, complete) VALUES ('$uid', '$degName','$major', '$admitYear', '$admitSemester', '$bachTitle', '$bachUni', '$bachGPA', '$bachGrad', '$mastTitle', '$mastUni','$mastGPA', '$mastGrad', '$greDate', '$toeffelDate','$interest', '$priorWork',  1)";
			$ret = mysqli_query($conn, $query);
			$successMessage = " *Your Information was processed";
		}	
	
    		if($ret){
			echo "New record created successfully <br/>";
		} else {
			echo "Error: " .$query . "<br/>" . mysqli_error($conn);
		}

		$greScores = array($_POST["greBio"], $_POST["greChem"], $_POST["greEng"], $_POST["greMath"], $_POST["grePhysics"], $_POST["grePsych"], $_POST["greTot"], $_POST["greVerb"], $_POST["greQuant"], $_POST["toeffel"]);
    		$greSubjects = array("Biology", "Chemistry", "English", "Math", "Physics", "Psychology", "GRE Total", "GRE Verbal", "GRE Quantitative", "Toefl");
		for ($i = 0; $i < 10; $i++){
     			 if($greScores[$i]){
        			$query = "INSERT INTO subject_score(uid, subject, score) VALUES($uid, '$greSubjects[$i]', $greScores[$i])";
        			$ret = mysqli_query($conn, $query);
        			if($ret){
    		    			//echo "Neww record created successfully <br/>";
    				} else {
    		    			echo "Error: " .$query . "<br/>" . mysql_error($conn);
    				}
      			}
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

  <title>Academic Info</title>

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
            <h1 class="h3 mb-0 text-gray-800">Academic Information</h1>
          </div>

          <!-- Content Column -->
          <div class="container-fluid">

            <!-- Content Row -->
            <div class="row">
              <!-- Basic Card Example -->
              <div class="card shadow mb-4 w-100 p-3">
                <div class="card-header py-3">
                  <h4 class="m-0 font-weight-bold text-primary">Academic Information</h4><span class="text-success"><?php echo  $successMessage;?></span>
                </div>
                <div class="card-body">
                  <!-- BEGIN FORM -->
                  <form method="post" action="academicInfo.php">
                    <!-- PROGRAM SOUGHT-->
                    <h6 class="m-0 font-weight-bold text-primary">Program Sought</h6>
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="degName">Degree Name</label><span class="text-danger"><?php echo  $degNameErr;?></span>
                        <select class="form-control" id="degName" name="degName">
                          <option>Masters</option>
                          <option>PhD</option>
                        </select>
                      </div>
		       <div class="form-group col-md-3">
                        <label for="major">Major</label><span class="text-danger"><?php echo  $majorErr;?></span>
                        <select name="major" class="form-control">
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
                      </div>
                      <div class="form-group col-md-3">
                        <label for="admitSemester">Admission Semester</label><span class="text-danger"><?php echo  $admitSemErr;?></span>
                        <select class="form-control" id="admitSemester" name="admitSemester">
                          <option>Fall</option>
                          <option>Spring</option>
                        </select>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="admityear">Admission Year</label><span class="text-danger"><?php echo  $admitYearErr;?></span>
                        <select class="form-control" id="admityear" name="admitYear">
                          <option>2019</option>
                          <option>2020</option>
                        </select>
                      </div>
                    </div>
                    <!-- BACHELORS DEGREE-->
                    <h6 class="m-0 font-weight-bold text-primary">Bachelors Degree</h6>
                    <div class="form-row">
                      <div class="form-group col-md-8">
                        <label for="bachTitle">Degree Title</label><span class="text-danger"><?php echo  $bachTitleErr;?></span>
                        <input type="text" class="form-control" id="bachTitle" name="bachTitle">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="gradYear">Year Graduated</label><span class="text-danger"><?php echo  $bachGradErr;?></span>
                        <input type="text" class="form-control" id="bachGrad" name="bachGrad">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-10">
                        <label for="UniName">University Name</label><span class="text-danger"><?php echo  $bachUniErr;?></span>
                        <input type="text" class="form-control" id="bachUni" name="bachUni">
                      </div>
                      <div class="form-group col-md-2">
                        <label for="gpa">GPA</label><span class="text-danger"><?php echo  $bachGPAErr;?></span>
                        <input type="text" class="form-control" id="bachGPA" name="bachGPA">
                      </div>
                    </div>
                    <!-- MASTERS DEGREE-->
                    <h6 class="m-0 font-weight-bold text-primary">Masters Degree</h6>
                    <div class="form-row">
                      <div class="form-group col-md-8">
                        <label for="degName">Degree Title</label><span class="text-danger"><?php echo  $mastTitleErr;?></span>
                        <input type="text" class="form-control" id="mastTitle" name="mastTitle">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="gradYear">Year Graduated</label><span class="text-danger"><?php echo  $mastGradErr;?></span>
                        <input type="text" class="form-control" id="mastGrad" name="mastGrad">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-8">
                        <label for="GRETot">University Name</label><span class="text-danger"><?php echo  $mastUniErr;?></span>
                        <input type="text" class="form-control" id="mastUni" name="mastUni">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="GRETot">GPA</label><span class="text-danger"><?php echo  $mastGPAErr;?></span>
                        <input type="text" class="form-control" id="mastGPA" name="mastGPA">
                      </div>
                    </div>
                    <!-- TEST SCORES: GENRAL GRE SCORES-->
                    <h6 class="m-0 font-weight-bold text-primary">Test Scores</h6>
                    <div class="form-row">
                      <div class="form-group col-md-2">
                        <label for="GRETot">GRE Total</label><span class="text-danger"><?php echo  $greTotErr;?></span>
                        <input type="text" class="form-control" id="GRETot" name="greTot">
                      </div>
                      <div class="form-group col-md-2">
                        <label for="GREVerb">GRE Verbal</label><span class="text-danger"><?php echo  $greVerbErr;?></span>
                        <input type="text" class="form-control" id="GREVerb" name="greVerb">
                      </div>
                      <div class="form-group col-md-2">
                        <label for="GREQuant">GRE Quantitative</label><span class="text-danger"><?php echo  $greQuantErr;?></span>
                        <input type="text" class="form-control" id="GREQuant" name="greQuant">
                      </div>
                      <div class="form-group col-md-2">
                        <label for="GREQuant">GRE Test Date</label><span class="text-danger"><?php echo  $gredateErr;?></span>
                        <input type="text" class="form-control" id="GREdate" name="gredate">
                      </div>
                      <!-- TEST SCORES: TOFEEL SCORES-->
                      <div class="form-group col-md-2">
                        <label for="GREQuant">TOEFFEL Score</label><span class="text-danger"><?php echo  $toeffelErr;?></span>
                        <input type="text" class="form-control" id="toeffel" name="toeffel">
                      </div>
                      <div class="form-group col-md-2">
                        <label for="GREQuant">TOEFFEL Test Date</label><span class="text-danger"><?php echo  $toeffelDateErr;?></span>
                        <input type="text" class="form-control" id="toeffelDate" name="toeffelDate">
                      </div>
                    </div>
                      <!-- TEST SCORES: GRE SUBJECT SCORES-->
                      <div class="form-row">
                        <div class="form-group col-md-2">
                          <label for="GRETot">GRE Biology</label><span class="text-danger"><?php echo  $greBioErr;?></span>
                          <input type="text" class="form-control" id="greBio" name="greBio">
                        </div>
                        <div class="form-group col-md-2">
                          <label for="GREVerb">GRE Chemistry</label><span class="text-danger"><?php echo  $greChemErr;?></span>
                          <input type="text" class="form-control" id="greChem" name="greChem">
                        </div>
                        <div class="form-group col-md-2">
                          <label for="GREQuant">GRE English</label><span class="text-danger"><?php echo  $greEngErr;?></span>
                          <input type="text" class="form-control" id="greEng" name="greEng">
                        </div>
                        <div class="form-group col-md-2">
                          <label for="GREQuant">GRE Math</label><span class="text-danger"><?php echo  $greMathErr;?></span>
                          <input type="text" class="form-control" id="greMath" name="greMath">
                        </div>
                        <div class="form-group col-md-2">
                          <label for="GREQuant">GRE Physics</label><span class="text-danger"><?php echo  $grePhysicsErr;?></span>
                          <input type="text" class="form-control" id="grePhysics" name="grePhysics">
                        </div>
                        <div class="form-group col-md-2">
                          <label for="GREQuant">GRE Psychology</label><span class="text-danger"><?php echo  $grePsychErr;?></span>
                          <input type="text" class="form-control" id="grePsych" name="grePsych">
                        </div>
                      </div>
                    </div>
                    <!--SUPPLEMENTAL-->
                    <h6 class="m-0 font-weight-bold text-primary">Supplemental</h6>
                    <div class="form-group">
                      <label for="interests">Areas of Interest</label><span class="text-danger"><?php echo  $interestErr;?></span>
                      <textarea class="form-control" id="interests" name="interests" rows="2" maxlength="20"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="priorWork">Prior Work Experience</label><span class="text-danger"><?php echo  $priorWorkErr;?></span>
                      <textarea class="form-control" id="priorWork" name="priorWork" rows="4" maxlength="100"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                  <!-- END FORM -->
                </div>
                <!-- END CARD BODY -->
              </div>
              <!-- END CARD-->
            </div>
            <!-- END ROW -->
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
