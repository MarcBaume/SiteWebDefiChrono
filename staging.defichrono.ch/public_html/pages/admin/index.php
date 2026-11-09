
<?php
	include("Header.php"); 
?>
</br>
<?php	
	include("../HeaderIndex.php"); 
?>
	<div id="corps">
		<div id="index">

<?php 
if (!isset($_SESSION["user"]["Login"]))
{
	exit echo "Aucun membres connectées"
}?>
	<h3>
	<?php
	if ($_SESSION['Niveau'] == 2 || $_SESSION['Niveau'] ==0)
	{
		echo 'Course de '. $_SESSION['Login'];
		header('Location: IndexMembresAdmin.php'); 
	}
	else if ($_SESSION['Niveau'] > 3)
	{
		echo 'Administrateur du site';
		header('Location: IndexMembresAdmin.php'); 
	}
	else
		{
			echo "page en construction";
		}
?>
