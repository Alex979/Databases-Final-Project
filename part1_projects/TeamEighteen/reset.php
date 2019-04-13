<?php
$command = 'mysql'
        . ' --host="localhost"'
        . ' --user="TeamEighteen"'
        . ' --password="DatabasePassword1!"'
        . ' --database="TeamEighteen"'
        . ' --execute="SOURCE '
;
$output1 = shell_exec($command . 'reset.sql"');
echo 'Reset!'; 
header('Location:login.html'); 
?>
