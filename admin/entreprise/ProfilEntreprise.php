<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="../../css/style.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
	 </script>
     <script src="../../js/prototype.js" ></script>
<script src="../../js/FonctionDefiChrono2.js?v=1"></script>

</head>
<!-- initilisation de variable -->
<?php
include("HeaderEntreprise.php"); 
include("menuEntreprise.php"); 

session_start();
  $con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
   if (!$con)
  {
		die('Could not connect: ' . mysql_error());
  }
  else
  {
		mysqli_select_db($con ,'dxvv_jurachrono' );
//	 $sql = 'SELECT * FROM inscription  WHERE course=\''.$NOM_COURSE. $ANNEE_COURSE. '\'AND parcours = \''.$_GET["Parcours"]. '\'ORDER  BY NomDepart ASC,Nom ASC';
$sql = 'SELECT * FROM Entreprises  WHERE Login=\''.$_SESSION['Login']. '\'';
	
$result = mysqli_query($con,$sql);
 if ($result && mysqli_num_rows($result) > 0) {
    // output data of each row
    while($donnees1 = mysqli_fetch_assoc($result)) {
       $donnees = $donnees1 ;
    }
}
  }
/*******************************************************************************************************************
 * 
 * Formulaire de donnée de l'entreprise
 * 
 ********************************************************************************************************************/
?>

<div id="formulaire" style='margin:50px'>
</br></br>
		<form name="formEntreprise" id="formEntreprise"  method="get" action="CibleUpgradeLoginEntreprise.php" id=FormCoureurs>
            <input type="hidden" name="login" id="login" value="<?php echo $_SESSION['Login'];?>"   />
               <p><label  for="nom">Entreprise:</label> <input value="<?php echo $donnees['NomEntreprise'];?>"type="text" name="entreprise" id="entreprise" tabindex="10"   /></p>
            <a> Contact
            <p><label  for="nom">Nom:</label> <input type="text"   value="<?php echo $donnees['NomContact'];?>" name="nom" id="nom" tabindex="10"   /></p>
            <p><label  for="prenom">Prénom:</label>  <input type="text"  value="<?php echo $donnees['PrenomContact'];?>" name="prenom" id="prenom" tabindex="20" /></p>
            <p><label  for="mail">Adresse e-mail:</label> <input type="text" name="email"  value="<?php echo $donnees['EmailContact'];?>" id="email" tabindex="40" /></p>
            <p><label  for="adresse">Adresse:</label> <input type="text" name="adresse" id="adresse"  value="<?php echo $donnees['AdresseContact'];?>" tabindex="50"/></p>
            <p><label for="npa">NPA:</label> <input type="text" name="zip" id="zip" tabindex="60" value="<?php echo $donnees['NPAContact'];?>" /></p>
            <p><label  for="localite">Localité:</label> <input type="text" name="ville" id="ville"tabindex="70"  value="<?php echo $donnees['LocaliteContact'];?>" /></p>
            <p><label for="pays">Pays:</label>  <input type="text" name="pays" id="pays"tabindex="80"  value="<?php echo $donnees['PaysContact'];?>" /></p>	
</a>

            <a><span> </span>
                <!-- Bouton validation information -->
                <button type ="button" class="ButtonResultat" type="button" style="float:right;padding: 20px;margin:10px; height:80px;font-size:180%;"
                        onClick="UpdateEntreprise()" title="Validations Informations" 
                        data-toggle="tooltip" data-placement="right">
                        <i class="fa fa-save" style= "font-size: 50px;    width:100%;"></i>
                               
                </button>
            </A>
		</form>
		

</div>


    </body>
</html>

<script type="text/javascript">

function UpdateEntreprise()
{
    console.log("Update");
	// Appelle fonction php pour ajouter un
    $('formEntreprise').request({
    onComplete: function(transport){
         console.log("Update1");
            console.log(transport);
            val =transport.responseText.evalJSON();
            console.log(val);
            if (val == "1")
            {
               console.log("Update2");
            }
        }
    });
    console.log("Update3");
}

</script>