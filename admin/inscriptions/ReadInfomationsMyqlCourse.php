<?php
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
    $array = array();
    if ( $result )
    {
      // Mise de chaque donnée dans tableau 
      while($donnees = mysqli_fetch_assoc($result)) 
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
