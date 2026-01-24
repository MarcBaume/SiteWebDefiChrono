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
	<link rel="stylesheet" title="defaut" media="screen" href="../../css/style.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
 </script>
 <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
 <link rel="stylesheet"   href="https://fonts.googleapis.com/css?family=Open Sans">
<script src="../../js/prototype.js" ></script>
<script src="../../js/FonctionDefiChrono2.js?v=1"></script>
</script>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>
    <body>
<?	include("MenuInscriptions.php"); ?>

    <script>

</script>

<div id="corps">
<Fieldset>
<div id="formulaire">

<form method="get"  id="FormulaireAddCode" name="FormulaireAddCode" action="CibeAddCodeReduction.php" >
	<input type="hidden" name="DateCourse" id="DateCourse"   value= '<?php echo $_GET['DateCourse'] ?>' />
	<input type="hidden" name="NomCourse" id="NomCourse"  value= '<?php echo $_GET["NomCourse"]  .$ANNEE_COURSE ?>' />

<!-- Tableau information du coureurs à inscrire !-->
    <div id="InformationsCoureurs">
        <h3> Formulaire d'ajout de code de réduction : <? echo  $_GET["NomCourse"] .$ANNEE_COURSE ?>
        </h3>		
                <label for="Code">Code</label>
            <input type="text" name="Code" id="Code" />
            <p>
			<label>Code Nominatif</label>
           <input type="radio" name="TypeCodeReduc" onChange="ChangeTypeNominatif()" id="ChoiceNameYes" />
            <label for="ChoiceNameYes">Oui</label>

            <input type="radio" name="TypeCodeReduc" onChange="ChangeTypeNominatif()" id="ChoiceNameNo" />
			<label for="ChoiceNameNo">Non</label>
            </P>
            <p id="ParaTypeNominatif" style="display:none">
                    <label for="NomCode">Nom</label>
            <input type="text" name="NomCode" id="NomCode" />
                 <label for="PrenomCode">Prénom</label>
            <input type="text" name="PrenomCode" id="PrenomCode" />
</p>
			<label for="ChoiceNameNo">Nombre de fois que le code existe</label>
			<input type="text" name="NbrCode" id="NbrCode" />
            <p>
            <label>Type de code de réduction</label>

            <input type="radio" name="ChoiceTypeCode" id="ChoiceTypeCodeValue" />
            <label for="ChoiceTypeCodeValue">Valeurs</label>

            <input type="radio" name="ChoiceTypeCode" id="ChoiceTypeCodeEtape" />
			<label for="ChoiceTypeCodeEtape">Etape(s)</label>

            <input type="radio" name="ChoiceTypeCode" id="ChoiceTypeCodeProCent" />
			<label for="ChoiceTypeCodeProCent">%</label>
</p>
            <label for="DateLimit">Code valeur</label>
            <input type="number" name="ValueCode" id="ValueCode" />

            <label for="DateLimit">Date d'expiration</label>
            <input type="datetime-local" name="DateLimit" id="DateLimit"/>
            <input type="button" onclick="sendFormCheck()"/>
</form>
<script>
function sendFormCheck()
{
    valCode =   parseInt(document.getElementById("ValueCode").value) ;
    console.log(valCode);
    if (document.getElementById("ChoiceTypeCodeEtape").checked )
    {
           document.getElementById("ValueCode").value = valCode + 9990;    
    }
    else if (document.getElementById("ChoiceTypeCodeProCent").checked )
    {
        document.getElementById("ValueCode").value = valCode + 8000;
    }

    FormValue = document.getElementById("FormulaireAddCode");
    FormValue.action="CibleAddCodeReduction.php"
    console.log(FormValue);
    $('FormulaireAddCode').request({
            onComplete: function(transport){
                val =transport.responseText.evalJSON();
                console.log(val); 
            }
    });
}

function ChangeTypeNominatif()
{
    if (document.getElementById("ChoiceNameYes").checked )
    {
        document.getElementById("ParaTypeNominatif").style.display = "block";
    }
    else
    {
        document.getElementById("ParaTypeNominatif").style.display = "none";
    }
}
function ReadCodeReduction()
{
    FormValue = document.getElementById("FormulaireAddCode");
    FormValue.action="ReadListesCodeReduction.php"
    console.log(FormValue);
    $('FormulaireAddCode').request({
            onComplete: function(transport){
                val =transport.responseText.evalJSON();
                console.log(val); 
            }
    });
}
ReadCodeReduction()
</script>
