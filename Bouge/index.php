<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<?php include("carac.php"); ?> 
   <body>	
<?php include("en_tete.php"); ?> 
<<?php //include("MenuHorizontal.php"); ?> 

<Div id="corps">
<div class="box">
<div  class="para" style="background-color: rgba(235,86,88,0.5);" onmouseover="myOverFunction1()">
	<ul id="BlockIndex">
		<li><a><H2>Faiblesse?</H2></a></li>
	<!--<H2>Est-ce que c'est possible?  Comment y arriver? C'est trop dur!!!</h2>!-->

	</ul>
</div>


 <div  class="para"  style="background-color: rgba(51,221,131,0.5);" onmouseover="myOverFunction2()">
  <ul id="BlockIndex">
<li><h2>Manque de motivation?</h2></li>
 


</ul>
 </div>
	
<div   class="para" style="background-color: rgba(253,144,71,0.5);" onmouseover="myOverFunction3()">
  <ul id="BlockIndex">
<li><a><h2>Besoin de l'effet de groupe?</h2></a></li>



   </ul>
 </div>
</div>


</p>
<p id="demo"> Test</p>
 </div>
 
    </body>
	
	<script>
	function myOverFunction1()
	{
		  document.getElementById("demo").innerHTML = "<B>Raisons :</b> Maladie dirouique , déficience physique</br> <b>Solutions : </b> Suivi personalisé avec un programme à l'écoute des difficultés et des objectifs personnels.";
		
	}
		function myOverFunction2()
	{
		  document.getElementById("demo").innerHTML = "<B>Solutions :</b> Progression personalisée, possibilité  a travers un entraînement variéet de choisir plusieurs sport</br><b>objectif :</b> Réapprendre à bouger, puis de progresser dans l'activité qui vous plait. </br>";
		
	}
		function myOverFunction3()
	{
		  document.getElementById("demo").innerHTML = " -> Entrainement personalisé solo en groupe </br> -> Remise en forme </br> -> Cours de sport pour personne en situation de handicap </br>";
		
	}
	</script>
</html>
 

 





