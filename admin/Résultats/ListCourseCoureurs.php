

<?php

$DateCourse =  $_REQUEST['DateCourse'];
$Date =  date_parse($_REQUEST['DateCourse']);
$ANNEE_COURSE = $Date['year']; 
$Month = $Date['month']; 
$Day = $Date['day']; 


  // On se connecte à MySQL
$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');



if (!$con)
{

     die('Could not connect: ' . mysql_error());
     print(-3);

}
else
{
     try
     {
          mysqli_select_db($con ,'dxvv_jurachrono' );
       
		  $sql = 'SELECT * FROM Resultat  WHERE Nom=\''.$_REQUEST["Nom"].'\' 
		  AND Prenom=\''. $_REQUEST ["Prenom"].'\'
		  AND Annee=\''. date("Y", strtotime($_REQUEST ["DateNaissance"])).'\'';
	  
		  $result2 = mysqli_query($con,$sql);
		  
		  // Si résultat pour cette personne trouvé
		  if ($result2 && mysqli_num_rows($result2) > 0) 
		  {

			$array = array();
			// Affiches Chaque donnée de résultat Trouvé
			while($donnees = mysqli_fetch_assoc($result2)) 
			{
				array_push($array, $donnees );
			}

			print( json_encode($array)); 

		  }
          else
          { 
               print(-2);
          }
     }
     catch(Exception $e)
     {
          print(-1);
     }    

}
?>
