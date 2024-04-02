<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="../styleV4.css" type="text/css"/>
    </head>
	 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
	 </script>
	 <script type="text/javascript" src="https://media.payrexx.com/modal/v1/modal.min.js"></script>
 <script src="../js/prototype.js" >

</script>

<script>

function showTime(){
var d = new Date();
var d = new Date();
var year = d.getFullYear();
var month = d.getMonth();
var date = d.getDate();
var day =d.getDay();
var hour = d.getHours();
var min = d.getMinutes();
var sec = d.getSeconds();
document.getElementById("Clock").innerHTML = hour+":"+min+":"+sec;

}
setInterval(showTime,1000);
function onReset(event) {
    document.getElementById("Dossard").value= "";
            document.getElementById("Dossard").select();
}
function onChange(event) {
  console.log(event.value)
	document.getElementById("Temps").value =document.getElementById("Clock").innerHTML;


	$('FormulaireDossard').request({
		onComplete: function(transport){
			var val =transport.responseText.evalJSON();
            //var result= $.parseJSON(transport); 
            console.log(val);

            TableauDetection(val);
         

	}        
	});

}
</script>

 <body>

<?php
$page = $_SERVER['PHP_SELF'];
$sec = "10";
header("Refresh: $sec; url=$page");

   include("HeaderAdmin.php"); 
?>
<p id="Clock" style="font-size:70px; text-align: center;" ></p>
<h3  class="title1"> Affichage Speaker Manuel </h3>

<div  id="TableauResulat">

<table id="mytable" style="width :100%">
<?
 $con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
 
 // Nombre de coureur dans la base de donnée
 mysqli_select_db($con ,'dxvv_jurachrono' );

$sql = 'SELECT * FROM ChronoManuel  ORDER  BY ID DESC';
	
	 $result = mysqli_query($con,$sql);
	 $c=0;
  
  
 if ($result && mysqli_num_rows($result) > 0) {

    while($donnees = mysqli_fetch_assoc($result)) 
    {
           $sql2 = 'SELECT * FROM LiveListeDepart WHERE NumDossard=\''.$donnees['Dossard'] .'\'';
        $result2 = mysqli_query($con,$sql2);
        if ($result2 && mysqli_num_rows($result2) > 0) 
        {

            while($donnees2 = mysqli_fetch_assoc($result2)) 
            { ?>
                <tr style="margin:20px;">
                <td style="font-size:50px;">
                <? echo $donnees['Dossard'] ?>
                </td>
                <td style="font-size:50px;">
                <? echo $donnees2['Nom'] ?>
                </td>
                <td style="font-size:50px;">
                <? echo $donnees2['Prenom'] ?>
                </td>
                <td style="font-size:50px;">
                <? echo $donnees['Temps'] ?>
                </td>
                </tr>

<?
            }
        }
        else
        {?>
            <tr>
            <td>
            <? echo$donnees['Dossard'] ?>
            </td>
            <td>
            <? echo $donnees['Temps'] ?>
            </td>
            <td>
            <? echo' ????' ?>
            </td>
            <td>
            <? echo' ????' ?>
            </td>
            </tr>  <?
        }

    }

 }
?>


</table>
</div>
</body>
</html>

