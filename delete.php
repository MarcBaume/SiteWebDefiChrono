<?php

try
{

    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host=dxvv.myd.infomaniak.com;dbname=dxvv_jurachrono', 'dxvv_christopheJ', 'er3z4aet1234', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

	$req = $bdd->prepare('DELETE FROM inscription WHERE ID=?');
	$req->execute(array(
	$_POST['ID'],
	));

header('Location: listeInscriptionOrganisateur.php');

}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
?>