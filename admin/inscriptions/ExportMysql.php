 <?php 
if ( strlen($_POST['DateCourse'])>0)
{
$DateCourse =  $_POST['DateCourse'];
$Date =  date_parse($_POST['DateCourse']);
$ANNEE_COURSE = $Date['year']; 
$Month = $Date['month']; 
$Day = $Date['day']; 

//$ANNEE_COURSE = $_POST['annee_course'];
$NOM_COURSE = $_POST["NomCourse"];
$Nbr_etape =  $_POST["NbrEtape"] ;

}
else if  ( strlen($_GET['DateCourse'])>0)
{
$DateCourse =  $_GET['DateCourse'];
$Date =  date_parse($_GET['DateCourse']);
$ANNEE_COURSE = $Date['year']; 
$Month = $Date['month']; 
$Day = $Date['day']; 

//$ANNEE_COURSE = $_GET['annee_course'];
$NOM_COURSE = $_GET["NomCourse"];
$Nbr_etape =  $_GET["NbrEtape"] ;

}
 
$filename = "Export".$NOM_COURSE. $ANNEE_COURSE.".csv";
if (file_exists($filename)) 
{
	unlink($filename);
}
  // On se connecte à MySQL
	include("../../MysqlConnect.php");

	mysqli_select_db($con ,'dxvv_jurachrono' );
	if ($_POST['parcours']==("")){
     	$sql = 'SELECT * FROM inscription WHERE course=\''.$NOM_COURSE. $ANNEE_COURSE .'\'ORDER BY nom ASC';
	}
	else{
	 	$sql = 'SELECT * FROM inscription  WHERE course=\''.$NOM_COURSE. $ANNEE_COURSE. '\'AND NomDepart = \''.$_POST["parcours"]. '\'ORDER BY nom ASC';
	 }
	 
	$result = mysqli_query($con,$sql);
	$HeaderCol = 0;
	header('Content-Type: text/csv; charset=windows-1252');
	header("Content-disposition: attachment;filename=\"" . "Export".$NOM_COURSE. $ANNEE_COURSE.".csv". "\""); 
	// Source - https://stackoverflow.com/a/24545434
// Posted by ecnepsnai, modified by community. See post 'Timeline' for change history
// Retrieved 2025-12-25, License - CC BY-SA 4.0

	$new_csv = fopen('php://output', 'w');
	if ($result && mysqli_num_rows($result) > 0) 
	{
		$header = 0;
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) 
		{ 
			$line = "";
			$ligne_ansi = "";
			
			// En tête des colonnes
			if ($header == 0)
			{
				$header = 1;
				foreach($row as $key => $value)
				{
					$line = $line. $key.";29";				
				}
				$lineAnsi = iconv("UTF-8", "Windows-1252", $line);
				fwrite($new_csv, $lineAnsi."\n");
			}
			else
			{
				// Valeurs des colonnes
				foreach($row as $current => $value)
				{
					$line = $line. $value.";";				
				}
				$lineAnsi = iconv("UTF-8", "Windows-1252", $line);
				fwrite($new_csv, $lineAnsi."\n");
			}
		}
	}

  	fclose($new_csv);	
  	//$uploads_dir = '/uploads';
	//readfile($filename); 


     // force download  
   // header("Content-Type: application/force-download");
   // header("Content-Type: application/octet-stream");
   // header("Content-Type: application/download");

    // disposition / encoding on response body
 //   header("Content-Disposition: attachment;filename=Export".$NOM_COURSE. $ANNEE_COURSE.".csv");
 //   header("Content-Transfer-Encoding: binary");
	

	//	 readfile($filename);

  
	?>
	 
	 