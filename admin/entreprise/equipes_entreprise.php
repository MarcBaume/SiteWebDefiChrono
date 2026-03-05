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
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../../../js/prototype.js" ></script>
<script src="../../../js/FonctionDefiChrono2.js?v=1"></script>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>
<!-- initilisation de variable -->
 <?php
 include("../../MysqlConnect.php");
include("HeaderEntreprise.php"); 
include("menuEntreprise.php"); ?>

<script>
var ArrayCoureurs = [];

function glisser(ev)
{
    console.log("glisser");
    ev.dataTransfer.effectAllowed="copy";
    ev.dataTransfer.setData("text",ev.target.getAttribute("id"));
}
// Function
function survoler(ev,course,depart,parcours,NomEquipe,ID, nombreEquipe)
{
    ev.preventDefault();
    EquipeSelected(course,depart,parcours,NomEquipe,ID, nombreEquipe)
} 
function deposer(ev)
{

    console.log("deposer");
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    data =data.replace("user","");
    funUserSelected(data);
    catSelected();
}
function  funUserSelected(IDUserSelected)
{
    // remise au couleur de base 
    for (let i = 0; i < ArrayCoureurs.length; i++) 
    {
        document.getElementById("user"+i).style.background= "#ffffff";
    }

    document.getElementById("user"+IDUserSelected).style.background= "#b3f3fa";
    document.getElementById("IDCoureur").value= ArrayCoureurs[IDUserSelected].ID;
    document.getElementById("nom").value= ArrayCoureurs[IDUserSelected].Nom;
    document.getElementById("prenom").value= ArrayCoureurs[IDUserSelected].Prenom;
    document.getElementById("email").value= ArrayCoureurs[IDUserSelected].Mail;
    document.getElementById("adresse").value= ArrayCoureurs[IDUserSelected].Adresse;
    document.getElementById("zip").value= ArrayCoureurs[IDUserSelected].NPA;
    document.getElementById("ville").value= ArrayCoureurs[IDUserSelected].Localite
    document.getElementById("pays").value= ArrayCoureurs[IDUserSelected].Pays;
    document.getElementById("DateNaissance").value= ArrayCoureurs[IDUserSelected].DateNaissance;
    document.getElementById("club").value= ArrayCoureurs[IDUserSelected].Club;
    document.getElementById("sexe").value = ArrayCoureurs[IDUserSelected].Sexe ; 
    document.getElementById("LblInformation").innerText  = "Sélectionne une équipe";
}
function AddEquipe()
{
    console.log("Fun add équipe");
    FormValue = document.getElementById("FormAddEquipe");
	FormValue.method="get" ;
	FormValue.action="CibleAddEquipe.php"
     console.log("Fun add équipe 1");
    $('FormAddEquipe').request({
            onComplete: function(transport){
                val =transport.responseText.evalJSON();
                console.log(val);
                if (val== 1 )
                {
                    window.location.reload();
                }
            }
        });
}
function EquipeSelected(Course,depart,parcours,NomEquipe,ID, nombreEquipe)
{
     // remise au couleur de base 
    for (let i = 1; i <= nombreEquipe; i++) 
    {
        document.getElementById("TableEquipe"+i).style.background = "#ffffff";
        console.log(i);
    }
    document.getElementById("TableEquipe"+ID).style.background ="#b3f3fa";
    document.getElementById("NomCourse").value=Course;
    document.getElementById("NomParcours").value= parcours;
    document.getElementById("NomDepart").value= depart;
    document.getElementById("NomEquipe").value= NomEquipe;
    document.getElementById("LblInformation").innerText  = "Transfert l'athète dans l'équipe";
    document.getElementById("ButtonAddAthleteInTeam").disabled = false
}
function ViewAddEquipe()
{
        document.getElementById("PopupAddEquipe").style.display="block";
         document.getElementById("PopupAddEquipe").style.visibility="visible";
}
function deleteCoureur(idCoureur)
{
    console.log(idCoureur);
}
function coureurEquipeSelected(ID)
{

      document.getElementById("ButtonDeleteteAhleteInTeam").style.background="#ffff00";
    document.getElementById("IdDeleteEquipe").value= ID;
    val = "CoureurEquipe"+ID;
    console.log(val);
          document.getElementById(val).style.background="#ffff00";
}
// Recherche les départ compatible pour la personnne inscrite
function catSelected() 
{
    f = document.getElementById("FormulaireCoureur");
	var NomDepart = document.getElementById("NomDepart").value;
	var NomParcours = document.getElementById("NomParcours").value;
	var NomCourse = document.getElementById("NomCourse").value;
    document.getElementById("LblInformation").innerText  = "";
    PathFolderInfoDepart = '../../courses/'+ NomCourse +'/'+ NomParcours+ '/'+ NomDepart
    console.log("path");
	console.log(PathFolderInfoDepart);
    /*********************** CREATION OBJET PARCOURS ******************************/
    var ObjDepart= new Object();
        ObjDepart =  readJSON(PathFolderInfoDepart+"/info.json");
        console.log(ObjDepart)
	// Obtention année en cours
	var dateNow = new Date().getFullYear();

	// Vérification que le champs de date est dans la plage possible
	if (f.dateNaissance.value.length==4 && parseInt(f.dateNaissance.value ) > 1900  && parseInt(f.dateNaissance.value) <=dateNow) 
	{
        f.dateNaissance.style.background = "white";
		if (f.sexe.value.length > 0 && f.sexe.value == "D" || f.sexe.value == "H")
		{
			sexe = f.sexe.value;
			// Scan de chaque catégorie du départ 
            for(var iCategorie=0; iCategorie<ObjDepart.ListCategorie.ListItem.length; ++iCategorie) 
            {	
                var Cat = new Object();
                Cat = ObjDepart.ListCategorie.ListItem[iCategorie];
                // Si Catégorie possible pour la personne choisie
                console.log(sexe);
                console.log(f.dateNaissance.value);
                console.log(Cat);
                if ((sexe== Cat.SexeCategorie._Value || Cat.SexeCategorie._Value == "M") && 
                 (parseInt(f.dateNaissance.value) >= Cat.debutAnnee._Value ) && 
                 (parseInt(f.dateNaissance.value)<=  Cat.finAnnee._Value ))
                {
                    document.getElementById("NomCat").value =Cat.NomCategorie._Value;
                    document.getElementById("NumCat").value =Cat.NumCategorie._Value;
                    break;
                }
            }

            if (Cat.NumCategorie._Value.length > 0)
            {
                f.submit();
            }
            else
            {
              document.getElementById("LblInformation").innerText  = "Aucune catégorie trouvé pour ce coureur";
            }
        }
        else
        {
            document.getElementById("LblInformation").innerText  = "Mauvais format du genre du coureur";
        }
    }
    else
    {
         document.getElementById("LblInformation").innerText  = "Mauvais format de l'année de naissance du coureur";
    }
}
</script>

