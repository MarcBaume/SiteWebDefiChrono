<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="../styleV6.css" type="text/css"/>
	 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
	 </script>
	 <script type="text/javascript" src="https://media.payrexx.com/modal/v1/modal.min.js"></script>
 <script src="../js/prototype.js" >

</script>
<script>
var TotalReduction = 0;
var TotalTax = 0;
var TotalInscription= 0;
var ArrayReduction = [];
var Total		= 0;
var LoginLight = "";
var OrderId = "";
var Login = "";	
var linkAccept = "";

function funModification(id,Champ)
	{
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
		
	
		//elmnt = document.getElementById("Modification"+id);
		//elmnt.submit();
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
	
function VerifCode()
{
// Verifie que ce coupon n'est pas utiliser dans ce formulair
var val = 0;
 var inCode = document.getElementById("CodeID");
 var inInfoCode = document.getElementById("InformationCode");
inInfoCode.style.display  = "block" ;
	// Check si réduction déjà utilisé
	for(var id=0; id<ArrayReduction.length; ++id) 
	{
			
		if (inCode.value == ArrayReduction[id].Code)
		{
			val = -20;
		}
	}

	if (val== 0)
	{
	
		// Appelle fonction php pour vérifier que le coupon existe
		$('formCode').request({
		onComplete: function(transport){
			 val =transport.responseText.evalJSON();
			console.log(val);
			// Ajout réduction 
			 if (val > 0)
			 {
				var reduction = new Object();
				reduction.Code =  inCode.value ;
				reduction.Value = val;
				console.log(reduction);
			 // Ajout du coupon de réduction 
				var Table = document.getElementById("TableReduction");
				Table.style.visibility = "visible";
				Table.style.display  = "block" ;
				
				row =	Table.insertRow(-1); // ajout d'une ligne en fin de tableau
				
				var cell0 = row.insertCell(0);
				var cell1 = row.insertCell(1);
				cell0.innerHTML = inCode.value;
				cell1.innerHTML = val; 
				
		    	inInfoCode.style.backgroundColor = "#4df44d";
			 	inInfoCode.innerHTML = "Code ajouté correctement";
				
				var TotalReduc = document.getElementById("TotalReduction");
				TotalReduction = TotalReduction+ parseFloat(reduction.Value);
				TotalReduc.value = TotalReduction;
				ArrayReduction.push(reduction);
				document.getElementById("strCodeReduction").value = document.getElementById("strCodeReduction").value + inCode.value + ";";
				CalculPrixTotal();
				
			 }
			 else if(val == -8 )
			 {
				inInfoCode.style.backgroundColor  = "#ebb64e";
			 		inInfoCode.innerHTML = "ce code n'est plus valide";
			 }
			 else if (val == -7)
			 {
			 inInfoCode.style.backgroundColor  = "#fa8a8a";
			 		inInfoCode.innerHTML = "Code de réduction échue";
			 }
			 else if (val == -5)
			 {
			 inInfoCode.style.backgroundColor = "#fa8a8a";
			 		inInfoCode.innerHTML = "Aucune réduction trouvé";
			 }
			  else if (val == -6)
			 {
			 inInfoCode.style.backgroundColor = "#fa8a8a";
			 		inInfoCode.innerHTML = "Ce code n'est pas valide pour les courses choisies";
			 }
			 else if (val == -15)
			 {
			 inInfoCode.style.backgroundColor = "#fa8a8a";
			 		inInfoCode.innerHTML = "Erreur site web annoncé cette erreur à info@defichrono,ch";
			 }
			  else if (val == -10)
			 {
			 	 inInfoCode.style.backgroundColor = "#fa8a8a";
			 		inInfoCode.innerHTML = "Aucun code saisi";
			 }
			}
		});
	}
	else
	{
		inInfoCode.style.backgroundColor  = "#ebb64e";
		inInfoCode.innerHTML = "Code déjà utilisé";
	}
}
function ValidInscription()
{
//	validCode();
	window.location.href = linkAccept;
}
/*
function validCode()
{
	$('formValidCode').request({
		onComplete: function(transport){
			var val =transport.responseText.evalJSON();
			console.log(val);
			 if(val == -8 )
			 {
				inInfoCode.style.backgroundColor  = "#ebb64e";
			 	inInfoCode.innerHTML = "Ce code n'est plus valide";
			 }
		// Todo si valeur est 1 passe à l'operation suvante autrement aurrêter 
			return val;	 
				
		}
	});
}*/	
function CalculPrixTotal()
{
	var sousTotal =  parseFloat(TotalInscription) - parseFloat(TotalReduction);
	if (sousTotal < 1)
	{
		TotalTax = 0;
		Total = 0;
	}
	else
	{
	
		TotalTax = ((sousTotal /100)*2)  + 1;
		Total = parseFloat(TotalTax) + parseFloat(sousTotal);
	}
	
	if (TotalInscription != null && document.getElementById("idTotalInscription") != null)
	{
	document.getElementById("idTotalInscription").value = TotalInscription ;
	}
	if (TotalTax != null && document.getElementById("PrixTax")!= null)
	{
	document.getElementById("PrixTax").value = TotalTax;
	}
	if (Total != null && document.getElementById("PrixTotal")!= null && document.getElementById("IDPayresxx")!= null)
	{
		//	document.getElementById("TotalReduction").value = TotalReduction;
			document.getElementById("PrixTotal").value = Total ;//Total;



			string1 = "https://defichrono.payrexx.com/fr/vpos?purpose="+OrderId+
			"&amount="+ Total +"&invoice_currency=1&contact_forename="+
			LoginLight +"&contact_email="+ Login;
			

			var ValidLink =document.getElementById("IDValide");
			var PayrexxLink =document.getElementById("IDPayresxx");
			if (Total > 0)
			{
				PayrexxLink.setAttribute('data-href',string1);
				PayrexxLink.classList.add("payrexx-modal-window");
				PayrexxLink.href ="#";
				ValidLink.style.display  = "none" ;
				ValidLink.visibility = "hidden" ;

				PayrexxLink.style.display  = "block" ;
				PayrexxLink.visibility = "visible" ;
			}
			else
			{
				ValidLink.style.display  = "block" ;
				ValidLink.visibility = "visible" ;

				PayrexxLink.style.display  = "none" ;
				PayrexxLink.visibility = "hidden" ;
			}
			console.log(sousTotal);
	}
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
	$name = "2019ChronoMarc$_Test2$";


if ( isset($_SESSION['Login']))
{?>
<script>
	Login = 	<?php echo json_encode($_SESSION["Login"]); ?>;
	</script>
		<?php
	if ( strlen($_SESSION['DateCourse'])> 0  && strlen($_SESSION['Course'])>0)
	{
	?>
	<tr name="PCoureurValid" id="PCoureurValid" style="visibility:hidden;">
		<td>
	<center>
		<form method="get" action="../formulaire2023.php">
			<input type="hidden" name="DateCourse" id="DateCourse"   value= '<?php echo $_SESSION['DateCourse'] ?>' />
			<input type="hidden" name="NomCourse" id="NomCourse"  value= '<?php echo $_SESSION['Course']?>' />
			<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_SESSION['Nbretape'] ?>' />
			<input class="ButtonResultat"  type="submit" value="Ajouter d'autre inscription de  <?php echo $_SESSION['Course'] ?>"  style= "padding: 10px ;height: 60px; font-size:120%"> 
		 </form>
	</center>
		</td>
	</tr>
	<?php
	}
	?>

</br>

	<h3  class="title1"> <?php  echo"Vos inscriptions : ". $_SESSION['Login'] ?> </h3>
	</br> 


	<?php
	$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
	mysqli_select_db($con ,'dxvv_jurachrono' );
	
	// CODE ORDER ID
	$LoginLight =substr($_SESSION['Login'], 0 ,   strpos($_SESSION['Login'], "@") ) ;
	/************************* POUR TEST *****************************/
	$OrderID = $LoginLight. date("YmdHis");
	

	
	?>
	<script>
	var ListCourse =  "";
	LoginLight = <?php echo json_encode( $LoginLight ); ?>;
	OrderId = <?php echo json_encode( $OrderID  ); ?>;
	</script><?
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
		<!--	<a> <b>La société qui gère les paiements est actuellement en maintenance, votre inscription reste en mémoire et lorsque la passerelle de paiement sera de nouveau fonctionnelle, un e-mail vous parviendra</b></br>
			</br>	Défi Chrono s'excuse du dérangement</a> 
			</br>-->
			<p class="title2"> Paiement via internet</p>
			<table> 
				<tr>
					<th width="20%"> Course</th>
					<th width="15%"> Nom</th>
					<th width="15%"> Prénom</th>
					<th width="15%"> Parcours </th>
					<th width="15%">  Catégorie</th>
					<th width="15%">  Option</th>
					<th width="15%">  Prix</th>
					<!--<th width="15%">  Payer</th>-->
				</tr>
				
			<?php
			$Background = 0;
			while($donnees = mysqli_fetch_assoc($result)) 
			{
				if ($donnees['Payer'] == "En Attente" || $donnees['Payer'] == "cancelled"  || $donnees['Payer'] == "declined" || $donnees['Payer'] == "refunded")
				{
					// Modifier les Informations en ajoutant Le Order ID dans la Colonne de la table inscription OrderPayement
					$sql = 'UPDATE inscription SET OrderPayement = \''.$OrderID.'\'  WHERE ID=\''.$donnees["ID"].'\''; 
					if (!mysqli_query($con,$sql))
					{
						echo "Error update : Membres Nom" . mysql_error();
					}  
?>
					<script>
					 TotalInscription = parseInt(TotalInscription) +  parseInt(<?php echo json_encode($donnees['Prix']); ?>) ;
			
					</script><?
				
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

						<td> <?php echo $donnees['course']; ?></td>
						<td> <?php echo $donnees['Nom']; ?></td>
						<td> <?php echo $donnees['Prenom']; ?></td>
						<td><?php echo $donnees['parcours']; ?></td>
						<td><?php echo $donnees['NomCategorie']; ?></td>
						<td><?php echo $donnees['NbrEtape']; ?></td>
						<td><?php echo $donnees['Prix']; ?></td>
					<!--	<td> <?php// echo $donnees ["Payer"] ?></td>-->
						<?php
					if ($donnees['Payer'] !=  "Payé")
					{
					?>
						<form method="post" id="formDelete" action="DeletePanier.php">
							<input type="hidden" name="ID" id="ID"   value= '<?php echo $donnees ["ID"] ?>' />
							<td>
							<a><span> </span><button type ="button" style="float:right; margin :5px;"
							 onclick="document.getElementById('formDelete').submit();">
								<i class="fa fa-trash" style= "font-size: 30px;margin:5px;color: #FF0000;"></i>
							</button></a>
							
							</td>
						</form>
							<?php }?>
						</tr>
						
						<script>
							console.log(0);
							
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
	

	?>
			</table>

<!--	<form id="formCode" method="get" action="VerifCodeReduction.php">
			<input type="hidden" name="Course" id="Course"   value= '<?php //echo $NOM_COURSE. $ANNEE_COURSE ?>' />
			<p style="background-color : #D0D0D0;" ><label for="Code">Code de réduction:</label> <input type="text" name="Code" id="CodeID" tabindex="500"   />	
		   <input type="button" style="height:30px;font-size:80%; width: 120px;"  id="ButtonSend" value="Valider votre code" onclick="VerifCode()" >  </p>
		   <input type="hidden"  name="strListCourse" id="strListCourse" value=""  />  
			<p id="InformationCode" style="display:none; padding:5px; border-style: solid; border-color: black; font-size:160%;"></p>	
	 
	</form>	-->
	<script>
		// Ecriture dans l'entrée de la chaine serializer des courses
	//	document.getElementById("strListCourse").value  = ListCourse;
				CalculPrixTotal();
	</script>
<!--	<form id="formValidCode" method="get" action="ValidCodeReduction.php">
		<input type="hidden" name="Login" id="Login"   value= '<?php echo $_SESSION['Login'] ?>' />
		<input type="hidden" name="OrderID" id="OrderID"   value= '<?php echo $OrderID  ?>' />
		<!-- lit de tous les code de réduction utiliser sérialiser 
		<input type="hidden"  name="strCodeReduction" id="strCodeReduction" value=""  />  
	   

	</form>	
	<Table style="background-color : #FFFFFF; visibility:hidden; display:none" id="TableReduction">
		<tr>
			<th>
				Code de réduction
			</th>
			<th>
				Valeurs CHF
			</th>
		<tr>
		
		
	</table>-->	
</br>
</br>
		<div id="prix">		

			<p><label for="">Prix total inscription</label> <input type="text"  name="idTotalInscription" id="idTotalInscription" tabindex="10"  readonly  >CHF</p>
		<!--	<p><label for="nom">Total Réduction:</label> <input type="text" name="TotalReduction" id="TotalReduction"  readonly  />CHF</p>
  		-->
		<p><label for="">Frais de traitement 1CHF + 2%</label> <input type="text"  name="PrixTax" id="PrixTax" tabindex="10"  readonly  />CHF</p>
	
		<p><label for="">Total</label> <input type="text"  name="PrixTotal" id="PrixTotal" tabindex="10"  readonly  />CHF</p>
		<script>
CalculPrixTotal();
		</script>
		<?php
			$PrixTotal = $PrixTotal + $PrixTax;
			$PrixForm = $PrixTotal  *1;
			 /************************* POUR TEST *****************************/
		
			
		//	$LoginLight2 = "Baume";
		//	$string1 = "https://defichrono.payrexx.com/pay?tid=".$OrderID."&invoice_number=".$OrderID."&invoice_amount=".  $PrixForm ."&invoice_currency=1&contact_forename=". $LoginLight ."&contact_surname=". $LoginLight2."&contact_email". $_SESSION["Login"];
		 ?>
		<table  >
			<tr>
				<td style="width:25%"></td>
				<td style="display:none;  height:50px;text-align: center;vertical-align: middle;" id="IDValide" >
					<a  class="ButtonResultat"  style="cursor: pointer; Padding:10px ;color:black;  font-size:24px; text-decoration:none;" onclick="ValidInscription()" >
					<u  style="text-decoration:none;"
					>	Valider mes inscriptions </u>
					</a>
				</td>
				<td id="IDPayresxx" style="background:#00b4ff; height:50px;text-align: center;vertical-align: middle;">
					<a style="cursor: pointer; Padding:10px ;color:black; display:block;font-size:24px; text-decoration:none;" >
						Payer mes inscriptions
					</a>
				</td>
				<td style="width:25%"></td>
			</tr>
		</table>
		
			<?php	$StrAccept =   "https://juradefichrono.ch/admin/PaiementAccepted.php?Login=". $_SESSION["Login"]."&ID=".$OrderID?>
			<?php	$StrRefused =  "https://juradefichrono.ch/admin/PaiementDecliened.php?Login=". $_SESSION["Login"]."&ID=".$OrderID ?>
			
		<!-- Script lors de la validation du paiement !-->
		<script type="text/javascript">
			linkAccept = <?php echo json_encode($StrAccept); ?>;
			CalculPrixTotal();
				
			jQuery(".payrexx-modal-window").payrexxModal({
			hidden: function(transaction) {
				if (transaction.status == "confirmed") // authorized
				{
				//	validCode(); // Ecriture dans la base de donnée que les codes sont utilisé
					location.href =<?php echo json_encode($StrAccept); ?>;
				}
				else
				{
					
					location.href =<?php echo json_encode($StrRefused); ?>+ "&StatusPaiement=" + transaction.status.toString();		
				}
			}
		});
		
		
		function SubmitForm(f)
		{
			f.submit();
		}
		</script>
	</br>
		
		</td>
		</table>
		</br>
		<a style="font-size : 14px;">
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
					<form method="post" id="formDelete" action="DeletePanier.php">
						<input type="hidden" name="ID" id="ID"   value= '<?php echo $donnees ["ID"] ?>' />
						<td>
						<?php if ($donnees ["Payer"] != 'Payé')
						{?>
							<span class="dot" onclick="document.getElementById('formDelete').submit();">
								<i class="fa fa-trash" style= "font-size: 20px;margin: 6px;color: #FF0000;"></i>
							</span>
							<?
						}?>
		
						
						</td>
					</form>
						<?php }?>
					</tr>
					<?php
				
			}
	

	?>
			</table>

		<script>
		
		function SubmitForm(f)
		{
			f.submit();
		}
		</script>
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
					
		<p class="title2">Inscriptions effectuées </p>
			<!-- >Formulaire envoyer lors de la modification des insription -->
				<form method="get" action="modification_inscriptionUser.php" name = 'formModif'  id='formModif' >		
				<input type="hidden" name='ChampModification' id= 'ChampModification'  />
				<input type="hidden" name='ValueModification' id= 'ValueModification'  />
				<input type="hidden" name ='IDModification'id= 'IDModification'  />
				</form>
			<table> 
				<tr>
					<th></th>
					<th width="20%"> Course</th>
					<th width="15%"> Nom</th>
					<th width="15%"> Prénom</th>
					<th width="15%"> Parcours </th>
					<th width="15%">  Catégorie</th>
					<th width="15%">  Option</th>
					<th width="15%">  Payer</th>
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
						<td onClick="ClickRows( event, <?php echo $donnees['ID'] ?>)"> 
							<span class="dot2" id="<?php echo "Icons". $donnees['ID']  ?>">
								<i  style="  margin:5px;"  class="fa fa-plus"></i>
							</span>
							<span style=" visibility: collapse;"  class="dot2" id="<?php echo "IconsMinus". $donnees['ID']  ?>">
								<i  style="  margin:5px;"  class="fa fa-minus" ></i>
							</span>
						</td>
						<td> <?php echo $donnees['course']; ?></td>
						<td > <?php echo  $donnees['Nom']; ?></td>
						<td>  <?php echo $donnees['Prenom']; ?>    </td>
						<td>  <?php echo $donnees['NomCategorie']; ?></td>
						<td > <?php echo $donnees['parcours']; ?>  </td>
						<td > <?php echo $donnees['NbrEtape']; ?>  </td>

						<td>  <?php echo $donnees['Payer']; ?></td>
					
						
					</tr>
					
				<tr   style="visibility: collapse" id="<?php echo "Infos".$donnees['ID']  ?>"  style="visibility: collapse">
					<td colspan="8">
						<table>
						
						<tr>
							<td > Date inscription :</td>
							<td> <?php echo $donnees['Date']; ?> </td>
						</tr>
						<tr>
							<td > Adresse :</td>
							<td><input  ReadOnly type="text" name="adresse" id="adresse" tabindex="12" value =  '<?php echo $donnees['adresse']; ?>' />   </td>
						</tr>
						<tr>
							<td> NPA / Localité :</td>
							<td ><input style="width:30px" type="text" name="npa" id="npa" tabindex="13" value =  '<?php echo $donnees['npa']; ?> '/>   </td>
							<td ><input  type="text" name="localite" id="localie" tabindex="14" value = '<?php echo $donnees['localite']; ?>' />  </td>
						</tr>
						<tr>
							<td > Sexe :</td>
								<td > <input ReadOnly  type="text" name="sexe" id="sexe" tabindex="16" value = '<?php echo $donnees['sexe']; ?>' /> </td>
						</tr>	
						<tr>
							<td > Année Naissance :</td>
							<td > <input ReadOnly  style="width:35px" type="text" name="date" id="date" tabindex="15"  value = '<?php echo $donnees['DateNaissance']; ?>' /> </td>
						
						</tr>
						<tr>
							<td > Numéro catégorie :</td>	
							<td>  <input ReadOnly type="text" name="NumCategorie" id="NumCategorie" tabindex="18" value = '<?php echo $donnees['NumCategorie']; ?>'  /> </td>
						</tr>
						<tr>
							<td > e-mail :</td>
							<td colspan="2">  <input  type="text" name="mail" id="mail" tabindex="19" value =  '<?php echo $donnees['mail']; ?>'  /></td>
						</tr>
						<tr>
							<td> Nom départ</td>
							<td>  <input ReadOnly style="width:90px"  type="text" name="NomDepart" id="NomDepart" tabindex="21" value = '<?php echo $donnees['NomDepart']; ?>'  /> </td>
						</tr>
						<tr>
							<td > Club</td>
							<td colspan="2"> <input type="text" name="club" id="<?php  echo 'club'.$donnees['ID'] ?>" tabindex="17" value = '<?php echo $donnees['club']; ?>' />  </td>
							<td  onClick="funModification( <?php echo $donnees['ID'] ?>,'club')" >
								<span class="dot2" >
									 <i  style="  margin:5px;"  class="fa fa-edit"></i>
								</span>							
							</td>
						</tr>
						<tr>
							<td > N° Ordre de paiement :</td>
							<td colspan="2">  <p><?php echo $donnees['OrderPayement']; ?>'  </p> </td>
						</tr>
						<tr>
							<td > Nom équipe :</td>
							<td colspan="2" >   <input  type="text" name="NomEquipe" id="<?php  echo 'NomEquipe'.$donnees['ID'] ?>" tabindex="21" value = '<?php echo $donnees['NomEquipe']; ?>'  /> </td>
							<td  onClick="funModification( <?php echo $donnees['ID'] ?>,'NomEquipe')" >
								<span class="dot2" >
									 <i  style="  margin:5px;"  class="fa fa-edit"></i>
								</span>		
								*Valide seulement si la course propose des équipes pour ce départ
							</td>
						
						</tr>

						<tr>
							<td>Type Equipe: 0 Sans / 1 : Equipe / 2: Duo</td>
							<td colspan="2">   <input  type="text" name="TypeEquipe" id="TypeEquipe" tabindex="21" value = '<?php echo $donnees['TypeEquipe']; ?>'  /> </td>
						</tr>
						<tr>
							<td > Prix Souvenir:</td>
							<td colspan="2">   <input  type="text" name="PrixSouvenir" id="PrixSouvenir" tabindex="21" value = '<?php echo $donnees['PrixSouvenir']; ?>'  /> </td>
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
							<td >  <input  type="text" name="NomDisc1" id="<?php  echo 'NomDisc1'.$donnees['ID'] ?>" tabindex="21" value = '<?php echo $donnees['NomDisc1']; ?>'  /> </td>
							<td >  <input  type="text" name="PrenomDisc1" id="<?php  echo 'PrenomDisc1'.$donnees['ID'] ?>" tabindex="21" value = '<?php echo $donnees['PrenomDisc1']; ?>'  /> </td>
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
							<td >  <input  type="text" name="NomDisc2" id="<?php  echo 'NomDisc2'.$donnees['ID'] ?>" tabindex="21" value = '<?php echo $donnees['NomDisc2']; ?>'  /> </td>
							<td >  <input  type="text" name="PrenomDisc2" id="<?php  echo 'PrenomDisc2'.$donnees['ID'] ?>" tabindex="21" value = '<?php echo $donnees['PrenomDisc2']; ?>'  /> </td>
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
							<td>  <input  type="text" name="NomDisc3" id="<?php  echo 'NomDisc3'.$donnees['ID'] ?>" tabindex="21" value = '<?php echo $donnees['NomDisc3']; ?>'  /> </td>
							<td>  <input  type="text" name="PrenomDisc3" id="<?php  echo 'PrenomDisc3'.$donnees['ID'] ?>" tabindex="21" value = '<?php echo $donnees['PrenomDisc3']; ?>'  /> </td>
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
							<td >  <input  type="text" name="NomDisc4" id="<?php  echo 'NomDisc4'.$donnees['ID'] ?>" tabindex="21" value = '<?php echo $donnees['NomDisc4']; ?>'  /> </td>
							<td >  <input  type="text" name="PrenomDisc4" id="<?php  echo 'PrenomDisc4'.$donnees['ID'] ?>" tabindex="21" value = '<?php echo $donnees['PrenomDisc4']; ?>'  /> </td>
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
							<td >  <input  type="text" name="NomDisc5" id="<?php  echo 'NomDisc5'.$donnees['ID'] ?>" tabindex="21" value = '<?php echo $donnees['NomDisc5']; ?>'  /> </td>
							<td>  <input  type="text" name="PrenomDisc5" id="<?php  echo 'PrenomDisc5'.$donnees['ID'] ?>" tabindex="21" value = '<?php echo $donnees['PrenomDisc5']; ?>'  /> </td>
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
							<td >  <input  type="text" name="NomDisc6" id="<?php  echo 'NomDisc6'.$donnees['ID'] ?>" tabindex="21" value = '<?php echo $donnees['NomDisc6']; ?>'  /> </td>
							<td>  <input  type="text" name="PrenomDisc6" id="<?php  echo 'PrenomDisc6'.$donnees['ID'] ?>" tabindex="21" value = '<?php echo $donnees['PrenomDisc6']; ?>'  /> </td>
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

		<script>
		
		function SubmitForm(f)
		{
			f.submit();
		}
		</script>
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

</body>
</html>
