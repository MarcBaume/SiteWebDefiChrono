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
		<form method="get" action="../formulaireV3.php">
			<input type="hidden" name="DateCourse" id="DateCourse"   value= '<?php echo $_SESSION['DateCourse'] ?>' />
			<input type="hidden" name="NomCourse" id="NomCourse"  value= '<?php echo $_SESSION['Course']?>' />
			<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_SESSION['Nbretape'] ?>' />
			<input type="submit" value="Retourné au inscription de  <?php echo $_SESSION['Course'] ?>"  style= "padding: 10px ;height: 60px; font-size:120% ; cursor: pointer; Background:#00b4ff;"> 
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
	<form method="get" action ="AddMembres.php" style="float:right;"  >
    <Button  style="cursor: pointer; background:#00b4ff; " onClick="addForm(this.form)">
        <Table >
            <tr>
            <td style="text-align: center;">
        
                    <i class="fa fa-plus" style= "font-size: 50px;color: white;    width:100%;"></i>

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
		// Create table de donnée du nom de parcours
		mysqli_select_db($con,$row['Database']);

		$sql = 'SELECT * FROM Membres  WHERE LoginCompte=\''.$_SESSION['Login'].'\''; 

		//echo $sql;
		$result = mysqli_query($con,$sql);
 
		if ($result && mysqli_num_rows($result) > 0) 
		{
            $c= 0;
            ?>
                <h2> Liste d'athlète(s)</h2>
            <?
			//Chaque athlète on va créer un nom 
			while($val = mysqli_fetch_assoc($result)) 
			{?>
				<Fieldset id="<?php echo "user".$c ?>" onclick="funUserSelected('<?php echo $c ?>')" style="Display:inline-grid;cursor: pointer; width:20%; Background:#00b4ff; Broder:0px; margin : 5px; padding :2px; "> 

                <?
                    $c++
                ?> 

				<?php 
				if ($val['Valider'])
				{
                    $CmptValider++?>
                    <Table >
                        <tr>
                            <td>
                                <span class="dot" style="margin:5px;">
                                <?php if ($val ["sexe"] == "D")
                                {?>
                                     <i class="fa fa-user" style= "font-size: 22px;margin:9px;color: #d48def;"></i>
<?
                                }
                                else
                                {?>
                              <i class="fa fa-user" style= "font-size: 22px;margin:9px;color: #4095f5;"></i>
                               <? }?>
                             
                                </span>
                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <td>
                                          
                                        <p  style="display:block; border-color: black; padding: 0px; font-size:100%;"><? echo $val ["Nom"]?></p>	
                                        </td>
                                  </tr>
                                  <tr>
                                        <td>
                                            <p style="display:block;border-color: black;padding: 0px; font-size:100%;"><? echo $val ["Prenom"]?></p>	
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
                                <span class="dot" style="margin:5px;">
                                <i class="fa fa-user" style= "font-size: 22px;margin:9px;color: red;"></i>
                                </span>
                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <td>
                                        <p  style="display:block; border-color: black;padding: 0px; font-size:100%;"><? echo $val ["Nom"]?></p>	
                                        </td>
                                        <td>
                                            <p style=" display:block; border-color: black;padding: 0px; font-size:100%;"><? echo $val ["Prenom"]?></p>	
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

            <a><span> </span>
                <!-- Bouton validation information -->
                <button type ="button" style="float:right; margin-right :10px;"
                        onClick="checkForm(this.form)" title="Validations Informations" 
                        data-toggle="tooltip" data-placement="right">
                        <i class="fa fa-check" style= "font-size: 50px;margin:9px;color: #4095f5;"></i>
                </button>
            </A>
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

    <script>
console.log(ArrayCoureurs);
  </script>
</center>
	
	</div>
</div>
    </body>
</html>

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