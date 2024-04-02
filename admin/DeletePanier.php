<?php

try
{
 
	$bdd = new PDO('mysql:host=dxvv.myd.infomaniak.com;dbname=dxvv_jurachrono','dxvv_christopheJ','er3z4aet1234');
	$req = $bdd->prepare("DELETE FROM inscription WHERE ID =:ID");
	$req->execute(array(
	"ID" => $_POST["ID"]
	));
	header("location: Pannier.php"); // Redirecting To Other Page

}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
?>
