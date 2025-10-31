<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
			<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik">
	
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="../css/style.css" type="text/css"/>
	 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
	 </script>
	 <script type="text/javascript" src="https://media.payrexx.com/modal/v1/modal.min.js"></script>
 <script src="../js/prototype.js" >

</script>
<script>

var LoginLight = "";
var OrderId = "";
var Login = "";	
var linkAccept = "";
var ArrayCoureurs = [];

// Function sélection de coureur
function SelectCoureur(CoureurSelected)
{

	let DivResultat = document.getElementById('divResultats');
	DivResultat.innerHTML ="";
	/* Div Coureur */
	let CoureurPara  = document.getElementById('divCourse');
	CoureurPara.innerHTML = "";
	/* Titre Para */
	let TitlePara  = document.createElement('h3');
	TitlePara.innerHTML = '<i class="fa fa-user" style= "font-size: 42px;margin:9px;"></i>Résultats de ' + CoureurSelected.Nom + " " + CoureurSelected.Prenom; 
	CoureurPara.append(TitlePara);


	/* Liste des  Courses du coureurs */
	for (m = 0; m < CoureurSelected.ArrayCourse.length; m++) 
	{
		let SpanCourse  = document.createElement('span');
		SpanCourse.classList.add("dotMemberV2");
		SpanCourse.id = 'ButtonCourse' +m;
		CoureurPara.append(SpanCourse);
		let ParaCourse  = document.createElement('a');
		SpanCourse.append(ParaCourse);
		ParaCourse.style.fontSize = "80%"
		ParaCourse.innerHTML ='<i class="fa fa-trophy" style= "font-size: 42px;margin:9px;color: #4095f5;"></i>'+ CoureurSelected.ArrayCourse[m].Nom;
		SpanCourse.dataset.value = m;	
		SpanCourse.addEventListener("click", function() { SelectCourseCoureur(CoureurSelected.ArrayCourse[this.dataset.value],this.dataset.value,CoureurSelected.ArrayCourse.length); } );

	}
}

