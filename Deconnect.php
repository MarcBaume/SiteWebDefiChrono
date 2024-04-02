<?
	$url = "index.php";
	$_SESSION['Login'] = "";
	session_start();
session_destroy();
session_commit();
	header("Location: ".$url);


?>
  