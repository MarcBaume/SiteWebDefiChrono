

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

}
?>
