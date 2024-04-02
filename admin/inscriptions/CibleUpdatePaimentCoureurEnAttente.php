

<?php


  // On se connecte à MySQL
$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
mysqli_select_db($con ,'dxvv_jurachrono' );
if (!$con)
{

     die('Could not connect: ' . mysql_error());
	 print(-3);
}
else
{
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

}
?>
