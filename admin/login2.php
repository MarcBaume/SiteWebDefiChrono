<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>liste</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="../style.css" />

	</head>

	<script type="text/javascript">
function isMail(txtMail) {
	var regMail=new RegExp("^[0-9a-z._-]+@{1}[0-9a-z. -]{2,}[.]{1}[a-z]{2,5}$", "i");
	return regMail.test(txtMail);
}
function checkForm(f) {

	if (confirm("Etes-vous sur des informations de votre inscriptions?")) {
	f.submit();
	}
}
</script>
	
  <?php include("../onglets.php"); ?>
<?php include("../menu_vertical.php"); ?>
</br>
<div id="corps">
<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['login']) || empty($_POST['pass'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['login'];
$password=crypt($_POST['pass']);
include("../MysqlConnect.php");
// SQL query to fetch information of registerd users and finds user match.
$sql = 'SELECT * FROM Login where Password='.$password.' AND Login='.$username.'';

$result = mysqli_query($con,$sql);

$result = mysqli_query($con,$sql);
 
 if ($result && mysqli_num_rows($result) > 0) {
$_SESSION['login_user']=$username; // Initializing Session
header("location: profile.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
}
}
?>

     
    </body>
</html>