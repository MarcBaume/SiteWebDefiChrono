<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="../../styleV6.css" type="text/css"/>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../../../js/prototype.js" ></script>
<script src="../../../js/FonctionDefiChrono2.js?v=1"></script>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>
<!-- initilisation de variable -->
 <?php
include("HeaderEntreprise.php"); 
include("menuEntreprise.php"); ?>

<script>
var ArrayCoureurs = [];

// Function 
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

function AddEquipe(f1)
{
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
    console.log(Course+depart+parcours+NomEquipe+"gfdg"+nombreEquipe)
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
}
function ViewAddEquipe()
{
        document.getElementById("PopupAddEquipe").style.display="block";
         document.getElementById("PopupAddEquipe").style.visibility="visible";
}
function deleteCoureur()
{
    console.log(ID);
}
function coureurEquipeSelected(ID)
{

      document.getElementById("ButtonDeleteCoureur").style.background="#ffff00";
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
session_start();
if (isset($_SESSION['Login']) && strlen($_SESSION['Login']) > 1)
{?>
<div id="corps">
<?php
/*******************************************************************************************************************
 * 
 * Affichage tableau liste des équipes et coureur
 * 
 ********************************************************************************************************************/
?>
<div >
  <p id="LblInformation"  style="width:50%;margin:auto;margin-top:20px;text-align:center;font-size:24px;border:5px solid #3D6CA4; border-radius:20px;padding:20px;"> Sélectionne un athlète</p></br>
  <span class="popup" id="PopupAddEquipe" style="display:block;">
    <h2> Ajouts d'une équipe</h2>

    <form id="FormAddEquipe" name="FormAddEquipe" method="get"  action="CibleAddEquipe.php"  >
        <input type="hidden" name="ID" id="ID"   />
        <input type="text" name="LoginEntreprise" id="LoginEntreprise" value="<?php echo $_SESSION['Login'];?>"  />
        <p><label style="vertical-alignement: center" for="nom">Nom équipe:</label> <input type="text" name="NomEquipes" id="NomEquipes" tabindex="10"   /></p>
        <p><label style="vertical-alignement: center" for="prenom">Course :</label> 
        <select  name="TypeCourse" id="TypeCourse" tabindex="20">
        <?php
            mysqli_select_db($con ,'dxvv_jurachrono' );
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
</div>
<?php
/*******************************************************************************************************************
 * 
 * Affichage tableau liste des équipes et coureur
 * 
 ********************************************************************************************************************/
?>
    <table style="width:90%;margin:auto;">
        <tr>
             <th style="background:#1e8ac2;color:#ffff;"> Mes athètes  </br>
             <p><a href="membres_entreprise.php?login=<?echo $_SESSION['Login']?>"> Liens de partage ajouts athlètes </a></p>

             </th>
             <th>                   
            </th>
             <th style="background:#1e8ac2;color:#ffff;">
                 <i class="fa fa-users" style= "font-size: 20px;margin:9px;color: #4095f5;"></i> 
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
            </th>           
        </tr> 
        <tr>
            <td style=" border: 1px solid #1e8ac2; vertical-align: top;">
                <table>
                   <?php
                    $c = 0;
                    $con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
                    if (!$con)
                    {
                        die('Could not connect: ' . mysql_error());
                    }
                    else
                    {
                        mysqli_select_db($con ,'dxvv_jurachrono' );
                        $sql = 'SELECT * FROM Membres  WHERE LoginCompte=\''.$_SESSION['Login'].'\''; 
                        //echo $sql;
                        $result = mysqli_query($con,$sql);
                
                        if ($result && mysqli_num_rows($result) > 0) 
                        {
                            //Chaque athlète on va créer un nom 
                            while($val = mysqli_fetch_assoc($result)) 
                            {?>
                                <tr onclick="funUserSelected('<?php echo $c ?>')" style="border:0px;cursor: pointer; width:20%;  " >
                                
                                <td class="dotMember" id="<?php echo "user".$c ?>"> 
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
                                                <i class="fa fa-user" style= "font-size: 22px;margin:9px;color: red;"></i>
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
                            </td>
                        </tr>
                    
                        <?php
                        }
                    }
                    else
                    {
                    ?>
                        </br>Il n'existe aucun coureur pour ce compte, ajouter un coureur afin de pouvoir l'inscrire à une course</br>
                    <?php
                    }
                }
            ?>
            </table>
        </td>
        <td>
            <table>
                <tr>
                    <td>
                        <Button  class="ButtonResultat"  style="cursor: pointer; background:transparent;Height: 80px;background:#fff " onClick="catSelected()">
                            <Table >
                                <tr>
                                    <td style="text-align: center;">
                                     <i class="fa fa-chevron-circle-right" style= "font-size: 50px;color: #00b4ff;    width:100%;"></i>
                                    </td>
                                </tr>
                            </table>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <Button id="ButtonDeleteCoureur" class="ButtonResultat"  style="cursor: pointer; background:transparent;Height: 80px;background:#fff " onClick="deleteCoureur()">
                            <Table >
                                <tr>
                                    <td style="text-align: center;">
                                        <i class="fa fa-chevron-circle-left" style= "font-size: 50px;color: #00b4ff;    width:100%;"></i>
                                    </td>
                                </tr>
                            </table>
                        </button>
                    </td>
                </tr>
            </table>
        </td>
        <td style=" border: 1px solid #1e8ac2;   vertical-align: top;">
            <?php
            mysqli_select_db($con ,'dxvv_jurachrono' );
            // Liste des equipes de cette entreprise 
            $sql = 'SELECT * FROM EquipesEntreprises WHERE  LoginEntreprise	=\''.$_SESSION['Login'].'\''; 
            $resultListeEquipe = mysqli_query($con,$sql);
            if ($resultListeEquipe && mysqli_num_rows($resultListeEquipe) > 0) 
            {?>
                <table id="ListEquipe" >
                    <tr>
                        <td>  
                            <?
                            $d=0;
                            while($valEquipe = mysqli_fetch_assoc($resultListeEquipe)) 
                            {
                                $d++;
                                //Recherche le type d'équipe dans la base de donnée
                                $sqlType = 'SELECT * FROM TypeEquipeEntreprise WHERE  ID=\''.$valEquipe['TypeCourse'].'\''; 
                                $resultTypeEquipe = mysqli_query($con,$sqlType);
                                if ($resultTypeEquipe && mysqli_num_rows($resultTypeEquipe) > 0) 
                                {
                                    // Prends le premier type d'équipe qui correspond à l'équipe
                                    while($valTypeEquipe = mysqli_fetch_assoc($resultTypeEquipe)) 
                                    {
                                        ?>
                                        <table   id="TableEquipe<?echo $d?>" class="dotEquipe" style="width:90%;margin:auto;"  onClick="EquipeSelected('<? echo $valTypeEquipe["Course"]?>','<? echo $valTypeEquipe["Depart"]?>','<? echo $valTypeEquipe["Parcours"]?>','<? echo $valEquipe["NomEquipe"]?>','<? echo $d?>','<?echo mysqli_num_rows($resultListeEquipe)?>')">
                                            <tr>
                                                <th style="background:#1e8ac2;color:#ffff;">  
                               
                                                    <?echo "<i class='fa fa-users' style= 'font-size: 20px;margin:9px;color: #ffffff;'></i>     ". $valEquipe["NomEquipe"] ." /  " . $valTypeEquipe["NomType"];?>
                                                </th>
                                            </tr>
                                            <!-- Listes des coureurs dans l'équipes -->
                                            
                                        <?php
                                        $sqlInsc = 'SELECT * FROM inscription WHERE  Course=\''.$valTypeEquipe["Course"].'\'AND NomEquipe=\''.$valEquipe["NomEquipe"] .'\''; 
                                        $resultInsc = mysqli_query($con,$sqlInsc);
                                        if ($resultInsc && mysqli_num_rows($resultInsc) > 0) 
                                        {?>
                                            <tr>
                                                <td>
                                                    <table >
                                                    <?
                                                    while($valInsc = mysqli_fetch_assoc($resultInsc)) 
                                                    {?>
                                                    
                                                        <tr class="dotMember" id="CoureurEquipe<?php echo $valInsc["ID"]?> " onClick="coureurEquipeSelected(<?php echo $valInsc["ID"]?>)">
                                                            <td>
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
                                                                    echo $valInsc["Nom"]. " " . $valInsc["Prenom"];
                                                            ?>
                                                            </td>
                                                        </tr> 
                                                    <?
                                                    }?>
                                                    </table>
                                                </td>
                                            </tr>
                            
                                            <?
                                        }?>
                                        </table><?
                                        break;                       
                                    }
                                }
                                ?>
                            </td>   
                        </tr>
                    </table>
             <?} 
                     
            }?>
        </td>
    </tr>
 </table>
<?
/*******************************************************************************************************************
 * 
 * Affichage coureur sélectionné
 * 
 ********************************************************************************************************************/
?>

<div >
<form method="post"  id="formulaireDelete" name="formulaireDelete" action="DeleteInscriptionEntreprise.php"  >   
            <input type="Text" name="IdDeleteEquipe" id="IdDeleteEquipe"   />
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
     // Si un seul coureur créer le sélectionner d'office au chargement de la page
     if( mysqli_num_rows($result) == 1)
     {

         ?>
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
}
?>