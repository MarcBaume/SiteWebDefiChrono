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
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../../js/prototype.js" ></script>
<script src="../../js/FonctionDefiChrono2.js?v=1"></script>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>
<!-- initilisation de variable -->
<script>
    var ArrayCoureurs = [];

    // Function 

    function  funUserSelected(IDUserSelected)
    {
        document.getElementById("FormInformation").style.visibility = "visible" ;
        document.getElementById("FormInformation").style.display  = "block" ;
        document.getElementById("FormDeleteInformation").style.visibility = "visible" ;
        document.getElementById("FormDeleteInformation").style.display  = "block" ;
        
        // remise au couleur de base 
        for (let i = 0; i < ArrayCoureurs.length; i++) 
        {
           
            document.getElementById("user"+i).style.background= "#00b4ff";
        }

        document.getElementById("user"+IDUserSelected).style.background= "#1e8ac2";
        document.getElementById("ID").value= ArrayCoureurs[IDUserSelected].ID;
        document.getElementById("IDDelete").value= ArrayCoureurs[IDUserSelected].ID;
        document.getElementById("nom").value= ArrayCoureurs[IDUserSelected].Nom;
        document.getElementById("prenom").value= ArrayCoureurs[IDUserSelected].Prenom;
        document.getElementById("email").value= ArrayCoureurs[IDUserSelected].Mail;
        document.getElementById("adresse").value= ArrayCoureurs[IDUserSelected].Adresse;
        document.getElementById("zip").value= ArrayCoureurs[IDUserSelected].NPA;
        document.getElementById("ville").value= ArrayCoureurs[IDUserSelected].Localite
        document.getElementById("pays").value= ArrayCoureurs[IDUserSelected].Pays;
        document.getElementById("DateNaissance").value= ArrayCoureurs[IDUserSelected].DateNaissance;
        document.getElementById("club").value= ArrayCoureurs[IDUserSelected].Club;

        console.log(ArrayCoureurs[IDUserSelected].Valider);
        console.log(ArrayCoureurs[IDUserSelected].Valider);

        if (ArrayCoureurs[IDUserSelected].Sexe =="D")
        {
            document.getElementById("sexe").selectedIndex = 2;
        }
        else if (ArrayCoureurs[IDUserSelected].Sexe =="H")
        {
            document.getElementById("sexe").selectedIndex = 1;
        }
        else
        {
            document.getElementById("sexe").selectedIndex = 0;
        }

        if (ArrayCoureurs[IDUserSelected].Valider ==1)
        {
          document.getElementById("lblInformation").innerHTML= "Le profil de votre coureur est validé";
          document.getElementById("lblInformation").style.background="#00fa8c";
        }
        else
        {
            document.getElementById("lblInformation").innerHTML="les informations du coureur n'ont pas encore été validées"
            document.getElementById("lblInformation").style.background="#fa8a8a";
        }
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
</script>

<body>

<?php
  include("HeaderAdmin.php"); 
  ?>
</br>
<?	include("MenuMember.php"); ?>
<div id="corps">
<div id="index">
<?php

// Affichage bandeau seulement si on est en insciption de cours
	if ( strlen($_SESSION['DateCourse'])> 0  && strlen($_SESSION['Course'])>0)
	{
       
	?>
     <table  style="width:100%;">
     <tr>
        <img src="../images/FilRougeInscription3.png" style="width: 100%" >
    </tr>
	<tr name="PCoureurValid" id="PCoureurValid" style="visibility:hidden;">
		<td>
		<i style="font-size:120%" > Maintenant que votre profil est terminé, vous pouvez inscrire  les coureurs validés aux différentes courses.</i>
		</br>
		</br>
		<form method="get" action="../formulaire2023.php">
			<input type="hidden" name="DateCourse" id="DateCourse"   value= '<?php echo $_SESSION['DateCourse'] ?>' />
			<input type="hidden" name="NomCourse" id="NomCourse"  value= '<?php echo $_SESSION['Course']?>' />
			<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_SESSION['Nbretape'] ?>' />
			<input type="submit" value="Retourné au inscription de  <?php echo $_SESSION['Course'] ?>"  class="ButtonResultat" style= " padding:10px;height:80px;cursor: pointer; Background:transparent;Font-size:24px"> 
		 </form>
		 </br>
		</br>
		</td>
	</tr>
    </table>
    </BR>
	<?php
	}
	?>
	<form id="FormAddMembres" method="get" action ="AddMembres.php" style="float:right;"  >
    <Button  class="ButtonResultat"  style="cursor: pointer; background:transparent;Height: 120px; " onClick="addForm(this.form)">
        <Table >
            <tr>
            <td style="text-align: center;">
        
                    <i class="fa fa-plus" style= "font-size: 50px;color: #00b4ff;    width:100%;"></i>

            </td>
            </tr>
            <Tr>
            <td>
            <a style="margin :10px; Font-size : 15px">  Ajout athlète </a>
            </td>
            </tr>
        </table>
    </button>
	</form>
 
   <?php
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
            $c= 0;
            // de type entreprise

            $sqlLogin = 'SELECT * FROM Login  WHERE Login=\''.$_SESSION['Login'].'\''; 
            $resultLogin = mysqli_query($con,$sqlLogin);
            
            while($ValLogin = mysqli_fetch_assoc($resultLogin)) 
            {?>
                <h2> Liste d'athlète(s) dans l'entreprise <? echo $ValLogin["NomEntreprise"]?></h2> 

                <a href="inscriptions/formulaireAddMembre.php?login=<?echo $_SESSION['Login']?>"> Liens de partage ajouts athlètes </a>
            <?
            }
			//Chaque athlète on va créer un nom 
			while($val = mysqli_fetch_assoc($result)) 
			{?>
               <Fieldset   id="<?php echo "user".$c ?>" onclick="funUserSelected('<?php echo $c ?>')" style="border:0px;Display:inline-grid;cursor: pointer; width:20%;  " >
				<span class="dotMember"  > 
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
                               <?}?>
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
                }
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
                ArrayCoureurs.push(Coureur);
			</script>	
             </span>
                </fieldset>
           
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
   
