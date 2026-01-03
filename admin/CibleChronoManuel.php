<?php


/*____________________________________________________________________


______________________________________________________________________*/
$cookie_name = "Depart";
$cookie_value = $_REQUEST['Depart_Form'];
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

$result_array = array();
if ( strlen ($_REQUEST['Dossard'])>0)
{
	include("../MysqlConnect.php");

	$sql = 'INSERT INTO ChronoManuel (`Dossard`,`Depart`,`Temps`)
 VALUES  
	("'.$_REQUEST['Dossard'].'", 
  "'.$_REQUEST['Depart_Form'].'", 
	"'.$_REQUEST['Temps'].'");';

	if (mysqli_query($con,$sql))
  {

    /* SQL query to get results from database */
    $sql = "SELECT * FROM ChronoManuel ORDER BY DateModification DESC" ;
   	 
	 $result = mysqli_query($con,$sql);
     $index = 0;
    /* If there are results from database push to result array */
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($index < 30)
            {
            $index = $index +1 ;
            array_push($result_array, $row);
            }
            else
            {
                break;
            }
        }
    }
    header('Content-type: application/json');
    print( json_encode($result_array)); //Requette Sql OK
  }
else
{
    print( -5); //Requette Sql Not ok
}
}
else
{
	print( -10); // Aucun numéro de bon saisie
}
?>