<body>
</br>
<?php
/*******************************************************************************************************************
   Popup ajout d'équioe
 ********************************************************************************************************************/
session_start();
if (isset($_SESSION['Login']) && strlen($_SESSION['Login']) > 1)
{?>
<div id="corps">
  <span class="popup" id="PopupAddEquipe" style="display:None;">
    <h2> Ajouts d'une équipe</h2>
    <!-- Formulaire d'ajout d'équipe -->
    <form id="FormAddEquipe" name="FormAddEquipe" method="get"  action="CibleAddEquipe.php"  >
        <input type="hidden" name="ID" id="ID"   />
        <input type="text" name="LoginEntreprise" id="LoginEntreprise" value="<?php echo $_SESSION['Login'];?>"  />
        <p><label style="vertical-alignement: center" for="nom">Nom équipe:</label> <input type="text" name="NomEquipeAdd" id="NomEquipeAdd" tabindex="10"   /></p>
        <p><label style="vertical-alignement: center" for="IDTypeEquipeEntreprise">Course :</label> <select  name="IDTypeEquipeEntreprise" id="IDTypeEquipeEntreprise" tabindex="20">
        <?php
            $sql = 'SELECT * FROM TypeEquipeEntreprise'; 
            $resultTypeEntreprise = mysqli_query($con,$sql);
            if ($resultTypeEntreprise && mysqli_num_rows($resultTypeEntreprise) > 0) 
            {
                while($valTypeEquipe = mysqli_fetch_assoc($resultTypeEntreprise)) 
                {?>
                    <option value=<?php echo $valTypeEquipe["ID"] ?>><?php echo $valTypeEquipe["NomType"]?> </option>
                <?php
                }
            }
        ?>
        </select></p>
        <!-- Bouton validation information -->
        <button type ="button" style="margin-right :10px;"
                onClick="AddEquipe(this.form)" title="Ajouts d'équipes" 
                data-toggle="tooltip" data-placement="right">
                <i class="fa fa-check" style= "font-size: 50px;margin:9px;color: #4095f5;"></i>
        </button>
        </a>
    </form>	
    </span>
<?php
/*******************************************************************************************************************
    Information  / Guide client
 ********************************************************************************************************************/
?>
<div >
  <p id="LblInformation"  style="width:50%;margin:auto;margin-top:20px;text-align:center;font-size:24px;border:5px solid #3D6CA4; border-radius:20px;padding:20px;"> 
    Sélectionne un athlète et fait le glisser dans son équipe</p></br>
<?php
/*******************************************************************************************************************
    Liste athlètes
 ********************************************************************************************************************/
?>
<div style="margin:20px;border:2px solid;radius :10px">
    <div style="margin:0px"  class="title">Mes athètes  </div>
    <p><a href="membres_entreprise.php?login=<?echo $_SESSION['Login']?>"> Liens de partage ajouts athlètes </a></p>
    <div style="display:flex" ondragstart="glisser(event)">
     <?php
        $c = 0;
        $sql = 'SELECT * FROM Membres  WHERE LoginCompte=\''.$_SESSION['Login'].'\''; 
        $result = mysqli_query($con,$sql);
        if ($result && mysqli_num_rows($result) > 0) 
        {
            //Chaque athlète on va créer un nom 
            while($val = mysqli_fetch_assoc($result)) 
            {?>
                <div class="Button" id="<?php echo "user".$c ?>" draggable=true onclick="funUserSelected('<?php echo $c ?>')" style="border:0px;cursor: pointer; width:20%;  " >
                <?php
                $c++;
                if ($val["Valider"])
                {
                    $CmptValider++?>
                    <table>
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
                                <?
                                }?>
                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <td>    
                                        <? echo $val ["Nom"]?>
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
                <?
                }
                else
                {?>
                    <Table>
                        <tr>
                            <td>
                                <i class="fa fa-user" style= "font-size: 22px;margin:9px;"></i>
                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <td>
                                    <? echo $val ["Nom"]?>
                                        </td>
                                        <td>
                                            <? echo $val ["Prenom"]?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                <?php	
                }?>
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
                    ArrayCoureurs.push(Coureur);
                </script>	
                </div>
                <?php
            }?>
        
        </div>
        <?php
    }
    else
    {
    ?>
        </br><p style="margin;10px">Il n'existe aucun coureur </br></br>ajouter des coureurs en partagant le liens ci-dessus</p></br>
    <?php
    }?>
    </div>
