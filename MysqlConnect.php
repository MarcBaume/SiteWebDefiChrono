<?php
// Inclure un fichier de configuration
require_once 'config.php'; 

  // On se connecte à MySQL
$con = mysqli_connect(HOSTNAME_DB, USER_DB, PASSWORD_DB);
if (!$con)
{
     die('Could not connect: ' . mysql_error());
	 print(-3);
}
else
{
  mysqli_select_db($con ,NAME_DB );
}
?>