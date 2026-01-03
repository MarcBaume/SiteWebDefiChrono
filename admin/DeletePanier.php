<?php
include("../MysqlConnect.php");
try
{
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




?>
