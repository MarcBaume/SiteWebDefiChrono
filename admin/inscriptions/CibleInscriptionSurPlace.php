<!DOCTYPE html>
<html>
<head>
<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="../styleV2.css" type="text/css"/>
	 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
	 </script>
	 <script type="text/javascript" src="https://media.payrexx.com/modal/v1/modal.min.js"></script>
 <script src="../../js/prototype.js" >
</script>
<body>
<form method="get" action="addInscriptionSurPlaceMysql.php" id="ValueCourse" name="ValueCourse" >
<!-- Tableau information de la course !-->

	<input type="text" name="idCoureur" id="idCoureur" />
	<input type="text" name="DateCourse" id="DateCourse"   value= '<?php echo $_GET['DateCourse'] ?>' />
	<input type="text" name="NomCourse" id="NomCourse"  value= '<?php echo $_GET["NomCourse"] ?>' />
	<input type="text" name="NumCat" id="NumCat" />
	<input type="text" name="NomCat" id="NomCat" />
	<input type="text" name="NomDepart" id="NomDepart" />
	<input type="text" name="NomParcours" id="NomParcours" />
	<input type="text" name="OnLine" id="OnLine" />
	<input type="text" name="Option" id="Option" />
	<input type="text" name="LastAdresse" id="LastAdresse" />
	<input type="text" name="Nbretape" id="Nbretape" value= '<?php echo  $_GET["NbrEtape"] ?>' />

	<table  >

		<tr style="background :gray;"><td >Nom</td> <td><input type="text" name="nom" id="nom" tabindex="10" style="width:80%;margin:10px"/></td></tr>
		<tr style="background :gray;"><td >Prénom</td> <td> <input  type="text" name="prenom" id="prenom" tabindex="20" style="width:80%;margin:10px"/></td></tr>
		<tr style="background :gray;"><td  >Adresse e-mail</td>  <td> <input type="text" name="email" id="email" tabindex="40" style="width:80%;margin:10px"/></td></tr>
		<tr style="background :gray;"><td  >Adresse</td> <td>  <input type="text" name="adresse" id="adresse" tabindex="50" style="width:80%;margin:10px"/></td></tr>
		<tr style="padding: 10px; background :gray;"><td >NPA</td>  <td> <input type="text" name="zip" id="zip" tabindex="60" style="width:80%;margin:10px"/></td></tr>
		<tr style="padding: 10px; background :gray;"><td >Localité</td>  <td> <input type="text" name="ville" id="ville"tabindex="70" style="width:80%;margin:10px" /></td></tr>
		<tr style="padding: 10px; background :gray;"><td  >Pays</td>   <td> <input type="text" name="pays" id="pays"tabindex="80" style="width:80%;margin:10px"/></td></tr>	
		<tr style="padding: 10px; background :gray;"><td  >Année de Naissance</td> <td><input type="text" name="dateNaissance" 	id="dateNaissance" tabindex="90" style="width:80%;margin:10px"  /><td></tr>
		<tr style="padding: 10px; background :gray;"><td  >sexe</td> <td><input type="text" name="sexe" 	id="sexe" tabindex="90" style="width:80%;margin:10px"  /><td></tr>
		<tr style="padding: 10px; background :gray;"><td  for="club">Club</td><td> <input type="text" name="club" id="club"tabindex="100" style="width:80%;margin:10px"/></td></tr>
							
	
						
	</table>
					
</form>
</body>
<?php 


// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
// Selecting Database
mysqli_select_db($con ,'dxvv_jurachrono' );
	
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
?>
<script>
var ArCourreur = [] ;
	for (var i = 0; i < localStorage.length; i++)
	{
		IndexCoureur = localStorage.key(i);
		// Transfrome clé en objet 
		newObject = localStorage.getItem(IndexCoureur);
		//console.log(newObject);
		 var Coureur = JSON.parse(newObject);
		//console.log(ReadCoureur);
	
	// Mise des valeurs javascript dans formulaire
			document.getElementById("nom").value =Coureur.nom ;
			document.getElementById("prenom").value = Coureur.prenom ;
			document.getElementById("email").value = Coureur.email ;
			document.getElementById("adresse").value = Coureur.adresse ;
			document.getElementById("zip").value = Coureur.zip  ;
			document.getElementById("ville").value = Coureur.ville ;
			document.getElementById("club").value = Coureur.Club ;
			document.getElementById("pays").value =  Coureur.Pays ;
			document.getElementById("dateNaissance").value = Coureur.date ;
			document.getElementById("sexe").value = Coureur.sexe ;
			document.getElementById("NomDepart").value = Coureur.NomDepart ;
			document.getElementById("NomParcours").value = Coureur.NomParcours ;
			document.getElementById("NomCat").value = Coureur.NomCat ;
			document.getElementById("NumCat").value = Coureur.NumCat;

			ArCourreur.push(Coureur);
			console.log(Coureur);
			document.getElementById("ValueCourse").action ="addInscriptionSurPlaceMysql.php" ;
			$('ValueCourse').request({
				onComplete: function(transport){
					 val =transport.responseText.evalJSON();

					console.log(val);
				
				}
			});
			localStorage.clear();
			document.getElementById("ValueCourse").action ="endInscriptionSurPlace.php" ;
			document.getElementById("ValueCourse").submit();
	}
</script>

</body>
</html>
