<?php

/*************************** CONNECTION AVEC LA BASE DE DONNEES ***********************************/
	include("../../MysqlConnect.php");
// ***************************************** AFFICHAGE BASE de Donnée ***************************************
	  // Create table de donnée du nom de parcours
//	mysqli_select_db($con,$row['Database']);
	$sql = 'SELECT * FROM Course  WHERE Nom_course=\''.$_REQUEST["NomCourse"].'\'AND Date=\''.$_REQUEST["DateCourse"].'\'' ; 
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
  
