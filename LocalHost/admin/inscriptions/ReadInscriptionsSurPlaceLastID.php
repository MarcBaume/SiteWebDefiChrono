

<?php

$DateCourse =  $_REQUEST['DateCourse'];
$Date =  date_parse($_REQUEST['DateCourse']);
$ANNEE_COURSE = $Date['year']; 
$Month = $Date['month']; 
$Day = $Date['day']; 

  // On se connecte à MySQL
include("../../MysqlConnect.php");
try
{
     mysqli_select_db($con ,'dxvv_jurachrono' );
     $sql = 'SELECT * FROM inscription WHERE ID = "'.$_REQUEST['LastAdresseID'].'%"';
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
