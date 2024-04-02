 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<?php include("head.php"); ?>
   <body>
        		
<?php include("en_tete.php"); ?> 
<?php include("menu_vertical.php"); ?>   

<Div id="corps">

<?php include("news.php"); ?>   
<ul id ="info">

   <li><a href="liste.php">Liste des inscrits</a></li> 
  <!----  <li><a href="formulaire.php">Inscriptions</a></li> 
	  <li><a href="formulaire_equipe.php">Inscriptions équipe</a></li>
	    <li><a href="formulaire_relais.php">Inscriptions relais</a></li> !----->
   <li><a href="liste_relais.php">Liste inscrits relais</a></li> 
	   <li><a href="resultat.php">Résultats</a></li> </br> </br> 

<fieldset>
<h3>Parcours</h3>

Les parcours se déroulent principalement sur des chemins blancs ou chemins forestiers</br>
<b>Le départ des adultes se trouve à la gare du Noirmont, passez le sous voie.</b></br>
Le départ des enfants se situe devant la halle de gym </br>
 </br>
 <center>
<p>  Grand Parcours  8.7 km </p>
  <a href="images/img_grand_parcours2.jpg" class="lightbox"target="_blank"><img src="images/img_grand_parcours2.jpg"  WIDTH=650px alt=""<alt="Photo " title="Cliquez pour agrandir" /></a>
  <center> <i> Cliquez sur l'image pour l'agrandir </i> </center>
    <li><a href="https://connect.garmin.com/activity/730802241"target=_blank> parcours détaillé</a></li> 
	 </br>
	  </br>
<p>  Populaire et walking  7.1 km</p>
  <a href="images/img_petit_parcours2.jpg" class="lightbox"target="_blank"><img src="images/img_petit_parcours2.jpg"  WIDTH=650px alt=""<alt="Photo " title="Cliquez pour agrandir" /></a>
   <li><a href="https://connect.garmin.com/modern/activity/729634884"target=_blank> parcours détaillé</a></li> 
    </br>
	 </br>
<p> Relais 3 x 2.4 km (possible par 2 1x 4.8 et 1 x 2.4 km) </p>
  <a href="images/relais.jpg" class="lightbox" target="_blank"><img src="images/relais.jpg"  WIDTH=650px alt=""<alt="Photo " title="Cliquez pour agrandir" /></a>
    
<p>   Course enfant boucle de ~300m</p>
  <a href="images/enfant_venir.jpg" class="lightbox"><img src="images/enfant_venir.jpg"  WIDTH=650px alt=""<alt="Photo " title="Cliquez pour agrandir" /></a> 
 </center>
</fieldset>
<fieldset>
<h3>Dates</h3>
Vendredi 3 Juin 2016: Le Noirmont * (Halle de gymnastique) </br>
</br>
</fieldset>

<fieldset>
<h3>Inscriptions</h3>
Par le formulaire se trouvant sous la rubrique Inscription, pas d'inscription par téléphone.</br>
Les inscriptions sur place se situent en bas de la halle de gym "au caveau".</br>
   Les inscriptions sur internet sont fermées , il est encore possible de s'inscrire sur place 1 heure avant votre départy </br>
</fieldset>
<fieldset>
<h3>Équipes / Entreprises</h3>
Un classement par équipe (équipe ou entreprise) aura lieu sur le grand </br>
parcours et sera établi avec le cumul des temps des <b>3</b> membres de l'équipe.</br></br>
Inscriptions des équipes gratuites
</br>
<b> Pour inscrire une équipe, il faut que chaque personne soit inscrite individuellement et que les noms et prénoms de chaque membre soient orthographiés de la même manière que dans l'inscription individuelle
</b>

	 Les inscriptions sont fermées </br>
</fieldset>
<fieldset>
<h3>Relais</h3>
Le relais à 3 se fait sur le petit parcours et est divisé en 3 relais de 2.4km. </br>
L'accès aux zones de relais se fera à pied, encadré par des organisateurs.</br>

  Les inscriptions sont fermées </br>
</fieldset>
<fieldset>
<fieldset>
<h3>Sprint</h3>
Pour participer au sprint, il suffit d'être inscrit dans une des catégories du petit ou du grand parcours.</br>
 <b>Les vainqueurs, homme et femme, seront ceux qui attraperont les peluches situées 400m après le départ.</b></br>
 Ils devront obligatoirement terminer le parcours (ou l'équipe dans le cas d'un relais) pour être </br>