/*******************************************************************************************************************
 * 
 * Affichage liste des course
 * 
 ********************************************************************************************************************/
?>
<div id="divAddEquipe"  style="padding:2px; margin:20%;  margin-top :10px;margin-bottom :10px ;radius :10px; background: #ccc ">
   
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
</div>
<div id="divListeEquipe">
    
    <p> Listes de mes équipes </p>
    <?php
            mysqli_select_db($con ,'dxvv_jurachrono' );
            $sql = 'SELECT * FROM EquipesEntreprises WHERE  LoginEntreprise	=\''.$_SESSION['Login'].'\''; 
            $resultListeEquipe = mysqli_query($con,$sql);
            if ($resultListeEquipe && mysqli_num_rows($resultListeEquipe) > 0) 
            {
                while($valEquipe = mysqli_fetch_assoc($resultListeEquipe)) 
                {
                    $c++;?>
                    <div>
                        <?php 
                            $sqlType = 'SELECT * FROM TypeEquipeEntreprise WHERE  ID=\''.$valEquipe['TypeCourse'].'\''; 
                            $resultTypeEquipe = mysqli_query($con,$sqlType);
                                if ($resultTypeEquipe && mysqli_num_rows($resultTypeEquipe) > 0) 
                            {
                                while($valTypeEquipe = mysqli_fetch_assoc($resultTypeEquipe)) 
                                {
                                        echo $valTypeEquipe["NomType"]. " ". $valEquipe["NomEquipe"] ;

                                        break;
                                }
                            }
                        ?>
                        <table id="ListCoureurEquipe"><?php
                          $sqlInsc = 'SELECT * FROM inscription WHERE  Course=\''.$valTypeEquipe["Course"].'\'AND NomEquipe=\''.$valEquipe["NomEquipe"] .'\''; 
                            $resultInsc = mysqli_query($con,$sqlInsc);
                            if ($resultInsc && mysqli_num_rows($resultInsc) > 0) 
                            {
                                while($valInsc = mysqli_fetch_assoc($resultInsc)) 
                                {?>
                                <tr>
                                    <td><?php
                                        echo $valInsc["Nom"]. " " . $valInsc["Prenom"];
                                        ?>
                                    </td><?
                                }
                            }?>
                        </table>
                         <button type ="button" style="margin-right :10px;"
                        onClick="OpenPopUpAddEquipe" title="" 
                        data-toggle="tooltip" data-placement="right">
                        <i class="fa fa-check" style= "font-size: 50px;margin:9px;color: #4095f5;"></i>
                </button>
                    </div>
                    <?
                }
            }?>
</div>
<?
/*******************************************************************************************************************
 * 
 * Affichage coureur sélectionné
 * 
 ********************************************************************************************************************/
