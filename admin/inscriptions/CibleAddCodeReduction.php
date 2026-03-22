

<?php

  // On se connecte à MySQL
	include("../../MysqlConnect.php");

  function generateRandomString($length = 4) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString;
}

     try
     {
       
        for ($i = 0; $i < $_REQUEST['NbrCode']; $i++)
        {
          $ValueCode = $_REQUEST['Code'];
          if ($_REQUEST['TypeCodeReduc'] == "ChoiceTypeRandom")
           {
            $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $longueur = 4;
            $code = substr(str_shuffle($caracteres), 0, $longueur);
            $ValueCode = $_REQUEST['Code'].  $code;
           } 
          $sql = 'INSERT INTO CodeReduction (`Code`,`Course`, `ReductionCHF`,`DateLimit`, `Nom`,`Prenom`)
		 VALUES
			("'.$ValueCode.'", 
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