function SelectCourseCoureur(CourseSelected,m,LenArray)
{
	
	   // remise au couleur de base 
	   for (let i = 0; i <LenArray; i++) 
        {
			document.getElementById("ButtonCourse"+i).classList.remove("dotMemberV2Selected");
			document.getElementById("ButtonCourse"+i).classList.add("dotMemberV2");		
        }

	document.getElementById('ButtonCourse'+m).classList.add("dotMemberV2Selected");	

	     


	let DivResultats = document.getElementById('divResultats');
	DivResultats.innerHTML ="";
	DivResultats.style.width = "80%"; 

	let TableResultats = document.createElement('table');
	TableResultats.innerHTML ="";
	TableResultats.style.width = "80%"; 
	DivResultats.append(TableResultats);

	for (l = 0; l < CourseSelected.ArrayAnnee.length; l++) 
	{
			let RowTitleTableCourse  = document.createElement('tr');
			
			let ColAnnee = document.createElement('td');
			ColAnnee.innerHTML = CourseSelected.ArrayAnnee[l].Nom;		
			ColAnnee.style.textAlign= "center";		
			ColAnnee.style.fontWeight= "bold";		
			ColAnnee.style.fontSize= "24px";	
			RowTitleTableCourse.append(ColAnnee );
			TableResultats.append(RowTitleTableCourse);
			
			// Colonne étape
			let ColEtape = document.createElement('td');
			let TableEtape  = document.createElement('table');
			TableEtape.style.width = "100%"; 
			ColEtape.append(TableEtape);
			RowTitleTableCourse.append(ColEtape);
			
			for (y = 0; y < CourseSelected.ArrayAnnee[l].ArrayEtape.length; y++) 
			{
		
				
				// Première étape de la l'édition 
				if (y==0 && CourseSelected.ArrayAnnee[l].ArrayEtape.length >1)
				{
					let RowTitleEtape  = document.createElement('tr');
					let ColTitleEtape = document.createElement('th');
						ColTitleEtape.innerHTML = "Etape";
						RowTitleEtape.append(ColTitleEtape);
						
					let ColTitleTableResultat = document.createElement('th');
						ColTitleTableResultat.innerHTML = "";
						RowTitleEtape.append(ColTitleTableResultat);
						TableEtape.append(RowTitleEtape);
				}
				
				// Nouvelle ligne par étape
				let RowEtape  = document.createElement('tr');

				// Changement de couleur chaque ligne
				if ((y % 2)>0)
				{
				RowEtape.style.backgroundColor = "LightBlue";
				}
				else
				{
					RowEtape.style.backgroundColor = "LightGray";
				}
				TableEtape.append(RowEtape);
				
				// Colonne Titre etape 
				if ( CourseSelected.ArrayAnnee[l].ArrayEtape.length >1)
				{
					let ColEtape = document.createElement('td');
					ColEtape.style.padding = "10px";
					ColEtape.innerHTML = "<b style='Font-size:24px'>"+ CourseSelected.ArrayAnnee[l].ArrayEtape[y].Nom + "</b> : " + CourseSelected.ArrayAnnee[l].ArrayEtape[y].ArrayResultat[0].Lieu +"</br></br>"+CourseSelected.ArrayAnnee[l].ArrayEtape[y].ArrayResultat[0].Distance + " "+ CourseSelected.ArrayAnnee[l].ArrayEtape[y].ArrayResultat[0].Denivele;;					
					RowEtape.append(ColEtape );
				}

			
				// Colonne tableau Résultat
				let ColResultat = document.createElement('td');
				RowEtape.append(ColResultat);
				
				let TableResultat  = document.createElement('table');
				ColResultat.append(TableResultat);
				
				
				for (j = 0; j <CourseSelected.ArrayAnnee[l].ArrayEtape[y].ArrayResultat.length; j++) 
				{
					
					let RowResultat  = document.createElement('tr');
					/* Si premier résultat*/
					if (j==0)
					{
						

						ColTable = document.createElement('th');
						ColTable.style.textAlign= "left";
						ColTable.style.textDecoration="underline" ;
						ColTable.innerHTML = "Place";
						RowResultat.append(ColTable);
						
						ColTable = document.createElement('th');
						ColTable.style.textAlign= "left";
						ColTable.style.textDecoration="underline" ;
						ColTable.innerHTML = "Catégorie";
						RowResultat.append(ColTable);
					
						
						ColTable = document.createElement('th');
						ColTable.style.textAlign= "left";
						ColTable.style.textDecoration="underline" ;
						ColTable.innerHTML = "Temps";
						RowResultat.append(ColTable);
				
						
						ColTable = document.createElement('th');
						ColTable.style.textAlign= "left";
						ColTable.style.textDecoration="underline" ;
						ColTable.innerHTML = "Ecart";
						RowResultat.append(ColTable);

					

						TableResultat.style.width = "100%"; 
						TableResultat.append(RowResultat);
						
					}
					/* Resultat de la course */
					let RowResultat1  = document.createElement('tr');
		

					ColTableResultat1 = document.createElement('td');
					ColTableResultat1.innerHTML = CourseSelected.ArrayAnnee[l].ArrayEtape[y].ArrayResultat[j].Place;
					ColTableResultat1.style.padding= "5px";		
					ColTableResultat1.style.fontWeight= "bold";		
					ColTableResultat1.style.fontSize= "20px";	
					RowResultat1.append(ColTableResultat1);
					
					ColTableResultat1 = document.createElement('td');
					ColTableResultat1.innerHTML = CourseSelected.ArrayAnnee[l].ArrayEtape[y].ArrayResultat[j].Type;
					RowResultat1.append(ColTableResultat1);
					
					ColTableResultat1 = document.createElement('td');
					if(j==0)
					{
						ColTableResultat1.innerHTML =CourseSelected.ArrayAnnee[l].ArrayEtape[y].ArrayResultat[j].Temps;
					}
					RowResultat1.append(ColTableResultat1);
					
					ColTableResultat1 = document.createElement('td');
					ColTableResultat1.innerHTML = CourseSelected.ArrayAnnee[l].ArrayEtape[y].ArrayResultat[j].Ecart;
					RowResultat1.append(ColTableResultat1);

	


					TableResultat.append(RowResultat1);
				}
			}
		}

	
}
    function  funUserSelected(IDUserSelected)
    {
	
		SelectCoureur(ArrayCoureurs[IDUserSelected]);


        // remise au couleur de base 
        for (let i = 0; i < ArrayCoureurs.length; i++) 
        {
			document.getElementById("user"+i).classList.remove("dotMemberSelected");
			document.getElementById("user"+i).classList.add("dotMember");		
        }

		document.getElementById("user"+IDUserSelected).classList.add("dotMemberSelected");	
       
    }