</div>
<!-- Buton copie athléte dans l'équipes
<Button  class="Button"  
            onClick="catSelected()"
            disabled="True"
            id="ButtonAddAthleteInTeam">
    <table>
        <tr>
            <td style="text-align: center;" >
                <i class="fa fa-chevron-circle-right" style= "font-size: 50px;    width:100%;"></i>
            </td>
        </tr>
    </table>
</button> -->
<?php
/*******************************************************************************************************************
 * Affichage tableau liste  des équipes
 ********************************************************************************************************************/
?>
<div style="margin:20px;border:2px solid;radius :10px">
    <div style="margin:0px"class="title">
        <i class="fa fa-users" style= "font-size: 20px;margin:9px;color: #FFFF;"></i> 
        Mes équipes 
        <button type ="button" style="margin-right :10px;"
        onclick="ViewAddEquipe()"title="Ajouts d'équipes" 
        data-toggle="tooltip" data-placement="right">
            <table>
                <tr>
                    <td>
                        <i class="fa fa-plus" style= "font-size: 20px;margin:9px;color: #4095f5;"></i> 
                    <td>
                </tr>
            </table>
        </button>
    </div>
    <?php
    // Liste des equipes de cette entreprise 
    $sql = 'SELECT * FROM EquipesEntreprises WHERE  LoginEntreprise	=\''.$_SESSION['Login'].'\''; 
    $resultListeEquipe = mysqli_query($con,$sql);
    if ($resultListeEquipe && mysqli_num_rows($resultListeEquipe) > 0) 
    {?>
        <div id="ListEquipe" >
        <?
        $d=0;
        while($valEquipe = mysqli_fetch_assoc($resultListeEquipe)) 
        {
            $d++;
            //Recherche le type d'équipe dans la base de donnée
            $sqlType = 'SELECT * FROM TypeEquipeEntreprise WHERE  ID=\''.$valEquipe['IDTypeEquipeEntreprise'].'\''; 
            $resultTypeEquipe = mysqli_query($con,$sqlType);
            if ($resultTypeEquipe && mysqli_num_rows($resultTypeEquipe) > 0) 
            {
                // Prends le type d'équipe qui correspond à l'équipe créer
                while($valTypeEquipe = mysqli_fetch_assoc($resultTypeEquipe)) 
                {
                    ?>
                    <div id="TableEquipe<?echo $d?>" class="dotEquipe" 
                    style="width:90%;margin:auto;border:1px solid;radius 10px" >
                        <div class="title"> 
                            <?echo "<i class='fa fa-users' style= 'font-size: 20px;margin:9px;color: #ffffff;'></i>     ". $valEquipe["NomEquipe"] ." /  " . $valTypeEquipe["NomType"];?>
                        </div>
                        <div style="display:flex; min-height: 50px;  justify-content: space-around;">
                        <?php
                        $sqlInsc = 'SELECT * FROM inscription WHERE  Course=\''.$valTypeEquipe["Course"].'\'AND NomEquipe=\''.$valEquipe["NomEquipe"] .'\''; 
                        $resultInsc = mysqli_query($con,$sqlInsc);
                        if ($resultInsc && mysqli_num_rows($resultInsc) > 0) 
                        {
                             $nbrAthlteInTeam = 0;
                            while($valInsc = mysqli_fetch_assoc($resultInsc)) 
                            {
                                $nbrAthlteInTeam ++;?>
                                <div id="<?php echo'athleteEquipe'.$valEquipe["NomEquipe"] . $valTypeEquipe["NomType"].$nbrAthlteInTeam?>" style="height: 100px; border:2px dashed gray; min-width: 100px; background-color:light-gray;margin: 20px; justify-content: center; align-items: center;">
                                    <?php if ($valInsc ["sexe"] == "D")
                                    {?>
                                        <i class="fa fa-user" style= "font-size: 42px;margin:9px;color: #d48def;"></i>
                                    <?
                                    }
                                    else
                                    {?>
                                        
                                        <i class="fa fa-user" style= "font-size: 42px;margin:9px;color: #4095f5;"></i>
                                    <?}?>
                                                <?php
                                                    echo $valInsc["Nom"];
                                            ?>
                                            </br>
                                             <?php
                                                    echo  $valInsc["Prenom"];
                                            ?>
                                            <i class="fa fa-trash"  onClick=<?php echo "deleteCoureur(". $valInsc["ID"].")"?> style= "cursor: pointer ;font-size: 30px;margin:9px;"></i>
                                </div>
                           <?php }
                        }
                            /* <!-- Aucun athlète encore dans l'équipe -->*/
                       for ($i =  $nbrAthlteInTeam ; $i < 6; $i++) { ?>
                            <div  ondrop="deposer(event)" 
                          ondragover="survoler(
      event,
    '<?php echo $valTypeEquipe['Course']; ?>',
    '<?php echo $valTypeEquipe['Depart']; ?>',
    '<?php echo $valTypeEquipe['Parcours']; ?>',
    '<?php echo $valEquipe['NomEquipe']; ?>',
    <?php echo json_encode($d); ?>,
    <?php echo json_encode(mysqli_num_rows($resultListeEquipe)); ?>
)"
                             id="<?php echo('athleteEquipe'.$valEquipe["NomEquipe"] . $valTypeEquipe["NomType"].$i)?>" 
                             style="height: 100px; border:2px dashed gray; min-width: 100px; background-color:light-gray;margin: 20px; justify-content: center; align-items: center;">
                                <i class='fa fa-plus' style= 'font-size: 20px;color: #444; margin:40px;'></i>
                            </div>
                                <?php
                        }?>
                    </div>
                    </div>
                       <?
                       
                        break;                       
                    }
                }
                ?> 
        <?
        } 
        ?>
        </div><?php
    }?>
