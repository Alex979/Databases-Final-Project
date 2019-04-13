<?php

        $to = 'arjunvijay@gwu.edu';
        $subject = 'Website Followup';
        $name = $_POST["name"];
        $from = $_POST["email"];
        $msg = $_POST["message"];
        $msg = wordwrap($msg, 70, "\r\n");
        $headers = 'From:' $from . "\r\n" .
    'Reply-To:' $from . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
        
        $ret = mail($to, $subject, $msg, $headers);
        echo $ret;
        if($ret){
                header('https://arjun-vijay.github.io./');exit;
        }
        
?>
