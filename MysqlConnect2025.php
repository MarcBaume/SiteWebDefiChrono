<?php
// Inclure un fichier de configuration
require_once 'config.php'; 
  // On se connecte à MySQL
  // 1. Connexion (à faire une seule fois au début)
try {
  $host    =HOSTNAME_DB;
$db      = NAME_DB;
$user    = USER_DB;
$pass    = PASSWORD_DB;
$charset = 'utf8';

// Le DSN (Data Source Name) utilise des guillemets doubles
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    $pdo = new PDO($dsn , $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

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