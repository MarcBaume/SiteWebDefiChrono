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
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="css/style.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
 </script>
 <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
 <link rel="stylesheet"   href="https://fonts.googleapis.com/css?family=Open Sans">
<script src="js/prototype.js" ></script>
<script src="js/FonctionDefiChrono2.js?v=1"></script>
</script>
<script>


function getPixel( x, y) {

  imageData =  context.getImageData(x, y, 1, 1);

   var r = dec2Hex( imageData.data[0]);
var g = dec2Hex(imageData.data[ 1]);
var b =dec2Hex( imageData.data[2]);

return ("#"+r+g+b);

}

	function canvasRace(idCanvas, NomCourse,DateCourse,Lieu,PathDir)
	{
		console.log(idCanvas);
		var canvas=document.getElementById(idCanvas);
		var ctx= canvas.getContext("2d");
		ctx.font="Bold 24pt Rubik";
		// Rounded rectangle with 40px radius (single element list)
		ctx.fillStyle = "#406CA4";
		ctx.beginPath();
		ctx.roundRect(20, 20, 720, 210, [20]);
		ctx.fill();
		ctx.beginPath();
		// Carrée pour logo image
		ctx.fillStyle = "#fff";
		ctx.roundRect(40, 40, 170, 170, [20]);
		ctx.fill();
		ctx.beginPath();
		// titre 
		ctx.fillStyle = "#fff";
		ctx.roundRect(60, 40, 660, 60, [20]);
		ctx.fill();
		ctx.fillStyle = "#406CA4";
		ctx.fillText(NomCourse,220,82);

		ctx.beginPath();
		ctx.fillStyle = "#fff";
		ctx.roundRect(170, 80, 60, 60, [20]);
		ctx.fill();
		ctx.beginPath();
		ctx.fillStyle = "#406CA4";
		ctx.roundRect(210, 100, 60, 60, [20]);
		ctx.fill();
		var couverture = new Image();
		couverture.src = PathDir + "/logo.jpg"
		console.log(couverture.src);
		couverture.onload = function() {
	
			var ratio = couverture.height /(couverture.height -90);
			var widthImg =  couverture.width - (couverture.width / ratio);
			console.log(widthImg)
			// Si le logo  est trop grand on raccourci ça taille
			if (widthImg > 200)
			{
			    ratio = couverture.height /(couverture.height -60);
			    widthImg =  couverture.width - (couverture.width / ratio);
				ctx.drawImage( couverture, 700- (widthImg ), 120,widthImg,60 );
			}
			else
			{
		 		ctx.drawImage( couverture, 700- (widthImg ), 120,widthImg,90 );
			}

		 }

		//document.getElementById("BorderLogo").style.border  = "5px solid "+ getPixel( 1, 1);
	
		 var logo = new Image();
		logo.src = PathDir + "/couvertureAccueil.jpg"
		logo.onload = function() {
			// Taille  height image maximum 100
			var ratio = logo.width /(logo.width -150);
			var widthImg =  logo.height - (logo.height / ratio);
			console.log(widthImg)
		 	ctx.drawImage( logo,50, 50,150,150 );
		 }
		 if 
		  var typeRace1 = new Image();
		typeRace1.src =   "Icones/Defi_Coureur.svg"


		typeRace1.onload = function() {
		 	ctx.drawImage( typeRace1, 665, 47,45,45 );
		 }

		 ctx.font="20pt Rubik";
		 ctx.fillStyle = "#fff";
		 		ctx.fillText(DateCourse,280,150);

		 		  var calIco = new Image();
		calIco.src =   "Icones/calender.svg"
		calIco.onload = function() {
		 	ctx.drawImage( calIco, 230, 120,35,35 );
		}

		 		ctx.fillText(Lieu,280,200);

			  var posIco = new Image();
		posIco.src =   "Icones/position.svg"
		posIco.onload = function() {
		 	ctx.drawImage( posIco, 230, 170,25,35 );
		 }
		

	}
		
	</script>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>
<body>
	<?php

  include("Header2023.php"); 
  ?>
	<?php
	$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
if (!$con)
{
  die('Could not connect: ' . mysql_error());
}
else
{
  
	mysqli_select_db($con ,'dxvv_jurachrono' );  
	$sql = "SELECT * FROM Course ORDER BY Date DESC";
	$result = mysqli_query($con,$sql);
	if ($result && mysqli_num_rows($result) > 0) 
	{
		// output data of each row
		while($val = mysqli_fetch_assoc($result)) 
		{
			
			$timestamp = strtotime($val ["Date"]);
			$Date =  date_parse($val ["Date"]);
			$Year = $Date['year']; 
			$Month = $Date['month']; 
			$Day = $Date['day']; 
			$chemin= 'courses/'.$val ["Nom_Course"].$Year."/info/images";?>
			
			<canvas id="<?php echo "canvas". $val ["Nom_Course"].$Year?>" width="800" height="250">
			
			</canvas>
			<script>
				canvasRace(
					<?php echo json_encode("canvas". $val ["Nom_Course"].$Year); ?>,
				 	<?php echo json_encode( $val ["Nom_Course"]); ?>,
				 	<?php echo json_encode(strftime ("%d",$timestamp)." ".strftime ("%B",$timestamp) );?>,
				  	<?php echo json_encode($val ["Lieu"]);?>,
				  	<?php echo json_encode( $chemin);?>)
			</script>
		<?php
		}
	}
}
	?>
	
</body>
</html>