

<?php

	include("../../MysqlConnect.php");
  try
  {
    $ValuePaiement = "En Attente";
    $sql = 'UPDATE inscription SET Payer=\''.$ValuePaiement.'\'  WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
    $ResultAddInsc = mysqli_query($con,$sql);	

    if ( $ResultAddInsc == 1)
    {
        print(1);
    }
    else
    {
        print(-6);
    }

    

  }
  catch(Exception $e)
  {
		print(-2);
}    

?>
