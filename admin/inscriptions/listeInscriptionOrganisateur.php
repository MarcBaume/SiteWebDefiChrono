<!DOCTYPE html>
<html>
<head>
<meta http-equiv="cache-control" content="no-cache"> <!-- tells browser not to cache -->
<meta http-equiv="expires" content="0"> <!-- says that the cache expires 'now' -->
<meta http-equiv="pragma" content="no-cache"> <!-- says not to use cached stuff, if there is any -->

	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<metahttp-equiv = 'cache-control' content = 'no-cache'>
<metahttp-equiv = 'expires' content = '0'>
<metahttp-equiv = 'pragma' content = 'no-cache'>
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="../../styleV6.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
	 </script>
<script src="../../js/prototype.js" ></script>
<script src="../../js/FonctionDefiChrono2.js?v=1"></script>
</script>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>

    <body>
	<?	include("MenuInscriptions.php"); ?>
	<div id="corps">


<table>
	<tr>
		<td>
			<h3>
				Liste de départ  <?php  echo $NOM_COURSE. ' ' . $ANNEE_COURSE ?>
			</h3>
		</td>
		<td>

				<Form  method="post" action="ExportMysql.php">
						<input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $DateCourse ?>' />
						<input type="hidden" name="etape" id="etape" value= '<?php echo $_POST["etape"] ?>' />
						<input type="hidden" name="NomCourse" id="NomCourse" tabindex="10"  size="60"  value= '<?php echo $NOM_COURSE ?>' />		
				<center>
						<input type="submit" class="ButtonResultat" value="Export Excel">
				</center>
					
				</form>

		</td>
	</tr>
</table>

 </br> 



  <div  id="TableauResulat">
	<p>
  <input Type="text"  style="font-size:24px" name="FindValue" id="FindValue" onchange="SearchCoureur()" />
  <button type="button" class="ButtonResultat" onclick="SearchCoureur()">	<i class='fa fa-search' ></i></button>
</p>
 <form method="get" id="FormListCoureur" name="FormListCoureur" action="liste.php">
 <input type="hidden" name="Find" id="Find"  size="60"  />

 <input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $DateCourse?>' />
<input type="hidden" name="NomCourse" id="NomCourse"  size="60"  value= '<?php echo $NOM_COURSE ?>' />
<input type="hidden" name="IDCoureur" id="IDCoureur"  />
</form>
 <?php
$row = 1;
$start_array = false;
$numetape = intval($_GET['etape']);
// Afficher la liste des départ Dossier dans la course ;
$pathfolder = 'courses/'.$NOM_COURSE.$ANNEE_COURSE;
?>

<Table id ="TableListCoureurs">
</table>
 </div>
 </body>

</html>
<Script>
function SearchCoureur() {

	table1 = document.getElementById("TableListCoureurs");

	table1.innerHTML = ""
	RowHeader = document.createElement('tr');
	table1.append(RowHeader);

	ColHeader = document.createElement('th');
	ColHeader.innerHTML = "N°"
	RowHeader.append(ColHeader);

	ColHeader = document.createElement('th');
	ColHeader.innerHTML = "Nom"
	RowHeader.append(ColHeader);

	ColHeader = document.createElement('th');
	ColHeader.innerHTML = "Prénom"
	RowHeader.append(ColHeader);

	ColHeader = document.createElement('th');
	ColHeader.innerHTML = "Année"
	RowHeader.append(ColHeader);

	ColHeader = document.createElement('th');
	ColHeader.innerHTML = "Localité"
	RowHeader.append(ColHeader);

	ColHeader = document.createElement('th');
	ColHeader.innerHTML = "Parcours"
	RowHeader.append(ColHeader);

	ColHeader = document.createElement('th');
	ColHeader.innerHTML = "Depart"
	RowHeader.append(ColHeader);

	ColHeader = document.createElement('th');
	ColHeader.innerHTML = "Paiement"
	RowHeader.append(ColHeader);

	// Trasnfert de valeur pour eviter l'événement enter du clavier
	document.getElementById("Find").value = document.getElementById("FindValue").value ;

	FormValue = document.getElementById("FormListCoureur");
	FormValue.action="ReadInscriptionMysql.php"

	console.log(FormValue);

	$('FormListCoureur').request({
			onComplete: function(transport){
				 val =transport.responseText.evalJSON();

				 console.log(val);
		        for (var j = 0; j < val.length ;j++) 
				{
				
					var Coureur = new Object();
					 Coureur = val[j];

					RowsCoureur = document.createElement('tr');
					RowsCoureur.style.background ="white";

					RowsCoureur.dataset.value = Coureur.ID ;
					RowsCoureur.addEventListener("click", function() { SelectCoureur(this.dataset.value); } );
					table1.append(RowsCoureur);

					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "24px";
					col1.innerHTML = Coureur.NumDossard;
					RowsCoureur.append(col1);


					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "24px";
					col1.innerHTML = Coureur.Nom;
					RowsCoureur.append(col1);

					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "24px";
					col1.innerHTML = Coureur.Prenom;
					RowsCoureur.append(col1);

					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "12px";
					col1.innerHTML = Coureur.DateNaissance;
					RowsCoureur.append(col1);
					
					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "12px";
					col1.innerHTML = Coureur.localite;
					RowsCoureur.append(col1);

					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "12px";
					col1.innerHTML = Coureur.parcours;
					RowsCoureur.append(col1);

					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "12px";
					col1.innerHTML = Coureur.NomDepart;
					RowsCoureur.append(col1);

					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "12px";
					col1.innerHTML = Coureur.Payer;
					RowsCoureur.append(col1);
			


					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "12px";
					col1.dataset.value = Coureur.ID ;
					
					col1.innerHTML ='	<i  style="font-size:24px;  margin:0px;"  class="fa fa-edit"></i>	';
					col1.addEventListener("click", function() { SelectCoureur(this.dataset.value); } );
					RowsCoureur.append(col1);

					
					col1 = document.createElement('td');
					col1.style.color = "white";
					col1.style.fontSize = "12px";
					col1.dataset.value = Coureur.ID ;

		
				};
			
				}
});
}

function SelectCoureur(e) {
	

	document.getElementById("IDCoureur").value = e;
	FormValue = document.getElementById("FormListCoureur");
	FormValue.action="formulaireInscriptionAdmin.php"
	FormValue.submit();
}



    const textInput = document.getElementById('Find');
    textInput.addEventListener('keydown', (event) => {
      if (event.key === 'Enter') {
		SearchCoureur();
        // Perform desired actions here
      }
    });
	


	
SearchCoureur();
</script>

 



