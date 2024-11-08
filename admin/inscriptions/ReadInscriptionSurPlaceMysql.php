

<?php
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
		  $sql = 'SELECT * FROM ListePersonnes WHERE Nom  LIKE "'.$_REQUEST['nom'].'%" and Prenom Like "'.$_REQUEST['prenom'].'%"';
		  $result = mysqli_query($con,$sql);
		  $array = array();
          if ( $result )
          {
			// Mise de chaque donnée dans tableau 
			while($donnees = mysqli_fetch_assoc($result)) 
			{
				array_push($array, $donnees );
			}

              
           }
          else
          { 
               print(-2);
          }

          if (count($array) == 0)
          {
               mysqli_select_db($con ,'dxvv_jurachrono' );
               $sql = 'SELECT * FROM inscription WHERE Nom  LIKE "'.$_REQUEST['nom'].'%" and Prenom Like "'.$_REQUEST['prenom'].'%"';
               $result = mysqli_query($con,$sql);
               $array = array();
             if ( $result )
             {
                  // Mise de chaque donnée dans tableau 
                  while($donnees = mysqli_fetch_assoc($result)) 
                  {
                       array_push($array, $donnees );
                  }
              }
             else
             { 
                  print(-4);
             }
          }
          print( json_encode($array)); 
     }
     catch(Exception $e)
     {
          print(-1);
     }    

}
?>