</script>

<body>

<?php
  include("HeaderAdmin.php"); 
  ?>
</br>
<?	include("MenuMember.php"); ?>
<div id="corps">
<div id="index">


 </head>
 <body>

<div id="corps">


<?php 

if ( isset($_SESSION['Login']))
{
	$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
	mysqli_select_db($con ,'dxvv_jurachrono' );
// CODE ORDER ID
$LoginLight =substr($_SESSION['Login'], 0 ,   strpos($_SESSION['Login'], "@") ) ;
/************************* POUR TEST *****************************/
$OrderID = $LoginLight. date("YmdHis");


?>
<script>
	Login = 	<?php echo json_encode($_SESSION["Login"]); ?>;
	</script>
	</br> 
	<?php
	$sql = 'SELECT * FROM Membres  WHERE LoginCompte=\''.$_SESSION['Login'].'\''; 
	//echo $sql;
	$result = mysqli_query($con,$sql);
	$Aff = 0;
 	if ($result && mysqli_num_rows($result) > 0) 
	{
    // output data of each row 

	$c=0;

		while($val = mysqli_fetch_assoc($result)) 
		{
?>
<script>
				       var Coureur= new Object();
                Coureur.Valider = <?php echo json_encode($val ["Valider"]); ?>;
                Coureur.ID = <?php echo json_encode($val ["ID"]); ?>;
                Coureur.Nom = <?php echo json_encode($val ["Nom"]); ?>;
                Coureur.Prenom = <?php echo json_encode($val ["Prenom"]); ?>;
                Coureur.Mail = <?php echo json_encode($val ["mail"]); ?>;
                Coureur.Adresse = <?php echo json_encode($val ["adresse"]); ?>;
                Coureur.NPA = <?php echo json_encode($val ["npa"]); ?>;
                Coureur.Localite = <?php echo json_encode($val ["localite"]); ?>;
                Coureur.Sexe = <?php echo json_encode($val ["sexe"]); ?>;
                Coureur.Pays = <?php echo json_encode($val ["Pays"]); ?>;
                Coureur.DateNaissance = <?php echo json_encode( date("Y", strtotime($val ["DateNaissance"]))); ?>;
                Coureur.Club = <?php echo json_encode($val ["club"]); ?>;

				var ArrayCourse = [];
				 Coureur.ArrayCourse = ArrayCourse;
</script>



				 <Fieldset    onclick="funUserSelected('<?php echo $c ?>')" style="border:0px;Display:inline-grid;cursor: pointer; width:20%;  " >
				<span class="dotMember" id="<?php echo "user".$c ?>"  > 
                <?
                    $c++?>
                   
                    <Table >
                        <tr>
                            <td>
                              
                                <?php if ($val ["sexe"] == "D")
                                {?>
                                     <i class="fa fa-user" style= "font-size: 42px;margin:9px;color: #d48def;"></i>
<?
                                }
                                else
                                {?>
                              <i class="fa fa-user" style= "font-size: 42px;margin:9px;color: #4095f5;"></i>
                               <? }?>
                             
                            
                            </td>
                            <td>
                              
                                <table>
                                    <tr>
                                        <td>
                                          
                                        <? echo $val ["Nom"] ?>
                                        </td>
                                  </tr>
                                  <tr>
                                        <td>
                                            <? echo $val ["Prenom"]?>
                                        </td>
                                    </tr>
                                </table>
                           	
                            </td>		
                        </tr>
                    </table>

			
             </span>
                </fieldset>

		
				<?
				$Aff = $Aff+1 ;
				
				$sql = 'SELECT * FROM Resultat  WHERE Nom=\''.$val["Nom"].'\' 
				AND Prenom=\''. $val ["Prenom"].'\'
				AND Annee=\''. date("Y", strtotime($val ["DateNaissance"])).'\'';
			
				$result2 = mysqli_query($con,$sql);
				
				// Si résultat pour cette personne trouvé
				if ($result2) 
				{
					$Background = 0;
					// Affiches Chaque donnée de résultat Trouvé
					while($donnees = mysqli_fetch_assoc($result2)) 
					{?>
						<script>
						var Course = new Object();
						var	Resultat = new Object();
						var	CourseAnnee = new Object();
						var Etape = new Object();
						var ArrayAnnee = [];
						var ArrayResultat = [];
						var ArrayEtape = [];
						
						var NomCourse = <?php echo json_encode($donnees['Course']); ?>;
						var NomEtape =<?php echo json_encode($donnees['Etape']); ?>;
		
						var ValueAnnee =  NomCourse.slice(NomCourse.length-4);
						
						NomCourse = NomCourse.slice(0,NomCourse.length-4);
							
						// Ajout résultat a la course					
						Resultat.Nom = <?php echo json_encode($donnees['Nom']); ?>;
						Resultat.Prenom =  <?php echo json_encode($donnees['Prenom']); ?>;
						Resultat.Place = <?php echo json_encode($donnees['Place']); ?>;
						Resultat.Temps =<?php echo json_encode($donnees['Temps']); ?>;
						Resultat.Ecart =<?php echo json_encode($donnees['Ecart']); ?>;
						Resultat.Type =<?php echo json_encode($donnees['Type']); ?>;
						Resultat.Lieu =<?php echo json_encode($donnees['Lieu']); ?>;
						Resultat.Distance =<?php echo json_encode($donnees['Distance']); ?>;
						Resultat.Denivele =<?php echo json_encode($donnees['Denivele']); ?>;


						// Verification si Course existe déjà dans tableau
						var FindCourse = false;
						for (i = 0; i < ArrayCourse.length; i++) 
						{
							if (ArrayCourse[i].Nom ==  NomCourse)
							{
								Course = ArrayCourse[i];
								FindCourse = true;
								break;
							}
						}
						
						// Si course pas trouver création d'une nouvelle.
						if (!FindCourse)
						{
							Course.Nom = NomCourse;
				
							// Création d'une nouvelle année de la course
							CourseAnnee.ArrayEtape = ArrayEtape;
						
							// Création d'une étape de base
							Etape.ArrayResultat = ArrayResultat;
							Etape.Nom = NomEtape;
							
							
							CourseAnnee.Nom = ValueAnnee;
							
							CourseAnnee.ArrayEtape.push(Etape);
			
							ArrayAnnee.push(CourseAnnee);
							
							// Creation tableau année pour une course
							Course.ArrayAnnee = ArrayAnnee;
							// Ajout de la course à la lsit des courses
							ArrayCourse.push(Course);
						}
						else
						{
							// Recherche si année déjà existante pour cette course
						
							var FindAnnee = false;
							for (h = 0; h < Course.ArrayAnnee.length; h++) 
							{
								if (Course.ArrayAnnee[h].Nom ==  ValueAnnee)
								{
									CourseAnnee = Course.ArrayAnnee[h];
									// Recherche si Etape déjà existante pour cette course
									var FindEtape = false;
									for (z = 0; z < Course.ArrayAnnee[h].ArrayEtape.length; z++) 
									{
										if (Course.ArrayAnnee[h].ArrayEtape[z].Nom ==  NomEtape)
										{
											FindEtape = true;
											Etape = Course.ArrayAnnee[h].ArrayEtape[z];
											break;
										}
									}
									FindAnnee = true;
									break;
								}
							}
							// Si Résultats n'est dans aucune année existante , création de l'année
							if (!FindAnnee)
							{

								// Création d'une nouvelle année de la course
								Etape.ArrayResultat = ArrayResultat;
								Etape.Nom = NomEtape;
					
								CourseAnnee.Nom = ValueAnnee;
								CourseAnnee.ArrayEtape = ArrayEtape;
								console.log(CourseAnnee);
								CourseAnnee.ArrayEtape.push(Etape);
								
								Course.ArrayAnnee.push(CourseAnnee);
								
							}
							// Si Résultats n'est dans aucune étape existante , ajout de l'étape
							else if (!FindEtape)
							{
								Etape.ArrayResultat = ArrayResultat;
								Etape.Nom =NomEtape;
								CourseAnnee.ArrayEtape.push(Etape);
								
							}
						}
						
						// Ajout du résultat a l'année
						Etape.ArrayResultat.push(Resultat);
						
						</script>
							<?php		
					}
		

					?>
					<Script>
				
					ArrayCoureurs.push(Coureur);
					</script>
					<?php
						
				}
		}
	}


}
else
{?>
	<i>Veuillez vous connecter </i>  </br></br>
<?php
}
?>

</div>
 
 <div id="divCourse">
</div>

<div id="divResultats">
</div>
</div>

</body>
</html>
