<?php
	session_start();
        $email =$_SESSION['recEmail'];
        $uname = $_SESSION['username'];

        $update = "SELECT * FROM applicant WHERE uname='$uname'";
        $result = mysqli_query($conn,$update);
        $row=mysqli_fetch_assoc($result);
        $fName = row['fname'];
        $lName = row['lname'];
        
        
        $subject = 'Letter of Recomendation';
        // $msgA = 'Hello, '.$fName.' '.$lName;
        // $msgB = '   Please go to: https://bit.ly/2K26ajj to enter your recomendation. Use UID:';
        // $msgC = 

        $msg = 'Hello, '.$fName.' '.$lName.'   Please go to: https://bit.ly/2K26ajj to enter your recomendation. Use UID:'.$_SESSION['uid'];
        
        $msg = wordwrap($msg, 70);
        $ret = mail($email, $subject, $msg);
        echo $ret;
        if($ret){
                header('location:userDashboard.php');exit;
        }
        echo "something";
        if($ret){
                echo 'okay';
        }
 





?>
