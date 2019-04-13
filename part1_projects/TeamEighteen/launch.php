<?php
$command = 'mysql'
        . ' --host="localhost"'
        . ' --user="TeamEighteen"'
        . ' --password="DatabasePassword1!"'
        . ' --database="TeamEighteen"'
        . ' --execute="SOURCE '
;
$output1 = shell_exec($command . 'ADSschema.sql"');
//echo $command . 'ADSschema.sql"'; 
$output2 = shell_exec($command . 'populateTables.sql"');
 
header('Location:login.html'); 
?>