déclarés vainqueurs.</br>
</fieldset>
<fieldset>
<h3>Restauration et Vestiaires</h3>
Les vestiaires de la halle de gym sont à votre disposition.</br>
Des restaurations chaudes sont à votre disposition dans la halle de gym.</br>
</fieldset>
<fieldset>
<h3>Délai d'inscription</h3>
Jeudi 2 Juin 14:00  (aucune exception, les dossards seront attribués le 2 Juin)</br>
</fieldset>
<fieldset>
<h3>Frais d'inscription à payer sur place</h3>
Parcours adultes: </br>
Fr. 20.- pour les adultes inscrits sur internet </br>
<b>Inscriptions sur place jusqu'à 45 minutes avant votre départ, majoration de Fr. 5.-</b></br>
Parcours enfants: </br>
Fr. 8.- pour les enfants inscrits sur internet </br>
<b>Inscriptions sur place jusqu'à 45 minutes avant votre départ, majoration de Fr. 5.-</b></br>
</fieldset>
<fieldset>
<h3>Assurances</h3>
Les organisateurs déclinent toute responsabilité en cas d'accident ou de vol
</fieldset>
<h3>Programme & Flyer</h3></br>
 <li><a href="pdf/programme CF16 A5 web.pdf">Programme</a></li> </br>

</fieldset>
<fieldset>
<h3>catégories</h3></br>
    <?php

   try
{ 
	    // On se connecte à MySQL
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host=dxvv.myd.infomaniak.com;dbname=dxvv_gsfranchesmontagnesch1', 'dxvv_christopheJ', 'er3z4aet1234', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

	    $reponse = $bdd->query('SELECT * FROM categorie ORDER BY cat ASC');?>
	
	<center>
		<table width="70%">
		<th width="20%"> année de naissance</th>
		<th width="20%"> parcours</th>
		<th width="15%"> catégorie</th>
		<th width="15%"> distance</th>
		<th width="15%"> heure départ</th>

	<tr>
	<?php
    while ($donnees = $reponse->fetch())
    {
	if ($donnees['parcours'] == "PP"){
	$parcours = "Populaire";
	}
	else
	{
	$parcours = $donnees['parcours'];

	}
	IF  ($donnees['sexe'] =="H") {
	 ?>
	
	<!-- il faut créer des form dans la boucle while pour pouvoir créer un bouton supprimer qui va supprimer la bonne valeur du champ cacher et non la dernière -->
 
	<td style="background-color: #80FFFF;"> <?php echo $donnees['annee_debut'] ."-". $donnees['annee_fin'] ?>  </td>
	<td style="background-color: #80FFFF;">  <?php echo $parcours; ?></td> 
    <td style="background-color: #80FFFF;">  <?php echo $donnees['cat']; ?></td> 
	<td style="background-color: #80FFFF;">	<?php echo $donnees['distance'];?> </td>
	<td style="background-color: #80FFFF;">  <?php echo $donnees['heure_depart']; ?></td> 

	</tr>

      <?php
	}
	IF  ($donnees['sexe'] =="D") {
	 ?>
	
	<!-- il faut créer des form dans la boucle while pour pouvoir créer un bouton supprimer qui va supprimer la bonne valeur du champ cacher et non la dernière -->
 
	<td style="background-color: #FFD0D0;"> <?php echo $donnees['annee_debut'] ."-". $donnees['annee_fin'] ?>  </td>
	<td style="background-color:#FFD0D0;">  <?php echo  $parcours; ?></td> 
    <td style="background-color: #FFD0D0;">  <?php echo $donnees['cat']; ?></td> 
	<td style="background-color: #FFD0D0;">	<?php echo $donnees['distance'];?> </td>
	<td style="background-color: #FFD0D0;">  <?php echo $donnees['heure_depart']; ?></td> 

	</tr><?php
    }
	IF  ($donnees['sexe'] =="Mixte") {
	 ?>
	
	<!-- il faut créer des form dans la boucle while pour pouvoir créer un bouton supprimer qui va supprimer la bonne valeur du champ cacher et non la dernière -->
 
	<td style="background-color: #dddddd;"> <?php echo $donnees['annee_debut'] ."-". $donnees['annee_fin'] ?>  </td>
	<td style="background-color: #dddddd;">  <?php echo  $parcours; ?></td> 
    <td style="background-color: #dddddd;">  <?php echo $donnees['cat']; ?></td> 
	<td style="background-color: #dddddd;">	<?php echo $donnees['distance'];?> </td>
	<td style="background-color: #dddddd;">  <?php echo $donnees['heure_depart']; ?></td> 

	</tr><?php
    }
	}?>
    </table>
	</center>
	
	<?php
	
    $reponse->closeCursor(); // Termine le traitement de la requête


}
catch(Exception $e)
{
    // En cas d'erreur précédemment, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}
?>
</fieldset>
</ul>
 <?php include ("sponsors.php"); ?>
<?php include ("footer.php"); ?>

</div>
</body>
</html>