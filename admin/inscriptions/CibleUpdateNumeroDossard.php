

<?php
 if  ( strlen($_REQUEST['DateCourse'])>0)
{
$DateCourse =  $_REQUEST['DateCourse'];
$Date =  date_parse($_REQUEST['DateCourse']);
$ANNEE_COURSE = $Date['year']; 
//$ANNEE_COURSE = $_GET['annee_course'];
$NOM_COURSE = $_REQUEST["NomCourse"];


}

	include("../../MysqlConnect.php");
     try
     {
        // Verification que le dossard n'existe pas
        $sql = 'SELECT * FROM inscription WHERE course=\''.$NOM_COURSE. $ANNEE_COURSE .'\'AND NumDossard  =\''. $_REQUEST['num_dossard'].'\'AND ID  !=\'' .$_REQUEST['IDCoureur'].'\''; 
        $ResultAddInsc = mysqli_query($con,$sql);	
      
        if ( $ResultAddInsc )
        {

          
        $sql = 'UPDATE inscription SET NumDossard =\''.$_REQUEST['num_dossard'].'\'   WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
        $ResultAddInsc = mysqli_query($con,$sql);	

        if ( $ResultAddInsc != 1)
        {
            print(-11);
        }

          else
          {
            print(1);
          }
        } 
     }
     catch(Exception $e)
     {
		print(-2);
     }    


?>
