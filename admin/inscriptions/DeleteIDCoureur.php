


<?php
  // On se connecte à MySQL
	include("../../MysqlConnect.php");
     try
     {
        if (strlen($_REQUEST['IDCoureur'] > 0))
        {
            mysqli_select_db($con ,'dxvv_jurachrono' );
            $sql = 'DELETE FROM inscription  WHERE ID  = "'.$_REQUEST['IDCoureur'].'"';
            $result = mysqli_query($con,$sql);
            $array = array();
            if ( $result )
            {
                print(1);
            }
            else
            { 
                print(-2);
            }
        }
        else
        { 
             print(-20);
        }
     }
     catch(Exception $e)
     {
          print(-1);
     }    


?>
