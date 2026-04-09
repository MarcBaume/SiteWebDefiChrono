

<?php
	include("../../MysqlConnect.php");
     try
     {
          mysqli_select_db($con ,'dxvv_jurachrono' );

		  $sql = 'SELECT * FROM Localite WHERE NPA=\''.$_REQUEST['zip']. '\'ORDER  BY Localite ASC';
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
