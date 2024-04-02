


<?php
  // On se connecte à MySQL
$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');

if (!$con)
{

     die('Could not connect: ' . mysql_error());
     print(-3);

}
else
{
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

}
?>
