<?php

try
{

    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host=dxvv.myd.infomaniak.com;dbname=dxvv_jurachrono', 'dxvv_christopheJ', 'er3z4aet1234', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

	$req = $bdd->prepare('DELETE FROM inscription WHERE ID=?');
	$req->execute(array(
	$_POST['ID'],
	));


}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
?>
<body onload="document.formulaire.submit();">
	 <form  method="post" action ="listeInscriptionOrganisateur.php" name="formulaire" >
	 <input type="hidden" name="login" id="login" tabindex="10"  size="60"  value= '<?php echo $_POST['login'] ?>' />
	<input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $_POST["DateCourse"] ?>' />
			<input type="hidden" name="etape" id="etape" value= '<?php echo $_POST["etape"] ?>' />
			<input type="hidden" name="NomCourse" id="NomCourse" tabindex="10"  size="60"  value= '<?php echo $_POST["NomCourse"] ?>' />
	 </form>
</body>