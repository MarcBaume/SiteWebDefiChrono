 <?php 
 $today = date("Y-m-d H:i:s"); 
date_default_timezone_set('Europe/Paris');
// --- La setlocale() fonctionnne pour strftime mais pas pour DateTime->format()
setlocale(LC_TIME, 'fr_FR.utf8','fra');// OK
 session_start(); 




 
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
  
$filenameCSV = "Export".$NOM_COURSE. $ANNEE_COURSE.".csv";
if (file_exists($filenameCSV)) 
{
	unlink($filenameCSV);
}

 
  // On se connecte à MySQL
	include("../../MysqlConnect.php");
	mysqli_select_db($con ,'dxvv_jurachrono' );
	
     $sql = 'SELECT * FROM inscription WHERE course=\''.$NOM_COURSE. $ANNEE_COURSE .'\'ORDER BY nom ASC';
	
	 $result = mysqli_query($con,$sql);
	 $HeaderCol = 0;
	  $new_csv = fopen($filenameCSV, 'w');
	  if ($result && mysqli_num_rows($result) > 0) 
	  {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) 
		{
			 
			$LineHeader = "";
			 foreach($row as $key => $value)
			{
				if ($HeaderCol == 0)
				{
					$LineHeader = $LineHeader. $key.";";
					
				}
			}
			if ($HeaderCol == 0)
			{
				fwrite($new_csv, $LineHeader . "\n" );
		
				$HeaderCol = 1;
			}
			fputcsv($new_csv, $row, ';');
		}
		 
	  }
      
  fclose($new_csv);	
  $uploads_dir = '/uploads';
  
  header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 

$filename = "Export".$_GET['NameFile'].".csv";

header("Content-disposition: attachment; filename=\"" . $filename. "\""); 
readfile($filenameCSV); 


     // force download  
   // header("Content-Type: application/force-download");
   // header("Content-Type: application/octet-stream");
   // header("Content-Type: application/download");

    // disposition / encoding on response body
 //   header("Content-Disposition: attachment;filename=Export".$NOM_COURSE. $ANNEE_COURSE.".csv");
 //   header("Content-Transfer-Encoding: binary");
	

	//	 readfile($filename);

  
	?>
	 
	 