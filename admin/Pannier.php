<!DOCTYPE html>
<html>
<head>
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="../css/style.css" type="text/css"/>
	 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	 <script type="text/javascript" src="https://media.payrexx.com/modal/v1/modal.min.js"></script>
 	<script src="../js/prototype.js" ></script>
<script>
	// Initalisation de variable
	var TotalReduction = 0;
	var TotalTax = 0;
	var ArrayReduction = [];
	var Total		= 0;
	var linkAccept = "";
	var ListCourse =  "";
	var strLinkAccept =  "";
	var strLinkRefused =  "";
	function fundeleteInscription(id)
	{
		console.log("fundeleteInscription : " +id)
		document.getElementById('idFormDeletePanier' ).value= id;
		$('formDelete').request({
			onComplete: function(transport){
				val =transport.responseText.evalJSON();
				console.log(val);	
				if (val== 10)
				{
					location.reload();
				}
			}
		});
	}
		
	function funModification(id,Champ)
	{
		console.log("funModification : " +id + Champ)
		document.getElementById("IDModification").value = id;
		
		if (Champ.search('Disc')>-1)
		{
			document.getElementById("ChampModification").value = 'Nom'+Champ;
			document.getElementById("ValueModification").value = document.getElementById('Nom'+Champ+id).value;
		
			// Appelle fonction php pour vérifier que le coupon existe
			$('formModif').request({
			onComplete: function(transport){
					val =transport.responseText.evalJSON();
				console.log(val);
				}
			});
		
			document.getElementById("ChampModification").value =  'Prenom'+Champ;
			document.getElementById("ValueModification").value = document.getElementById('Prenom'+Champ+id).value;
		
				// Appelle fonction php pour vérifier que le coupon existe
			$('formModif').request({
			onComplete: function(transport){
					val =transport.responseText.evalJSON();
				console.log(val);
				}
			});
			
		}
		else
		{
			document.getElementById("ChampModification").value = Champ;
			document.getElementById("ValueModification").value = document.getElementById(Champ+id).value;
				// Appelle fonction php pour vérifier que le coupon existe
			$('formModif').request({
			onComplete: function(transport){
					val =transport.responseText.evalJSON();
				console.log(val);
				}
			});
		}
	}
		
	function ClickRows(event, id)
	{  
		if (	document.getElementById("Infos"+id).style.visibility == "visible")
		{
			//	document.getElementById("RowRace"+id).style.backgroundColor = "#ffffff" ;
			document.getElementById("Infos"+id).style.visibility = "collapse" ;
			document.getElementById("IconsMinus"+id).style.visibility = "collapse" ;
			document.getElementById("Icons"+id).style.visibility = "visible" ;
		}
		else
		{
			//	document.getElementById("RowRace"+id).style.backgroundColor = "#c9efff" ;
			document.getElementById("Infos"+id).style.visibility = "visible" ;
			document.getElementById("IconsMinus"+id).style.visibility = "visible" ;
			document.getElementById("Icons"+id).style.visibility = "collapse" ;
		}
		event.stopPropagation(); 	
	}

	function ValidInscription()
	{
		window.location.href = linkAccept;
	}

	function AddInscription()
	{
		document.getElementById("AddNewInscription").submit();
	}
	function ButtonPayPayrexx( order,log,logLight)
	{
		if (Total != null && document.getElementById("PrixTotal")!= null && document.getElementById("IDPayresxx")!= null)
		{
				total = parseFloat(document.getElementById("PrixTotal").value);
				string1 = "https://defichrono.payrexx.com/fr/vpos?purpose="+order+
				"&amount="+ total  +"&invoice_currency=1&contact_forename="+
				logLight +"&contact_email="+ log;
				
				console.log(string1);

				var ValidLink =document.getElementById("IDValide");
				var PayrexxLink =document.getElementById("IDPayresxx");
				
				console.log(total);
				if (total > 0)
				{
					PayrexxLink.setAttribute('data-href',string1);
					ValidLink.style.display  = "none" ;
					ValidLink.visibility = "hidden" ;

					PayrexxLink.style.display  = "block" ;
					PayrexxLink.visibility = "visible" ;

					console.log("Create event click");
					// Simulate a mouse click
					PayrexxLink.click();
				}
				else
				{
					ValidLink.style.display  = "block" ;
					ValidLink.visibility = "visible" ;

					PayrexxLink.style.display  = "none" ;
					PayrexxLink.visibility = "hidden" ;
				}
		}
	}
	
	function funValidPaiement()
	{
			// Appelle fonction php pour vérifier que le coupon existe
			$('formPayrexx1').request({
			onComplete: function(transport){
				val =transport.responseText.evalJSON();
				console.log(val);
				log = document.getElementById("LoginUpdateRegister").value;
				logLight = document.getElementById("LoginLightUpdateRegister").value;
				order =  document.getElementById("OrderIDPayrexx").value;
				strLinkAccept =   "https://defichrono.ch/admin/PaiementAccepted.php?Login="+log +"&ID="+order;
				strLinkRefused =  "https://defichrono.ch/admin/PaiementDecliened.php?Login="+log+"&ID="+order;
				console.log(strLinkAccept);
				ButtonPayPayrexx( order,log,logLight);

			}
			});

	}
