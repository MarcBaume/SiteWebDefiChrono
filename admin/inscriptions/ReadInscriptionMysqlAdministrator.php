

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
		  $sql = 'SELECT * FROM inscription ORDER BY Date DESC  ';
		  $result = mysqli_query($con,$sql);
		  $array = array();
          if ( $result )
          {
			// Mise de chaque donnée dans tableau 
			while($donnees = mysqli_fetch_assoc($result)) 
			{
                    $i  = $i  + 1 ;
                    if ($i > 20)
                    {
                         break;
                    }
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
