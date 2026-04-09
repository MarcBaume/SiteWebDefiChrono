

<?php

$DateCourse =  $_REQUEST['DateCourse'];
$Date =  date_parse($_REQUEST['DateCourse']);
$ANNEE_COURSE = $Date['year']; 
$Month = $Date['month']; 
$Day = $Date['day']; 
include("../../MysqlConnect.php");
try
{
          $sql = 'SELECT * FROM inscription WHERE course= "'.$_REQUEST["NomCourse"]. $ANNEE_COURSE. '" and ( Nom  LIKE "'.$_REQUEST['Find'].'%" or NumDossard  LIKE "'.$_REQUEST['Find'].'%"  or Prenom Like "'.$_REQUEST['Find'].'%") ORDER BY Date DESC ';
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


?>
