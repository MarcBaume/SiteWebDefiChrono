

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
	include("../../MysqlConnect.php");
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
            if ( $ResultAddInsc != 1)
            {
                print(-24);
            }

           
            $sql = 'UPDATE inscription SET Prix  =\''.$_REQUEST['Prix'].'\'   WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
            $ResultAddInsc = mysqli_query($con,$sql);	
            if ( $ResultAddInsc != 1)
            {
                print(-26);
            }

            $sql = 'UPDATE inscription SET Date  = current_timestamp   WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
            $ResultAddInsc = mysqli_query($con,$sql);	
            if ( $ResultAddInsc != 1)
            {
               print(-50);
            }
           
             $sql = 'UPDATE inscription SET NomEquipe   =\''.$_REQUEST['NomEquipe'].'\'  WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
            $ResultAddInsc = mysqli_query($con,$sql);	
            if ( $ResultAddInsc != 1)
            {
                print(-51);
            }
          
            $sql = 'UPDATE inscription SET NomDisc1   =\''.$_REQUEST['NomDisc1'].'\'  WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
            $ResultAddInsc = mysqli_query($con,$sql);	
            if ( $ResultAddInsc != 1)
            {
                print(-52);
            }

             $sql = 'UPDATE inscription SET PrenomDisc1   =\''.$_REQUEST['PrenomDisc1'].'\'  WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
            $ResultAddInsc = mysqli_query($con,$sql);	
            if ( $ResultAddInsc != 1)
            {
                print(-53);
            }

              $sql = 'UPDATE inscription SET NomDisc2    =\''.$_REQUEST['NomDisc2'].'\' WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
            $ResultAddInsc = mysqli_query($con,$sql);	
            if ( $ResultAddInsc != 1)
            {
                print(-52);
            }

             $sql = 'UPDATE inscription SET PrenomDisc2    =\''.$_REQUEST['PrenomDisc2'].'\'  WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
            $ResultAddInsc = mysqli_query($con,$sql);	
            if ( $ResultAddInsc != 1)
            {
                print(-53);
            }
               $sql = 'UPDATE inscription SET NomDisc3    =\''.$_REQUEST['NomDisc3'].'\'  WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
            $ResultAddInsc = mysqli_query($con,$sql);	
            if ( $ResultAddInsc != 1)
            {
                print(-52);
            }

             $sql = 'UPDATE inscription SET PrenomDisc3    =\''.$_REQUEST['PrenomDisc3'].'\' WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
            $ResultAddInsc = mysqli_query($con,$sql);	
            if ( $ResultAddInsc != 1)
            {
                print(-53);
            }
               $sql = 'UPDATE inscription SET NomDisc4    =\''.$_REQUEST['NomDisc4'].'\'  WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
            $ResultAddInsc = mysqli_query($con,$sql);	
            if ( $ResultAddInsc != 1)
            {
                print(-52);
            }

             $sql = 'UPDATE inscription SET PrenomDisc4    =\''.$_REQUEST['PrenomDisc4'].'\' WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
            $ResultAddInsc = mysqli_query($con,$sql);	
            if ( $ResultAddInsc != 1)
            {
                print(-53);
            }
               $sql = 'UPDATE inscription SET NomDisc5   =\''.$_REQUEST['NomDisc5'].'\'  WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
            $ResultAddInsc = mysqli_query($con,$sql);	
            if ( $ResultAddInsc != 1)
            {
                print(-52);
            }

             $sql = 'UPDATE inscription SET PrenomDisc5    =\''.$_REQUEST['PrenomDisc5'].'\'  WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
            $ResultAddInsc = mysqli_query($con,$sql);	
            if ( $ResultAddInsc != 1)
            {
                print(-53);
            }
               $sql = 'UPDATE inscription SET NomDisc6   =\''.$_REQUEST['NomDisc6'].'\'  WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
            $ResultAddInsc = mysqli_query($con,$sql);	
            if ( $ResultAddInsc != 1)
            {
                print(-52);
            }

             $sql = 'UPDATE inscription SET PrenomDisc6    =\''.$_REQUEST['PrenomDisc6'].'\'  WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
            $ResultAddInsc = mysqli_query($con,$sql);	
            if ( $ResultAddInsc != 1)
            {
                print(-53);
            }
            else
            {
                print(1);
            }

     }
     catch(Exception $e)
     {
		print(-2);
     }    
?>
