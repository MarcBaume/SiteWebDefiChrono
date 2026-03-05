<?php

  // On se connecte à MySQL
	include("../../MysqlConnect.php");
     try
     {
          $sql = 'INSERT INTO EquipesEntreprises (`NomEquipe`,`IDTypeEquipeEntreprise`, `LoginEntreprise`)
		 VALUES
			("'.$_REQUEST['NomEquipeAdd'].'", 
			"'.$_REQUEST['IDTypeEquipeEntreprise'].'", 
			"'.$_REQUEST['LoginEntreprise'].'");';
			$ResultAddInsc = mysqli_query($con,$sql);	
			if ( $ResultAddInsc)
			{
				print(1);
			}
               else
                    {
                          echo "Erreur SQL : " . mysqli_error($con);
                    }
          
     }
     catch(Exception $e)
     {
		print(-2);
     }    


?>