?>
<div id="formulaire">
    <fiedset id='UserSelected'>

        <h2> Athlète sélectionné</h2>
            <p id="lblInformation" style=" display:block;padding:5px; border-style: solid;height:20px; border-color: black; font-size:100%; ">Aucun athlète sélectionné</p>	
        </h2>
        <form method="post" action="ModificationMembres.php" id=FormInformation style="visibility:hidden; display:none" >
            <input type="hidden" name="ID" id="ID"   />
            <p><label style="vertical-alignement: center" for="nom">Nom *:</label> <input type="text" name="nom" id="nom" tabindex="10"   /></p>
            <p><label style="vertical-alignement: center" for="prenom">Prénom *:</label>  <input type="text" name="prenom" id="prenom" tabindex="20" /></p>
            <p><label style="vertical-alignement: center" for="mail">Adresse e-mail *:</label> <input type="text" name="email" id="email" tabindex="40" /></p>
            <p><label style="vertical-alignement: center" for="adresse">Adresse *:</label> <input type="text" name="adresse" id="adresse" tabindex="50"/></p>
            <p><label style="vertical-alignement: center" for="npa">NPA *:</label> <input type="text" name="zip" id="zip" tabindex="60" /></p>
            <p><label style="vertical-alignement: center" for="localite">Localité *:</label> <input type="text" name="ville" id="ville"tabindex="70" /></p>
            <p><label style="vertical-alignement: center" for="pays">Pays *:</label>  <input type="text" name="pays" id="pays"tabindex="80" /></p>	
            <p><label style="vertical-alignement: center" for="dateNaissance"> Année de Naissance * :</label> <input type="text" name="dateNaissance" id="DateNaissance"  />
            <p><label style="vertical-alignement: center" for="club">Club:</label> <input type="text" name="club" id="club"tabindex="100" /></p>
            <p><label style="vertical-alignement: center">Sexe * :</label><Select    onchange ="liste_depart(this.form);" name="sexe"   id="sexe" /> 
                    <option style="padding : 10px" value="">Sélectionner valeur</option>
                <option style="padding : 10px" value="H">Homme</option>
                <option style="padding : 10px" value="D">Dame</option>		
            </select></p>
            <a>
                <!-- Bouton validation information -->
                <button type ="button" style="float:right; margin-right :10px;"
                        onClick="checkForm(this.form)" title="Validations Informations" 
                        data-toggle="tooltip" data-placement="right">
                        <i class="fa fa-check" style= "font-size: 50px;margin:9px;color: #4095f5;"></i>
                </button>
            </a>
        </form>		
        <form method="post" action="DeleteMembre.php" id=FormDeleteInformation style="visibility:hidden; display:none">
            <input type="hidden" name="ID" id="IDDelete"  />
            <a><span> </span>
                <!-- Bouton delete information -->
                <button type ="button" style="float:left; margin-right :100px;" 
                    onClick="Suppform(this.form)" 
                    title="Modifications Informations" 
                    data-toggle="tooltip" data-placement="right">
                    <i class="fa fa-trash" style= "font-size: 50px;margin:9px;color: #FF0000;"></i>
                </button>
            </A>
        </form>
	</fieldset>
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
        <?
     }
?>
<script type="text/javascript">

function checkForm(f1) {
	if (f1.nom.value.length<3) {
		alert("Merci d'indiquer votre nom");
		f1.nom.focus();
		return false;
	}

		if (f1.prenom.value.length<3) {
		alert("Merci d'indiquer votre prénom");
		f1.prenom.focus();
		return false;
	}
	
		if (f1.zip.value.length<4) {
		alert("Merci d'indiquer votre npa");
		f1.zip.focus();
		return false;
	}
			if (f1.ville.value.length<3) {
		alert("Merci d'indiquer votre localite");
		f1.ville.focus();
		return false;
	}
			if (f1.sexe.value.length<1) {
		alert("Merci d'indiquer votre sexe");
		f1.sexe.focus();
		return false;
	}
			if (!isMail(f1.email.value)) {
		alert("Merci d'indiquer un mail valide pour que nous puissions vous répondre");
		f1.email.focus();
		return false;
	
	}
	if (f1.dateNaissance.value.length!=4) {
		alert("Merci d'indiquer votre année de naissance correct comme par exemple : 1988");
		f1.dateNaissance.focus();
		return false;
	}


	if (confirm("Etes-vous sur des informations de votre coureur?")) {
	f1.submit();
	}
}

function isMail(txtMail)
{
	var regMail=new RegExp("^[0-9a-z._-]+@{1}[0-9a-z. -]{2,}[.]{1}[a-z]{2,5}$", "i");
	return regMail.test(txtMail);
}
function addForm(f1) {

	f1.submit();
	
}
function Suppform(f1) {
if (confirm("Etes-vous supprimer ce coureur?")) {
	f1.submit();
	}
}
</script>