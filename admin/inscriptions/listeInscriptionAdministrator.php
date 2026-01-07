<!DOCTYPE html>
<html>

<?	include("MenuInscriptions.php");
?>
    <body>
       	 <!--- Couverture --->
			<Form  method="post" action="ExportMysql.php">
		<input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $_POST["DateCourse"] ?>' />
		<input type="hidden" name="etape" id="etape" value= '<?php echo $_POST["etape"] ?>' />
		<input type="hidden" name="NomCourse" id="NomCourse" tabindex="10"  size="60"  value= '<?php echo $_POST["NomCourse"] ?>' />		
		<input type="submit" value="Export Excel">
	</form>
    <body >

	 <h3>
Liste de départ  administrateur
   </h3>

 </br> 
  <div  id="TableauResulat">
 <form method="get" id="FormListCoureur" name="FormListCoureur">
<input Type="text"  style="font-size:24px" name="Find" id="Find" onchange="SearchCoureur()"/>
<button type="button" class="ButtonResultat" onclick="SearchCoureur()">	<i class='fa fa-search' ></i></button>
 <input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $DateCourse?>' />
<input type="hidden" name="NomCourse" id="NomCourse"  size="60"  value= '<?php echo $NOM_COURSE ?>' />
<input type="hidden" name="IDCoureur" id="IDCoureur"  />
<button type="submit">Submit</button>
</form>
 <?php
$row = 1;
$start_array = false;
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
	ColHeader.innerHTML = "Nom"
	RowHeader.append(ColHeader);

	ColHeader = document.createElement('th');
	ColHeader.innerHTML = "Année"
	RowHeader.append(ColHeader);

	ColHeader = document.createElement('th');
	ColHeader.innerHTML = "Parcours"
	RowHeader.append(ColHeader);

	ColHeader = document.createElement('th');
	ColHeader.innerHTML = "Depart"
	RowHeader.append(ColHeader);

    ColHeader = document.createElement('th');
	ColHeader.innerHTML = "Login"
	RowHeader.append(ColHeader);

	ColHeader = document.createElement('th');
	ColHeader.innerHTML = "Paiement"
	RowHeader.append(ColHeader);

	FormValue = document.getElementById("FormListCoureur");
	FormValue.action="ReadInscriptionMysqlAdministrator.php"

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
			
					RowsCoureur.dataset.value = Coureur.ID ;
				
					table1.append(RowsCoureur);

					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "24px";
					col1.innerHTML = Coureur.Nom+ " "+ Coureur.Prenom;
					RowsCoureur.append(col1);

					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "12px";
					col1.innerHTML = Coureur.DateNaissance;
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
					col1.innerHTML = Coureur.Login;
					RowsCoureur.append(col1);

					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "12px";
                    if (Coureur.Payer != "Payé")
                    {
                        col1.style.background = "Orange";
                    }
                    
					col1.innerHTML = Coureur.Payer;
					RowsCoureur.append(col1);
			
					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "12px";
                    col1.dataset.value = Coureur.ID ;
                    col1.innerHTML ='	<i  style="font-size:24px;  margin:0px;"  class="fa fa-check"></i>	';
                    col1.addEventListener("click", function() { changPaiementPayer(this.dataset.value); } );
					RowsCoureur.append(col1);
	
                    col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "12px";
                    col1.dataset.value = Coureur.ID ;
                    col1.innerHTML ='	<i  style="font-size:24px;  margin:0px;"  class="fa fa-spinner"></i>	';
                    col1.addEventListener("click", function() { changPaiementEnAttente(this.dataset.value); } );
					RowsCoureur.append(col1);

					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "12px";
					col1.dataset.value = Coureur.ID ;
					col1.innerHTML ='	<i  style="font-size:24px;  margin:0px;"  class="fa fa-edit"></i>	';
					col1.addEventListener("click", function() { SelectCoureur(this.dataset.value); } );
					RowsCoureur.append(col1);


				
		
				};
			
				}
});
}
function changPaiementPayer(e) {
	
    var FormCoureur =document.getElementById("FormListCoureur");
	document.getElementById("IDCoureur").value = e;

// Check si dossard déjà existant
FormCoureur.action="CibleUpdatePaimentCoureurValide.php";



	$('FormListCoureur').request({
			onComplete: function(transport){

				 val =transport.responseText.evalJSON();
                 console.log(val);
				if (val== 1 )
				{
                    SearchCoureur();

				}
				
			}
		});
}

function changPaiementEnAttente(e) {
	
    var FormCoureur =document.getElementById("FormListCoureur");
	document.getElementById("IDCoureur").value = e;

// Check si dossard déjà existant
FormCoureur.action="CibleUpdatePaimentCoureurEnAttente.php";



	$('FormListCoureur').request({
			onComplete: function(transport){

				 val =transport.responseText.evalJSON();
                 console.log(val);
				if (val== 1 )
				{
                    SearchCoureur();

				}
				
			}
		});
}

function SelectCoureur(e) {
	

	document.getElementById("IDCoureur").value = e;
/*	FormValue = document.getElementById("FormListCoureur");
	FormValue.action="formulaireInscriptionAdmin.php"
	FormValue.submit();*/
}

function DeleteCoureur(e) {
	

}

	
SearchCoureur();
</script>

 