</div>
<?
/************z*******************************************************************************************************
 * 
 * Affichage coureur sélectionné
 * 
 ********************************************************************************************************************/
?>

<div >
<form method="post"  id="formulaireDelete" name="formulaireDelete" action="DeleteInscriptionEntreprise.php"  >   
            <input type="hidden" name="IdDeleteEquipe" id="IdDeleteEquipe"   />
        </Form>
</div>
<div id="formulaire">

        <form method="post"  id="FormulaireCoureur" name="FormulaireCoureur" action="CibleAddInscriptionEntreprise.php"  >   
            <input type="hidden" name="NomEquipe" id="NomEquipe"   />
            <input type="hidden" name="NomCourse" id="NomCourse"  />
            <input type="hidden"  id="NomParcours" name="NomParcours" />
            <input type="hidden"  id="NomDepart" name="NomDepart" />
            <input type="hidden" name="nom" id="nom" tabindex="10"   />
            <input type="hidden" name="prenom" id="prenom" tabindex="20" />
            <input type="hidden" name="email" id="email" tabindex="40" />
            <input type="hidden" name="adresse" id="adresse" tabindex="50"/>
            <input type="hidden" name="zip" id="zip" tabindex="60" />
            <input type="hidden" name="ville" id="ville"tabindex="70" />
            <input type="hidden" name="pays" id="pays"tabindex="80" />
            <input type="hidden" name="dateNaissance" id="DateNaissance"  />
            <input type="hidden" name="club" id="club"tabindex="100" />
            <input type="hidden" name="sexe" id="sexe"tabindex="100" />
            <input type="hidden" name="NumCat" id="NumCat" />
	        <input type="hidden" name="NomCat" id="NomCat" />
            <input type="hidden" name="IDCoureur" id="IDCoureur" />
			<!--Nombre étapes*:--><input type="hidden"  style="width: 90%;" name="NbrEtape" id="NbrEtape" tabindex="410" ></input>

        </form>		
</div>

<Center>
	<?php
	if (isset($_SESSION['Course']) and $CmptValider > 0)
    {
        ?>
        <script>  
             document.getElementById("PCoureurValid").style.visibility = "visible" ;
        </script>
        <?
	}
	?>
</center>

</div>
 

    </body>
</html>
<?php
 
     if( mysqli_num_rows($result) == 1)
     {   ?>
         <script>
             funUserSelected(0);
         </script>
         <? 

     }
     else if (mysqli_num_rows($result) == 0)
     {
        ?>
        <script>
        document.getElementById("FormAddMembres").submit();
        </script>
        <?php
     }
         // Demande l'ajout d'une équipe
        
     if ( mysqli_num_rows($resultListeEquipe) == 0)
    { ?>
        <script>
        document.getElementById("LblInformation").innerText  = "Ajoute une équipe";
          </script>
        <?php
    }
}
?>