</script>
 </head>
 <body>

<?php
   include("HeaderAdmin.php"); 
?>
</br>
<?	include("MenuMember.php"); ?>
<div id="corps">
<?php 
if ( isset($_SESSION['Login']))
{?>
	<script>
	Login = 	<?php echo json_encode($_SESSION["Login"]); ?>;
	</script>
	<?php
	$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
	mysqli_select_db($con ,'dxvv_jurachrono' );
	$Value = 'True';
	$sql = 'SELECT * FROM inscription  WHERE Login=\''.$_SESSION["Login"].'\'AND Payer !=\'Payé\'AND Payer !=\'Bon\' AND PayementOnLine =\''.$Value.'\'';
	$result = mysqli_query($con,$sql);
	$c=0;
	// On affiche chaque entrée une à une
	if ($result && mysqli_num_rows($result) > 0) 
	{
		// output data of each row
		?>
		<img src="../images/FilRougeInscription5.png" style="width: 100%" ></img>
		</br>
		</br>
		<p class="title2"> Paiement via internet</p>
		<div id="TableauResulat">
		<table> 
			<tr>
				<th width="20%"> Course</th>
				<th > Nom </th>
				<th width="15%"> Parcours </th>
				<th width="15%">  Option</th>
				<th width="100px">  Prix</th>
				<!--<th width="15%">  Payer</th>-->
			</tr>
			
			<?php
			$Background = 0;

			while($donnees = mysqli_fetch_assoc($result)) 
			{
				if ($donnees['Payer'] == "En Attente" || $donnees['Payer'] == "cancelled"  || $donnees['Payer'] == "declined" || $donnees['Payer'] == "refunded")
				{
					$TotalInscriptionPhp = $TotalInscriptionPhp  + $donnees['Prix'];

					if ($Background == 1)
					{
						$Background = 0;?>
						<tr style="background: #ededed;"   >
						<?
					}
					else
					{
						$Background = 1;?>
						<tr style="background: #ffffff;"   >
						<?
					}
					
					$CourseId = $donnees['course'];
					?>

						<td style="font-size:24px"> <?php echo $donnees['course']; ?></td>
						<td style="font-size:24px"> <?php echo $donnees['Nom'] . " ". $donnees['Prenom']; ?></td>
						<td><?php echo $donnees['parcours']; ?>
						</br><?php echo $donnees['NomCategorie']; ?></td>
						<td><?php echo $donnees['NbrEtape']; ?></td>
						<td style="font-size:24px"><?php echo $donnees['Prix']; ?></td>
					
					<?php
					if ($donnees['Payer'] !=  "Payé")
					{?>
							<td>
							<a><span> </span><button type ="button" style="float:right; margin :5px;"
							onclick="fundeleteInscription('<?php echo $donnees['ID'] ?>' )">
								<i class="fa fa-trash" style= "font-size: 30px;margin:5px;color: #FF0000;"></i>
							</button></a>
							
							</td>
					<?php 
					}?>
						</tr>
						
						<script>
							var ind = ListCourse.indexOf(<?php echo json_encode($donnees['course']); ?>);
							// Ajout dans la liste des courses si celle-ci n'est pas trouvé sérialiser
							if (ind< 0)
							{
								// !! on ne peut pas écrire drectement dans le champs input parce qu'il n'est pas créer dans le dom
								ListCourse= ListCourse + <?php echo json_encode($donnees['course']); ?> + ";";
								
							}
						</script>
						<?php
				}
			}
			
			// Calcul la valeur de tax
			$TotalTax = (($TotalInscriptionPhp  /100)*2)  + 1;
			$Total = $TotalTax  +$TotalInscriptionPhp ;
			$TotalDataTrans  = 	$Total  *100;
			// Affichage des prix calculé?>	
		</table>
		<div>
		</br>
		</br>
		<div id="prix">		
<table >
	<tr>
		<td>
			<label for="">Prix total inscription</label>
		</td>
		<td>
		<input style="width:100px" type="text"  name="idTotalInscription" id="idTotalInscription"  readonly  >
		</td>
		<td>
			CHF
		</td>
	</tr>
	<tr>
		<td>
			<label for="">Frais de traitement 1CHF + 2%</label>
		</td>
		<td>
		 <input type="text" style="width:100px"  name="PrixTax" id="PrixTax" readonly  />
		</td>
		<td>
			CHF
		</td>
	</tr>
	<tr>
		<td>
			<label for="">Total</label>
		</td>
		<td>
			<input type="text" style="width:100px"  name="PrixTotal" id="PrixTotal"   readonly  />
		</td>
		<td>
			CHF
		</td>
	</tr>
</table>
		<script>
				document.getElementById("idTotalInscription").value = <?php echo json_encode($TotalInscriptionPhp ); ?> ;
				document.getElementById("PrixTax").value = <?php echo json_encode($TotalTax ); ?> ; 
				document.getElementById("PrixTotal").value =  <?php echo json_encode($Total ); ?> ; 
			
		</script>

			<?php
			// Ajout d'inscrption à la course en cours
			if ( strlen($_SESSION['DateCourse'])> 0  && strlen($_SESSION['Course'])>0)
			{
			?>
			<div  class="Button"  style="cursor: pointer; Padding:10px ;color:black;  font-size:24px; text-decoration:none;" onclick="AddInscription()" >
						<i class="fa fa-plus" ></i>
						<a>
						Ajouter une autre inscription à
						<?php echo $_SESSION['Course'] ?>
						</a>
					<form method="get" id="AddNewInscription" action="../formulaire2023.php">
						<input type="hidden" name="DateCourse" id="DateCourse"   value= '<?php echo $_SESSION['DateCourse'] ?>' />
						<input type="hidden" name="NomCourse" id="NomCourse"  value= '<?php echo $_SESSION['Course']?>' />
						<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_SESSION['Nbretape'] ?>' />
					</form>
			</div>		
			<?php
			}
			?>
			<!-- Afficher seulement si il y a des inscriptions gratuites !-->
			 <div class="Button" onclick="funValidPaiement()" style="display:none;"id="IDValide">   
				<i style= "font-size: 36px;margin:5px;" class="fa fa-check" ></i>
				<a style= "font-size: 24px;margin:5px;">
					Valider mes inscriptions
				</a>			
			</div>
			<!-- Afficher seulement si il y a des inscriptions payantes-->
			<div class="Button" onclick="funValidPaiement()">
				<i style= "font-size: 36px;margin:5px;" class="fa fa-shopping-cart" ></i>
				<a style= "font-size: 24px;margin:5px;">
					Payer mes inscriptions
				</a>
			</div>
		

	<!--Formulaire et div invisible par l'utilisateur transfert des données pour la base de donnée inscriptions order id -->
	<div  id="IDPayresxx" >
	</div>
	<?php
		$LoginLight =substr($_SESSION['Login'], 0 ,   strpos($_SESSION['Login'], "@") ) ;
		$OrderID = $LoginLight.$CourseId . date("YmdHis");?>
		<form  id="formPayrexx1" method="get" action="CibleUpdateOrdrerIDPayement.php">
			<input type="hidden" name="LoginUpdateRegister" id="LoginUpdateRegister"   value= '<?php echo $_SESSION['Login'] ?>' />
			<input type="hidden" name="LoginLightUpdateRegister" id="LoginLightUpdateRegister"   value= '<?php echo $LoginLight ?>' />
			<input type="hidden" name="OrderIDPayrexx" id="OrderIDPayrexx"   value= '<?php echo $OrderID  ?>' />
		</form>
	<!----------------------------------------------------------------------------------------------->
	</br>
	</br>
	</br>
	<a style="font-size : 10px;">
		* Vos inscriptions seront validé quand le paiement sera éffectué </br>
		* Le paiement sera remboursé seulement sur présentation d'un certificat médical à transmettre par e-mail à info@juradefichrono.ch </br>
		* Le paiement est certifié seulement avec l'e-mail  de la société "Payrexx" </br>
		* Il est possible qu'après votre paiement, l'inscription ne soit pas immédiatement validée. Quand elle sera validée par la banque, elle va apparaître sur la liste de départ</br>
		<a>
		</div>
	<?php

}
else
{
	?>
	<center>
	<h2> Votre panier est vide </h2>
	</center>
	<?
}
	$Value = '0';
	$Value1 = 'False';
	
	/************************************** PAIEMENT PAR IBAN *******************************************/
	$sql = 'SELECT * FROM inscription  WHERE Login=\''.$_SESSION["Login"].'\'AND (PayementOnLine =\''.$Value.'\' OR PayementOnLine =\''.$Value1.'\')';
	$result = mysqli_query($con,$sql);
	$c=0;
	$PrixTotal = 0;
	
    // On affiche chaque entrée une à une
		if ($result && mysqli_num_rows($result) > 0) 
		{
		// output data of each row
		$Background = 0;
		?>
		
			</br>
				</br>
					</br>
		<p class="title2"> Paiement sur place ou par compte IBAN selon les conditions de l'organisateur </p>
			<table> 
					<?if ($Background == 1)
					{
						$Background = 0;?>
						<tr style="background: #ededed;"   >
						<?
					}
					else
					{
						$Background = 1;?>
						<tr style="background: #ffffff;"   >
						<?
					}?>
					<th width="20%"> Course</th>
					<th width="15%"> Nom</th>
					<th width="15%"> Prénom</th>
					<th width="15%"> Parcours </th>
					<th width="15%">  Catégorie</th>
					<th width="15%">  Option</th>
					<th width="15%">  Prix</th>
					<th width="15%">  Payer</th>
				</tr>
				
			<?php

			while($donnees = mysqli_fetch_assoc($result)) 
			{
				if ($donnees['Payer'] == "En Attente" ||$donnees['Payer'] == "Sur Place" || $donnees['Payer'] == "Refusé")
				{
					// Modifier les Informations en ajoutant Le Order ID dans la Colonne de la table inscription OrderPayement
					$sql = 'UPDATE inscription SET OrderPayement = \''.$OrderID.'\'  WHERE ID=\''.$donnees["ID"].'\''; 
					if (!mysqli_query($con,$sql))
					{
						echo "Error update : Membres Nom" . mysql_error();
					}  

						$PrixTotal = $PrixTotal + $donnees['Prix'];
						$PrixTax = (($PrixTotal /100)*2)  + 1;
					}
					?>

					<tr>
						
						<td> <?php echo $donnees['course']; ?></td>
						<td> <?php echo $donnees['Nom']; ?></td>
						<td> <?php echo $donnees['Prenom']; ?></td>
						<td><?php echo $donnees['parcours']; ?></td>
						<td><?php echo $donnees['NomCategorie']; ?></td>
						<td><?php echo $donnees['NbrEtape']; ?></td>
						<td><?php echo $donnees['Prix']; ?></td>
						<td> <?php echo $donnees ["Payer"] ?></td>
						

						<?php
				if ($donnees['Payer'] !=  "Payé")
				{
			?>
	
						<td>
						<?php if ($donnees ["Payer"] != 'Payé')
						{?>
							<span class="dot" onclick="deleteInscription(<?php echo $donnees ['ID'] ?>)">
								<i class="fa fa-trash" style= "font-size: 20px;margin: 6px;color: #FF0000;"></i>
							</span>
							<?
						}?>
						</td>
				
						<?php }?>
					</tr>
					<?php
				
			}
	

	?>
			</table>

	</br>
		
		</td>
		</table>
		</br>
		<a style="font-size : 14px;">
		* Vos inscriptions sont enregistrées, le paiement s'effectue sur place ou par IBAN </br> 
			<a>
		<?php
	
		}
		
		
		
		/************************************** INSCRIPTION DEJA VALIDER *******************************************/
	
	
	$sql = 'SELECT * FROM inscription  WHERE Login=\''.$_SESSION["Login"].'\'';
	$result = mysqli_query($con,$sql);
	$c=0;
	$PrixTotal = 0;
	
    // On affiche chaque entrée une à une
		if ($result && mysqli_num_rows($result) > 0) 
		{
		// output data of each row
		?>
		
			</br>
				</br>
					</br>
					
		<p class="title2">Les inscriptions effectuées </p>
			<!-- >Formulaire envoyer lors de la modification des insription -->
				<form method="get" action="modification_inscriptionUser.php" name = 'formModif'  id='formModif' >		
				<input type="hidden" name='ChampModification' id= 'ChampModification'  />
				<input type="hidden" name='ValueModification' id= 'ValueModification'  />
				<input type="hidden" name ='IDModification'id= 'IDModification'  />
				</form>
			<div id="TableauResulat">
			<table> 
				<tr>
					<th></th>
					<th width="20%"> Course</th>
					<th width="15%"> Nom </th>
					<th width="15%"> Parcours </th>
					<th width="15%">  Catégorie</th>
					<th width="15%"> Type</th>
					<th width="15%"> Statuts</th>
				</tr>
				
			<?php
			$Background = 0;
			while($donnees = mysqli_fetch_assoc($result)) 
			{ ?>
			<?
				if ($donnees['Payer'] != "En Attente" && $donnees['Payer'] != "cancelled" && $donnees['Payer'] != "declined" && $donnees['Payer'] != "refunded" )
				{
					if ($Background == 1)
					{
						$Background = 0;?>
							<tr style="background: #ededed;"   >
						<?
					}
					else
					{
						$Background = 1;?>
						<tr style="background: #ffffff;"   >
						<?
					}?>
						<td></td>
						<td  style="font-size:24px"> <?php echo $donnees['course']; ?></td>
						<td  style="font-size:24px" > <?php echo  $donnees['Nom'] . ' '. $donnees['Prenom']; ?>    </td>
						<td>  <?php echo $donnees['NomCategorie'] ?>
				</br>
						<?php echo$donnees['parcours']; ?>  </td>
						<td > <?php echo $donnees['NbrEtape']; ?>  </td>
						<td>  <?php echo $donnees['Payer']; ?></td>

						<td onClick="ClickRows( event, <?php echo $donnees['ID'] ?>)"> 
							<span  class="ButtonResultat" id="<?php echo "Icons". $donnees['ID']  ?>">
								<i  style="font-size:36px;  margin:2px;"  class="fa fa-edit"></i>
							</span>
							<span style=" visibility: collapse;"   class="ButtonResultat" id="<?php echo "IconsMinus". $donnees['ID']  ?>">
								<i  style=" font-size:36px; margin:5px;"  class="fa fa-minus" ></i>
							</span>
						</td>
						
					</tr>
					
				<tr   style="visibility: collapse" id="<?php echo "Infos".$donnees['ID']  ?>"  style="visibility: collapse">
					<td colspan="8">
						<table>
						
						<tr>
							<td > Date inscription :</td>
							<td> <?php echo $donnees['Date']; ?> </td>
							<td > N° Ordre de paiement :</td>
							<td colspan="2">  <p><?php echo $donnees['OrderPayement']; ?>'  </p> </td>
						</tr>
						<tr>
							<td > Adresse :</td>
							<td><input  ReadOnly type="text" name="adresse"   value =  '<?php echo $donnees['adresse']; ?>' />   </td>>
							<td ><input style="width:30px" type="text" name="npa" value =  '<?php echo $donnees['npa']; ?> '/>   </td>
							<td ><input  type="text" name="localite" value = '<?php echo $donnees['localite']; ?>' />  </td>
						</tr>
						<tr>
							<td > Sexe :</td>
							<td ><input ReadOnly  type="text" name="sexe" value = '<?php echo $donnees['sexe']; ?>' /> </td>
							<td > Année Naissance :</td>
							<td > <input ReadOnly  style="width:35px" type="text" name="date"   value = '<?php echo $donnees['DateNaissance']; ?>' /> </td>
						
						</tr>
						<tr>
							<td > Numéro catégorie :</td>	
							<td>  <input ReadOnly type="text" name="NumCategorie"  value = '<?php echo $donnees['NumCategorie']; ?>'  /> </td>
							<td> Nom départ</td>
							<td>  <input ReadOnly style="width:90px"  type="text" name="NomDepart"  value = '<?php echo $donnees['NomDepart']; ?>'  /> </td>
						</tr>
						<tr>
							<td > e-mail :</td>
							<td colspan="2">  <input  type="text" name="mail"  value =  '<?php echo $donnees['mail']; ?>'  /></td>
						</tr>
						<tr>
							<td > Club</td>
							<td colspan="2"> <input type="text" name="club" value = '<?php echo $donnees['club']; ?>' />  </td>
							<td  onClick="funModification( <?php echo $donnees['ID'] ?>,'club')" >
								<span class="ButtonResultat" >
									 <i   style=" font-size:36px; margin:5px;"  class="fa fa-save"></i>
								</span>							
							</td>
						</tr>
	
						<tr>
							<td>Type Equipe: 0 = Sans / 1 = Equipe / 2 = Duo</td>
							<td colspan="2">   <input  type="text" name="TypeEquipe"  value = '<?php echo $donnees['TypeEquipe']; ?>'  /> </td>
							<td name="lblNomEquipe" > Nom équipe :</td>
							<td name="InputNomEquipe" >   <input  type="text" name="NomEquipe" value = '<?php echo $donnees['NomEquipe']; ?>'  /> </td>
							<td  onClick="funModification( <?php echo $donnees['ID'] ?>,'NomEquipe')" >
								<span class="ButtonResultat" >
									 <i  style=" font-size:36px; margin:5px;"  class="fa fa-save"></i>
								</span>		
								*Valide seulement si la course propose des équipes pour ce départ
							</td>
						</tr>

						<tr>
			
						</tr>
						<tr>
							<td > Prix Souvenir:</td>
							<td colspan="2">   <input  type="text" name="PrixSouvenir" value = '<?php echo $donnees['PrixSouvenir']; ?>'  /> </td>
						</tr>
						<?
						if ( strlen( $donnees['NomDisc1'])>1)
						{
						?>
						<tr >
							<td ><?
								if ( $donnees['JuraDefi'])
								{
									echo "Roller :";
								}
								else
								{
									echo "Coureur 1 :";									
								}?>
							</td>
							<td >  <input  type="text" name="NomDisc1"  value = '<?php echo $donnees['NomDisc1']; ?>'  /> </td>
							<td >  <input  type="text" name="PrenomDisc1"value = '<?php echo $donnees['PrenomDisc1']; ?>'  /> </td>
							<td  onClick="funModification( <?php echo $donnees['ID'] ?>,'Disc1')" >
								<span class="dot2" >
									 <i  style="  margin:5px;"  class="fa fa-edit"></i>
								</span>							
							</td>
						</tr>
						<?
						}
						if ( strlen( $donnees['NomDisc2'])>1)
						{
						?>
						<tr >
							<td> <?
								if ( $donnees['JuraDefi'])
								{
									echo "Course à pied :";
								}
								else
								{
									echo "Coureur 2 :";									
								}?>
							</td>
							<td >  <input  type="text" name="NomDisc2" value = '<?php echo $donnees['NomDisc2']; ?>'  /> </td>
							<td >  <input  type="text" name="PrenomDisc2"  value = '<?php echo $donnees['PrenomDisc2']; ?>'  /> </td>
							<td  onClick="funModification( <?php echo $donnees['ID'] ?>,'Disc2')" >
								<span class="dot2" >
									 <i  style="  margin:5px;"  class="fa fa-edit"></i>
								</span>							
							</td>
						
						</tr>
						<?
						}
						if ( strlen( $donnees['NomDisc3'])>1)
						{
						?>
						<tr >
							<td> 
							<?
								if ( $donnees['JuraDefi'])
								{
									echo "Natation :";
								}
								else
								{
									echo "Coureur 3 :";									
								}?>
							
							</td>
							<td>  <input  type="text" name="NomDisc3" value = '<?php echo $donnees['NomDisc3']; ?>'  /> </td>
							<td>  <input  type="text" name="PrenomDisc3"  value = '<?php echo $donnees['PrenomDisc3']; ?>'  /> </td>
							<td  onClick="funModification( <?php echo $donnees['ID'] ?>,'Disc3')" >
								<span class="dot2" >
									 <i  style="  margin:5px;"  class="fa fa-edit"></i>
								</span>							
							</td>
						</tr>
						<?
						}
						if ( strlen( $donnees['NomDisc4'])>1)
						{
						?>
						<tr  >
							<td > 							<?
								if ( $donnees['JuraDefi'])
								{
									echo "Course de montagne :";
								}
								else
								{
									echo "Coureur 4 :";									
								}?>
							</td>
							<td >  <input  type="text" name="NomDisc4"  value = '<?php echo $donnees['NomDisc4']; ?>'  /> </td>
							<td >  <input  type="text" name="PrenomDisc4"  value = '<?php echo $donnees['PrenomDisc4']; ?>'  /> </td>
							<td  onClick="funModification( <?php echo $donnees['ID'] ?>,'Disc4')" >
								<span class="dot2" >
									 <i  style="  margin:5px;"  class="fa fa-edit"></i>
								</span>							
							</td>
						</tr>
						<?
						}
						if ( strlen( $donnees['NomDisc5'])>1)
						{
						?>
						<tr >
							<td > <?
								if ( $donnees['JuraDefi'])
								{
									echo "Vélo de course";
								}
								else
								{
									echo "Coureur 5 :";									
								}?>
							</td>
							<td >  <input  type="text" name="NomDisc5"  value = '<?php echo $donnees['NomDisc5']; ?>'  /> </td>
							<td>  <input  type="text" name="PrenomDisc5" value = '<?php echo $donnees['PrenomDisc5']; ?>'  /> </td>
							<td  onClick="funModification( <?php echo $donnees['ID'] ?>,'Disc5')" >
								<span class="dot2" >
									 <i  style="  margin:5px;"  class="fa fa-edit"></i>
								</span>							
							</td>
						</tr>
						<?
						}
						if ( strlen( $donnees['NomDisc6'])>1)
						{
						?>
						<tr >
							<td > 
							<?
								if ( $donnees['JuraDefi'])
								{
									echo "VTT";
								}
								else
								{
									echo "Coureur 6:";									
								}?>
							</td>
							<td >  <input  type="text" name="NomDisc6"  value = '<?php echo $donnees['NomDisc6']; ?>'  /> </td>
							<td>  <input  type="text" name="PrenomDisc6"  value = '<?php echo $donnees['PrenomDisc6']; ?>'  /> </td>
							<td  onClick="funModification( <?php echo $donnees['ID'] ?>,'Disc6')" >
								<span class="dot2" >
									 <i  style="  margin:5px;"  class="fa fa-edit"></i>
								</span>							
							</td>
						</tr><?
						}?>
						</table>
					</td>
					</tr>
					<?php
				}?>
				</form>
				<?
			}
	

	?>
			</table>
		</div>

	</br>
		
		</td>
		</table>
		</br>
		
		<?php
	
		}
	}
	else
	{?>
	<i>Veuillez vous connecter </i>  </br></br>
	<?php
	}
	?>

</div>
 
</div>
	<form method="get" id="formDelete" action="DeletePanier.php">
		<input type="text" name="idFormDeletePanier" id="idFormDeletePanier"   value= '' />
	</form>
</body>
</html>
	<!-- Script lors de la validation du paiement !-->
	<script type="text/javascript">
		var PayrexxLink =document.getElementById("IDPayresxx");
			PayrexxLink.classList.add("payrexx-modal-window");
			PayrexxLink.href ="#";
			console.log("CreateButtonPayrexx");
		jQuery(".payrexx-modal-window").payrexxModal({
		hidden: function(transaction) {
			console.log("jquery trans");
			if (transaction.status == "confirmed") // authorized
			{
			//	validCode(); // Ecriture dans la base de donnée que les codes sont utilisé
				location.href =strLinkAccept;
			}
			else if (transaction.status == "refused") // authorized
			{
			//	validCode(); // Ecriture dans la base de donnée que les codes sont utilisé
				location.href =strLinkRefused;
			}
			else
			{
				window.location.reload()
				//location.href =<?php echo json_encode($StrRefused); ?>+ "&StatusPaiement=" + transaction.status.toString();		
			}
			console.log(location.href);
		}
	});
</script>