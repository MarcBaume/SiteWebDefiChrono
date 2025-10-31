

<?php
 if  ( strlen($_REQUEST['DateCourse'])>0)
{
$DateCourse =  $_REQUEST['DateCourse'];
$Date =  date_parse($_REQUEST['DateCourse']);
$ANNEE_COURSE = $Date['year']; 
//$ANNEE_COURSE = $_GET['annee_course'];
$NOM_COURSE = $_REQUEST["NomCourse"];


}

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
        if ($_REQUEST['num_dossard'] != "0")
        {
            // Verification que le dossard n'existe pas
            $sql = 'SELECT * FROM inscription WHERE course=\''.$NOM_COURSE. $ANNEE_COURSE .'\'AND NumDossard  =\''. $_REQUEST['num_dossard'].'\'AND ID  !=\'' .$_REQUEST['IDCoureur'].'\''; 
            $ResultAddInsc = mysqli_query($con,$sql);	
        
            if ( $ResultAddInsc )
            {

                    // SI le dossard existe déjà
                if ($ResultAddInsc && mysqli_num_rows($ResultAddInsc) > 0)
                {
                    print(-9999);
                    exit;
                }
            
            }
        }
      


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

        $sql = 'UPDATE inscription SET club  =\''.$_REQUEST['club'].'\'   WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
        $ResultAddInsc = mysqli_query($con,$sql);	

        
        if ( $ResultAddInsc !=  1)
        {
            print(-24);
        }


        
        $sql = 'UPDATE inscription SET NomEquipe  =\''.$_REQUEST['NomEquipe'].'\'   WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
        $ResultAddInsc = mysqli_query($con,$sql);	

			$ResultAddInsc = mysqli_query($con,$sql);	
			if ( $ResultAddInsc !=  1)
           {
                print(-23);
            }

            $sql = 'UPDATE inscription SET TypeEquipe  =\''.$_REQUEST['TypeEquipe'].'\'   WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
            $ResultAddInsc = mysqli_query($con,$sql);	
    
                $ResultAddInsc = mysqli_query($con,$sql);	
                if ( $ResultAddInsc !=  1)
               {
                    print(-231);
                }
            $sql = 'UPDATE inscription SET NbrEtape  =\''.$_REQUEST['NbrEtape'].'\'   WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
            $ResultAddInsc = mysqli_query($con,$sql);	
    
                $ResultAddInsc = mysqli_query($con,$sql);	
                if ( $ResultAddInsc != 1)
                {
                    print(-24);
                }

     $sql = 'UPDATE inscription SET Date  = current_timestamp   WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
            $ResultAddInsc = mysqli_query($con,$sql);	
    
                $ResultAddInsc = mysqli_query($con,$sql);	
                if ( $ResultAddInsc == 1)
                {
                    print(1);
                }
                else
                {
                    print(-25);
                }

     }
     catch(Exception $e)
     {
		print(-2);
     }    

}
?>
