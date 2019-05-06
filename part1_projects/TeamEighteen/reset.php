<?php
$command = 'mysql'
        . ' --host="127.0.0.1"'
        . ' --user="Team_Name"'
        . ' --password="p@ssW0RD"'
        . ' --database="Team_Name"'
        . ' --execute="SOURCE '
;
chdir('/home/ead/sp19DBp2-Team_Name/public_html/Team_Name');
$output1 = shell_exec($command . 'schema.sql"');
header('Location: ../FlatEarthSociety/public_html/dashboard.php'); 
?>
