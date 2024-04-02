
<?php 

	$pathFile = '../courses/JuraDéfi2021/info/FileDetection/';
	if ($_POST['Discipline'] == 'Roller')
	{
		$pathFile = $pathFile .'arrivee_copy_Etape1';
	}
	else if ($_POST['Discipline'] == 'Course')
	{
		$pathFile = $pathFile .'arrivee_copy_Etape2';
	}
	else if ($_POST['Discipline'] == 'VéloDeRoute')
	{
		$pathFile = $pathFile .'arrivee_copy_Etape3';
	}
	else if ($_POST['Discipline'] == 'VTT')
	{
		$pathFile = $pathFile .'arrivee_copy_Etape4';
	}

	if (strlen($_POST['Chrono']) > 0 ) 
	{
		// 1 : on ouvre le fichier
		//$monfichier = fopen($pathFile, 'w+');
		$ligne = '1;'.$_POST['IDEquipe'].';'.'2021-06-30;'. $_POST['Chrono'].';'. $_POST['NomEquipe'].';'."\n";
		// 2 : ajout de la ligne du fichier
		$ligne1 =  file_put_contents($pathFile, $ligne,FILE_APPEND);
		// Modification status sur la base de donnée 
		// On se connecte à MySQL
		$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
		if (!$con)
			{
			die('Could not connect: ' . mysql_error());
			}
			else
			{
				mysqli_select_db($con ,'dxvv_jurachrono' );


				// Modification status
				$sql = 'UPDATE TempsJuraDefi2021 SET Status = \'Validé\'  WHERE ID=\''.$_POST["ID"].'\''; 
				if (!mysqli_query($con,$sql))
				{
					echo "Error update : validagtion Nom" . mysql_error();
				} 
				// Modification chrono
				$sql = 'UPDATE TempsJuraDefi2021 SET Chrono = \''.$_POST["Chrono"].'\'  WHERE ID=\''.$_POST["ID"].'\''; 
				if (!mysqli_query($con,$sql))
				{
					echo "Error update : validagtion Nom" . mysql_error();
				} 
				// Modification Discipline
				$sql = 'UPDATE TempsJuraDefi2021 SET Discipline = \''.$_POST['Discipline'].'\'  WHERE ID=\''.$_POST["ID"].'\''; 
				if (!mysqli_query($con,$sql))
				{
					echo "Error update : validagtion discipline" . mysql_error();
				} 
				header('Location: ResultatJuraDefi2021.php');
		}
	}
 
?>


