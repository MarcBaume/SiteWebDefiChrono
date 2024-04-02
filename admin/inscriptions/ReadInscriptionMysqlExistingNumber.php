

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

          $sql = 'SELECT * FROM inscription WHERE course= "'.$_REQUEST["NomCourse"]. $ANNEE_COURSE .'" and  NumDossard  = "'.$_REQUEST['num_dossard'].'" ';

		  $result = mysqli_query($con,$sql);
		  $array = array();
          if ( $result )
          {
			//Si coureur déjà existant
			if (mysqli_num_rows($result) > 0)
               {
                     print(-4); 
               }
               else
               {
                    print(1); 
               }


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
