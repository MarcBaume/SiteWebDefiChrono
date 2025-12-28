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
          $sql = 'DELETE FROM inscription WHERE ID=\''.$_REQUEST['idFormDeletePanier'].  '\'';
          
          if (mysqli_query($con,$sql))
          {
               print(10); 
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
