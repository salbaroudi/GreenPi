<?php
#In the event sess_end.php was not called.
$status = session_status();
if($status == PHP_SESSION_ACTIVE){
    echo "Old session detected";
    session_destroy();
}

session_start();

#we need the credential info for mySQL database. This is stored in a folder
#in the ~home folder. I rely on apache2 directory restrictions for security.

$path = "./creds/mysql.txt";

#A very painful error: There are hidden newlines at the end of every line
#The mysqli_connect() function rejects the credentials. When you print
#the session variable, it appears correct in console.

$fh = fopen($path,'r');
while ($line = fgets($fh)) {
  $result=explode("::",$line);
  $_SESSION[$result[0]] = rtrim($result[1],"\n"); #Never forget this.
}

?>
