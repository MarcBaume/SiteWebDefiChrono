

<?php

  // On se connecte à MySQL
	include("../../MysqlConnect.php");
     try
     {
       
        for ($i = 0; $i < $_REQUEST['NbrCode']; $i++)
        {
          $sql = 'INSERT INTO CodeReduction (`Code`,`Course`, `ReductionCHF`,`DateLimit`, `Nom`,`Prenom`)
		 VALUES
			("'.$_REQUEST['Code'].'", 
			"'.$_REQUEST['NomCourse'].'", 
            "'.$_REQUEST['ValueCode'].'", 
            "'.$_REQUEST['DateLimit'].'", 
            "'.$_REQUEST['NomCode'].'", 
			"'.$_REQUEST['PrenomCode'].'");';
			$ResultAddInsc = mysqli_query($con,$sql);	
            if ( $ResultAddInsc != 1)
			{
				print($i*-10);
			}
        }
			if ( $ResultAddInsc == 1)
			{
				print(1);
			}

     }
     catch(Exception $e)
     {
		print(-2);
     }    


?>
