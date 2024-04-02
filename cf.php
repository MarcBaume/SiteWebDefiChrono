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
	  <li><a href="formulaire_equipe.php">Inscriptions �quipe</a></li>
	    <li><a href="formulaire_relais.php">Inscriptions relais</a></li> !----->
   <li><a href="liste_relais.php">Liste inscrits relais</a></li> 
	   <li><a href="resultat.php">R�sultats</a></li> </br> </br> 

<fieldset>
<h3>Parcours</h3>

Les parcours se d�roulent principalement sur des chemins blancs ou chemins forestiers</br>
<b>Le d�part des adultes se trouve � la gare du Noirmont, passez le sous voie.</b></br>
Le d�part des enfants se situe devant la halle de gym </br>
 </br>
 <center>
<p>  Grand Parcours  8.7 km </p>
  <a href="images/img_grand_parcours2.jpg" class="lightbox"target="_blank"><img src="images/img_grand_parcours2.jpg"  WIDTH=650px alt=""<alt="Photo " title="Cliquez pour agrandir" /></a>
  <center> <i> Cliquez sur l'image pour l'agrandir </i> </center>
    <li><a href="https://connect.garmin.com/activity/730802241"target=_blank> parcours d�taill�</a></li> 
	 </br>
	  </br>
<p>  Populaire et walking  7.1 km</p>
  <a href="images/img_petit_parcours2.jpg" class="lightbox"target="_blank"><img src="images/img_petit_parcours2.jpg"  WIDTH=650px alt=""<alt="Photo " title="Cliquez pour agrandir" /></a>
   <li><a href="https://connect.garmin.com/modern/activity/729634884"target=_blank> parcours d�taill�</a></li> 
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
Par le formulaire se trouvant sous la rubrique Inscription, pas d'inscription par t�l�phone.</br>
Les inscriptions sur place se situent en bas de la halle de gym "au caveau".</br>
   Les inscriptions sur internet sont ferm�es , il est encore possible de s'inscrire sur place 1 heure avant votre d�party </br>
</fieldset>
<fieldset>
<h3>�quipes / Entreprises</h3>
Un classement par �quipe (�quipe ou entreprise) aura lieu sur le grand </br>
parcours et sera �tabli avec le cumul des temps des <b>3</b> membres de l'�quipe.</br></br>
Inscriptions des �quipes gratuites
</br>
<b> Pour inscrire une �quipe, il faut que chaque personne soit inscrite individuellement et que les noms et pr�noms de chaque membre soient orthographi�s de la m�me mani�re que dans l'inscription individuelle
</b>

	 Les inscriptions sont ferm�es </br>
</fieldset>
<fieldset>
<h3>Relais</h3>
Le relais � 3 se fait sur le petit parcours et est divis� en 3 relais de 2.4km. </br>
L'acc�s aux zones de relais se fera � pied, encadr� par des organisateurs.</br>

  Les inscriptions sont ferm�es </br>
</fieldset>
<fieldset>
<fieldset>
<h3>Sprint</h3>
Pour participer au sprint, il suffit d'�tre inscrit dans une des cat�gories du petit ou du grand parcours.</br>
 <b>Les vainqueurs, homme et femme, seront ceux qui attraperont les peluches situ�es 400m apr�s le d�part.</b></br>
 Ils devront obligatoirement terminer le parcours (ou l'�quipe dans le cas d'un relais) pour �tre </br>
d�clar�s vainqueurs.</br>
</fieldset>
<fieldset>
<h3>Restauration et Vestiaires</h3>
Les vestiaires de la halle de gym sont � votre disposition.</br>
Des restaurations chaudes sont � votre disposition dans la halle de gym.</br>
</fieldset>
<fieldset>
<h3>D�lai d'inscription</h3>
Jeudi 2 Juin 14:00  (aucune exception, les dossards seront attribu�s le 2 Juin)</br>
</fieldset>
<fieldset>
<h3>Frais d'inscription � payer sur place</h3>
Parcours adultes: </br>
Fr. 20.- pour les adultes inscrits sur internet </br>
<b>Inscriptions sur place jusqu'� 45 minutes avant votre d�part, majoration de Fr. 5.-</b></br>
Parcours enfants: </br>
Fr. 8.- pour les enfants inscrits sur internet </br>
<b>Inscriptions sur place jusqu'� 45 minutes avant votre d�part, majoration de Fr. 5.-</b></br>
</fieldset>
<fieldset>
<h3>Assurances</h3>
Les organisateurs d�clinent toute responsabilit� en cas d'accident ou de vol
</fieldset>
<h3>Programme & Flyer</h3></br>
 <li><a href="pdf/programme CF16 A5 web.pdf">Programme</a></li> </br>

</fieldset>
<fieldset>
<h3>cat�gories</h3></br>
    <?php

   try
{ 
	    // On se connecte � MySQL
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host=dxvv.myd.infomaniak.com;dbname=dxvv_gsfranchesmontagnesch1', 'dxvv_christopheJ', 'er3z4aet1234', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

	    $reponse = $bdd->query('SELECT * FROM categorie ORDER BY cat ASC');?>
	
	<center>
		<table width="70%">
		<th width="20%"> ann�e de naissance</th>
		<th width="20%"> parcours</th>
		<th width="15%"> cat�gorie</th>
		<th width="15%"> distance</th>
		<th width="15%"> heure d�part</th>

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
	
	<!-- il faut cr�er des form dans la boucle while pour pouvoir cr�er un bouton supprimer qui va supprimer la bonne valeur du champ cacher et non la derni�re -->
 
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
	
	<!-- il faut cr�er des form dans la boucle while pour pouvoir cr�er un bouton supprimer qui va supprimer la bonne valeur du champ cacher et non la derni�re -->
 
	<td style="background-color: #FFD0D0;"> <?php echo $donnees['annee_debut'] ."-". $donnees['annee_fin'] ?>  </td>
	<td style="background-color:#FFD0D0;">  <?php echo  $parcours; ?></td> 
    <td style="background-color: #FFD0D0;">  <?php echo $donnees['cat']; ?></td> 
	<td style="background-color: #FFD0D0;">	<?php echo $donnees['distance'];?> </td>
	<td style="background-color: #FFD0D0;">  <?php echo $donnees['heure_depart']; ?></td> 

	</tr><?php
    }
	IF  ($donnees['sexe'] =="Mixte") {
	 ?>
	
	<!-- il faut cr�er des form dans la boucle while pour pouvoir cr�er un bouton supprimer qui va supprimer la bonne valeur du champ cacher et non la derni�re -->
 
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
	
    $reponse->closeCursor(); // Termine le traitement de la requ�te


}
catch(Exception $e)
{
    // En cas d'erreur pr�c�demment, on affiche un message et on arr�te tout
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