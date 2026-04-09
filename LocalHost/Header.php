<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
			<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik">
	
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" href="css/style.css" type="text/css"/>
	<meta http-equiv="cache-control" content="no-cache"> <!-- tells browser not to cache -->
	<meta http-equiv="expires" content="0"> <!-- says that the cache expires 'now' -->
	<meta http-equiv="pragma" content="no-cache"> <!-- says not to use cached stuff, if there is any -->

<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="js/prototype.js" ></script>
	<script src="js/FonctionDefiChrono3.js?v=1"></script>

<?php $today = date("Y-m-d H:i:s"); 
date_default_timezone_set('Europe/Paris');
session_start();
// --- La setlocale() fonctionnne pour strftime mais pas pour DateTime->format()
setlocale(LC_TIME, 'fr_FR.utf8','fra');// OK 
 /*************************** CONNECTION AVEC LA BASE DE DONNEES ***********************************/
include("MysqlConnect.php");
// Si une course est choisie
if (isset($_GET['IdRace']))
{
	$sql = 'SELECT * FROM Course  WHERE ID=\''.$_GET['IdRace'].'\'' ; 
	$result = mysqli_query($con,$sql);
    if ($result && mysqli_num_rows($result) > 0) 
    {
        // output data of each row
        while($course = mysqli_fetch_assoc($result)) 
        {
            $DateCourse =  $course['Date'];
            $Date =  date_parse($course['Date']);
            $ANNEE_COURSE = $Date['year']; 
            $Month = $Date['month']; 
            $Day = $Date['day']; 
            $NOM_COURSE = $course["Nom_Course"];
            $Nbr_etape =  $course["nbr_etape"] ;
			$Site = $course['Site'];
            break;
        }
    }
// Suive de l'événemnt
?>
<form method="get"  id="FormRace" name="FormRace"  >
	<input type="hidden" name="IdRace" id="IdRace"  value= '<?php echo $_GET["IdRace"] ?>' />
</form>
<?php
}
?>