

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
        $sql = 'UPDATE inscription SET NumDossard =\''.$_REQUEST['num_dossard'].'\'   WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
        $ResultAddInsc = mysqli_query($con,$sql);	

        if ( $ResultAddInsc != 1)
        {
            print(-11);
        }

        $sql = 'UPDATE inscription SET Nom =\''.$_REQUEST['nom'].'\'   WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
        $ResultAddInsc = mysqli_query($con,$sql);	

        if ( $ResultAddInsc != 1)
        {
            print(-12);
        }


        $sql = 'UPDATE inscription SET Prenom =\''.$_REQUEST['prenom'].'\'   WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
        $ResultAddInsc = mysqli_query($con,$sql);	

        if ( $ResultAddInsc !=  1)
        {
            print(-13);
        }

        $sql = 'UPDATE inscription SET adresse =\''.$_REQUEST['adresse'].'\'   WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
        $ResultAddInsc = mysqli_query($con,$sql);	

        if ( $ResultAddInsc != 1)
        {
            print(-14);
        }

        $sql = 'UPDATE inscription SET npa =\''.$_REQUEST['zip'].'\'   WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
        $ResultAddInsc = mysqli_query($con,$sql);	

        if ( $ResultAddInsc !=  1)
        {
            print(-15);
        }


        $sql = 'UPDATE inscription SET localite =\''.$_REQUEST['ville'].'\'   WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
        $ResultAddInsc = mysqli_query($con,$sql);	

        if ( $ResultAddInsc !=  1)
        {
            print(-16);
        }


        $sql = 'UPDATE inscription SET DateNaissance =\''.$_REQUEST['date'].'\'   WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
        $ResultAddInsc = mysqli_query($con,$sql);	

        if ( $ResultAddInsc !=  1)
        {
            print(-17);
        }


        $sql = 'UPDATE inscription SET sexe =\''.$_REQUEST['sexe'].'\'   WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
        $ResultAddInsc = mysqli_query($con,$sql);	

        if ( $ResultAddInsc !=  1)
        {
            print(-18);
        }

        $sql = 'UPDATE inscription SET NumCategorie =\''.$_REQUEST['NumCat'].'\'   WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
        $ResultAddInsc = mysqli_query($con,$sql);	

        if ( $ResultAddInsc !=  1)
        {
            print(-19);
        }


        $sql = 'UPDATE inscription SET parcours =\''.$_REQUEST['NomParcours'].'\'   WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
        $ResultAddInsc = mysqli_query($con,$sql);	


        if ( $ResultAddInsc !=  1)
        {
            print(-20);
        }

        $sql = 'UPDATE inscription SET NomDepart  =\''.$_REQUEST['NomDepart'].'\'   WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
        $ResultAddInsc = mysqli_query($con,$sql);	

        
        if ( $ResultAddInsc !=  1)
        {
            print(-21);
        }

        $sql = 'UPDATE inscription SET NomCategorie  =\''.$_REQUEST['NomCat'].'\'   WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
        $ResultAddInsc = mysqli_query($con,$sql);	

        
        if ( $ResultAddInsc !=  1)
        {
            print(-22);
        }

        $sql = 'UPDATE inscription SET NomEquipe  =\''.$_REQUEST['NomEquipe'].'\'   WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
        $ResultAddInsc = mysqli_query($con,$sql);	

			$ResultAddInsc = mysqli_query($con,$sql);	
			if ( $ResultAddInsc == 1)
			{
				print(1);
			}
            else
            {
                print(-23);
            }

     }
     catch(Exception $e)
     {
		print(-2);
     }    

}
?>
