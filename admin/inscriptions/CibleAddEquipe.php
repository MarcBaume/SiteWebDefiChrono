

<?php

function majuscules($inChaine)
{
    $inChaine = strtolower($inChaine);
    // index du nom changer
    $tiretIndex = strpos($inChaine, '-');
    // Remplace le minus par un espace 
    $inChaine = str_replace("-"," ",$inChaine);
    // Mets en majuscule ddébut de chaque nom
    $inChaine = ucwords($inChaine);
    if ( $tiretIndex  > 0)
    {
    // Remets le tiret d'union 
    $inChaine = substr_replace($inChaine,"-",$tiretIndex,1);

    }
	return $inChaine;
}

  // On se connecte à MySQL
	include("../../MysqlConnect.php");
     try
     {
          mysqli_select_db($con ,'dxvv_jurachrono' );
          $sql = 'INSERT INTO EquipesEntreprises (`NomEquipes`,`TypeCourse`, `LoginEntreprise`)
		 VALUES
			("'.$_REQUEST['NomEquipes'].'", 
			"'.$_REQUEST['TypeCourse'].'", 
			"'.$_REQUEST['LoginEntreprise'].'");';
			$ResultAddInsc = mysqli_query($con,$sql);	
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
