<div id="menu_vertical">
<li>

   </li>
   <script type="text/javascript">

function checkForm(f) {
	f.submit();
	
}
</script>
<?php
 
if ( strlen($_POST['date_course'])>0)
{
$DateCourse =  $_POST['date_course'];
$Date =  date_parse($_POST['date_course']);
$ANNEE_COURSE = $Date['year']; 
$Month = $Date['month']; 
$Day = $Date['day']; 

//$ANNEE_COURSE = $_POST['annee_course'];
$NOM_COURSE = $_POST["nom_course"];
$Nbr_etape =  $_POST["Nbretape"] ;

}
else if  ( strlen($_GET['date_course'])>0)
{
$DateCourse =  $_GET['date_course'];
$Date =  date_parse($_GET['date_course']);
$ANNEE_COURSE = $Date['year']; 
$Month = $Date['month']; 
$Day = $Date['day']; 

//$ANNEE_COURSE = $_GET['annee_course'];
$NOM_COURSE = $_GET["nom_course"];
$Nbr_etape =  $_GET["Nbretape"] ;

}

if (strlen($ANNEE_COURSE ) > 0 )
{

/*************************** CONNECTION AVEC LA BASE DE DONNEES ***********************************/
$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  else
  {
	  
	  mysqli_select_db($con ,'dxvv_jurachrono' );
// ***************************************** AFFICHAGE BASE de Donnée ***************************************
	  // Create table de donnée du nom de parcours
//	mysqli_select_db($con,$row['Database']);
	$sql = 'SELECT * FROM Course  WHERE Nom_course=\''.$_GET["nom_course"].'\'AND Date=\''.$DateCourse.'\'' ; 
	$result = mysqli_query($con,$sql);
	
		 if ($result && mysqli_num_rows($result) > 0) {
		// output data of each row
		while($val1 = mysqli_fetch_assoc($result)) {
		
		$Site = $val1['Site'];

 $val = $val1;
		}
		}
		}
		}
?>
<li>
   <a href="login.php">Accueil</a>
   </li>
     <li>
   <a href="nouvel_course_step1.php">Créer une course</a>
   </li>
        <li>
   <a href="Liste_Course.php">Liste des Course</a>
   </li>
</div>