<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="styleV2.css" type="text/css"/>
	<!-- Import Leaflet CSS Style Sheet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
<!-- Import Leaflet JS Library -->
<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
<script src="../js/prototype.js" ></script>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>
<?php 
setlocale (LC_TIME, 'fr_FR.utf8','fra');?>

    <body >

	<?php
	  include("Header.php"); 
	  ?>


 


<div id="corps">
<?php include("HeaderInfo.php"); ?>

	<h2>	Informations  <?php  echo $NOM_COURSE. ' ' . $ANNEE_COURSE ?>  </h2>
  
	<div id="Information">
	<?php $Nbr_etape = intval ($val ["nbr_etape"]);		
	// ******************** POUR COURSE 1 ETAPE **********************************/		
if ($Nbr_etape < 2)
{?>
	
  <p> <b>  Date : </b><?php echo  strftime('%A %d %B %Y ',strtotime($val ["Date"]));?> </P>
  <p>  <b> Lieu : </b><?php echo $val ["Lieu"] ?> </P>
  <p>  <b> Emplacement : </b><?php echo $val ["Emplacement"] ?> </P>
 
 <?php 
 } 
 // ******************** POUR COURSE PLUSIEURS ETAPES **********************************/		
 ?>
 <p  id="LblInformation"> <b> Organisateur : </b> <?php echo $val ["Organisateur"] ?> </P>
 <p>  <b> Site Web :  </b><?php echo $val ["Site"] ?> </P>
 <p>  <b>  Contact :  </b> <?php echo $val ["Email"] ?></P>
<p>

<!--********* ETATS DES INSCRIPTIONS *****-->
  <?php $today = date("Y-m-d H:i:s");  
if ($val ["InscriptionExtern"] )
{
	?> Les inscriptions s'effectue sur le site de l'organisateur
<?php
}
else if ($today >$val ["Date"] )
{
	echo 'Course Terminé';
}
else if ( $today > $val ["DATE_END_INSCRIPTION"] )
{
	?> Inscriptions fermée ,  il est toujours possible de s'inscrire sur place
<?php
}
else
{
	$Dateend =  date_parse($val ["DATE_END_INSCRIPTION"]);?> 	
<b>	Inscriptions : </b> </br></br>
 Les inscriptions en ligne sont ouvertes jusqu'au : 
<?php
	echo strftime('%A %d %B %Y       %H:%M',strtotime($val ["DATE_END_INSCRIPTION"])) ;
 ?>
</br>
</br>
<?php 

 if (  $val ["NO_INSCRIPTIONS_SUR_PLACE"])
{
?>
Il est impossible de s'inscrire sur place</br>
<?php
}
else
{
?>
Les inscriptions sur place sont aussi possibles mais peuvent entraîner une majoration de prix</br>

<?php	
}
}?>
</p>

	<?php if (! strlen($val ["InscriptionExtern"] ))
{ ?>
<div class="title"> Paiement :</div>
	<Fieldset>

		Le paiement de votre inscription s'effectue sur place </br>
	</Fieldset>


<!-- SI IL Y A UNE DESCRIPTION -->
<?php
}
 if ( strlen($val ["Description"] ) > 1)
{ ?>
<div class="title">Description :</div>
	<p>

		<?php echo $val ["Description"] ?>
		</p>

<?php
}

if ( strlen($val ["Informations"] ) > 1)
{ ?>
  <div class="title"> Informations </Div>
  <Fieldset>

	<?php echo $val ["Informations"] ?> 
  </Fieldset>
	<?php
}
if ( strlen($val ["Video"] ) > 1)
{ ?>
  <div class="title"> Vidéo tutoriel :</div>
 <Fieldset>

<center>
<iframe width="75%" height="400"
src="<? echo 'https://www.youtube.com/embed/'.  $val ["Video"]?>">
</iframe>
</Fieldset>
</center>
<?php
}
 ?>
 <script>

var ArrayCoureurs = [];
var ArrayParcours = [];
var ICounterCoureurs = 0;

	var TotalDiminution = 0;
	var TotalELevation = 0;
	var StartElevation = 0;
	var ElevationMin = 10000;
	var ElevationMax = 0;
	var TotalKM = 0;
	
	var Width  = 800;//133 screen.width -200; // 1300
	var Height = (Width /100) *18;
	var DecalageStartWidth = 50; // Valeur de décalage du commencement du graphique en horizontal
	var DecalageStartHeight = 50; // Valeur de décalage du commencement du graphique en vertical
var indexPassage = 1;
/*_____________________________________________________________________

			Enregistrement sur le "coordonnée"	des valeur de position du text sur le graphique de dénivellé 
_____________________________________________________________________*/

function ChangOffsetText()
{
	$('formOffset').request({
		onComplete: function(transport){
		console.log('1');
			var errors = transport.responseText.evalJSON();
			var message = "";
			
			for (var id in errors)
			{
				console.log("id" + errors[id]);
				message = message+ "\n - "+ errors[id];
			}
					console.log(message);
			if (message = "")
			{
				alert("Félicitations !");
			}
			else
			{
				alert("Veuillez vérifier les champs suivants : "+ message);
			}
		
		}
	});
}




function TableResume(IDSVG, ColimgEtapePara)
{
	
	TableTotal2 = document.createElement('Table');
	TableTotal2.style.width ="100%";
	tr1 = document.createElement('Tr');
	
	td1 = document.createElement('Td');
	td1.style.width = "20%";
	td1.innerHTML = "Total distance : ";
	tr1.append(td1);
	
	td2 = document.createElement('Td');
	td2.style.width = "15%";
	td2.setAttribute("id", IDSVG+"TotalKM");
	tr1.append(td2);
	
	td3 = document.createElement('Td');
	td3.style.width = "20%";
	td3.innerHTML = "Total D+ : ";
	tr1.append(td3);
	
	td4 = document.createElement('Td');
	td4.style.width = "15%";
	td4.setAttribute("id", IDSVG+"ELevationTotal");
	tr1.append(td4);
	
	td5 = document.createElement('Td');
	td5.style.width = "20%";
	td5.innerHTML = "Total D- : ";
	tr1.append(td5);
	
	td6 = document.createElement('Td');
	td6.style.width = "15%";
	td6.setAttribute("id", IDSVG+"DiminutionTotal");
	tr1.append(td6);
	TableTotal2.append(tr1);
	
	tr2 = document.createElement('Tr');
	
	td11 = document.createElement('Td');
	td11.style.width = "20%";
	td11.innerHTML = "altitude Min : ";
	tr2.append(td11);
	
	td12 = document.createElement('Td');
	td12.style.width = "15%";
	td12.setAttribute("id", IDSVG+"ElevationMin");
	tr2.append(td12);
	
	td13 = document.createElement('Td');
	td13.style.width = "20%";
	td13.innerHTML = "altitude Max :";
	tr2.append(td13);
	
	td14 = document.createElement('Td');
	td14.style.width = "15%";
	td14.setAttribute("id", IDSVG+"ElevationMax");
	tr2.append(td14);
	TableTotal2.append(tr2);
	
	ColimgEtapePara.append(TableTotal2);
	
}

function mapSvg(IDSVG, FileName, ColimgEtapePara)
{

	indexPassage = 1;
	

	
	TableTotal = document.createElement('Table');
	TableTotal.style.width ="80%";
	TableTotal.setAttribute("id", IDSVG+"ImageMap");
	
		if ( screen.width>  800 )
	{
			Width  = 800; // 1300-200; // 1300
	}
	else
	{
		Width  =  screen.width ; // 1300-200; // 1300
	}
	let box = document.querySelector('div');
 Width = box.offsetWidth - 200;



	tr1 = document.createElement('Tr');
	td1 = document.createElement('Td');
	
	
	divMap = document.createElement('div');
	divMap.style.height ="300px";
	divMap.setAttribute("id", IDSVG+"my_osm_widget_map");
	
	td1.append(divMap);
	tr1.append(td1);
	TableTotal.append(tr1);
	
	tr2 = document.createElement('Tr');
	td2 = document.createElement('Td');
	
	divGraph = document.createElement('div');
	divGraph.style.height ="300px";
	divGraph.setAttribute("id", IDSVG+"conteneurSVG");
	
	td2.append(divGraph);
	tr2.append(td2);
	TableTotal.append(tr2);
	
	ColimgEtapePara.append(TableTotal);
	TableResume(IDSVG, ColimgEtapePara);

}
function AddSvg(IDSVG, FileName)
{

/*** ZONE DE DESSIN **/
 var GraphiqueSVG = document.createElementNS("http://www.w3.org/2000/svg",'svg');

    GraphiqueSVG.style.width = (Width + (DecalageStartWidth*2) ) +'px';
    GraphiqueSVG.style.height = (Height + (DecalageStartHeight*2))+'px';
    GraphiqueSVG.id = IDSVG+'image1';
	
   // GraphiqueSVG.style.position = 'absolute';
  //  GraphiqueSVG.style.top = '50px';
//	GraphiqueSVG.style.Right = '50px';

	var conteneur = document.getElementById(IDSVG+"conteneurSVG");
	conteneur.style.height = (Height + (DecalageStartHeight*2))+'px';
    conteneur.appendChild(GraphiqueSVG);


	
/***************************************** READ FCIHIER GPX *******************************************
*																															*
*																															*
*																															*
*																															*
****************************************************************************************************/	
	var CountPassage = 0;
 // Create a connection to the file.
  var Connect = new XMLHttpRequest();
  // Define which file to open and
  // send the request.
  //Connect.open("GET", "test2.xml", false);
  Connect.open("GET", FileName, false);
  Connect.setRequestHeader("Content-Type", "text/xml");
  Connect.send(null);
  // Place the response in an XML document.
  var TheDocument = Connect.responseXML;
  // Place the root node in an element.
  var Customers = TheDocument.childNodes[0];

  // Retrieve each customer in turn.
	var LastPoint = null;
	 TotalKM = 0;
	 TotalDiminution = 0;
	 TotalELevation = 0;
	 StartElevation = 0;
	 ElevationMin = 10000;
	 ElevationMax = 0;
	var ArrayPoint = [];
	var NombreKMH = 9.2;
	var HeureDepart = 5;
	var JourDepart = 4;
	var MoisDepart = 'Juillet';
	for (var i = 0; i < Customers.children.length; i++)
	{
		
	   var Trk = Customers.children[i];

		
		if (Trk.tagName == "trk")
		{
			for (var j = 0; j < Trk.children.length; j++)
			{
				var TrkSeg = Trk.children[j];
			//console.log(TrkSeg);
				for (var m = 0; m < TrkSeg.children.length; m++)
				{
					// ** Modifier comparer a read gpx du tour du jura
			
					var x = TrkSeg.children[m].getElementsByTagName("ele")[0];
						if (x!= undefined)
						{
						var y = x.childNodes[0];
						var elevation = y.nodeValue;
					
						//****** CALCUL ELEVATION MINIMUM ******/
						if (parseFloat(elevation) < ElevationMin)
						{
							ElevationMin = elevation;							
						}
						// ****** CALCUL ELEVATION MAX *******/
						
						if (parseFloat(elevation) > ElevationMax)
						{
							ElevationMax = elevation;
						}
			
						var lat =  TrkSeg.children[m].attributes.getNamedItem("lat").value ;
						var lon =  TrkSeg.children[m].attributes.getNamedItem("lon").value ;

						/*** CALCUL DISTANCE ENTRE DEUX POINT SANS DENIVELATION **/
						var point = new Object();
						if (LastPoint != null)
						{
							var KM =	distance(LastPoint.Lat , LastPoint.Lon,lat,lon);
							point.elevation = elevation;
							
							TotalKM = TotalKM+ KM;
							DiffElevation = 0;
							DiffDiminution = 0;
							if (parseFloat(point.elevation) > parseFloat(LastPoint.elevation))
							{
								DiffElevation = parseFloat(point.elevation) - parseFloat(LastPoint.elevation);
							}
							else
							{
								DiffDiminution = (parseFloat(LastPoint.elevation) - parseFloat(point.elevation))*-1;
							}
							point.TotalDiminution = parseFloat(LastPoint.TotalDiminution) + parseFloat(DiffDiminution);
							point.TotalELevation = parseFloat(LastPoint.TotalELevation) + parseFloat(DiffElevation);
							TotalELevation = point.TotalELevation;
							TotalDiminution =  point.TotalDiminution;
							point.Lat = lat;
							point.Lon = lon;
							point.KM = TotalKM;

						}
						else // ****** KM 0 ********
						{
							point.elevation = elevation;
							point.TotalELevation = 0;
							point.TotalDiminution = 0;
							point.Lat = lat;
							point.Lon = lon;
							point.KM = 0;
							StartElevation = elevation;
							
							//**** CREATION DÙNE CARTE ****/
							var mymap = L.map(IDSVG+'my_osm_widget_map', { /* use the same name as your <div id=""> */
							center: [point.Lat, point.Lon], /* set GPS Coordinates */
							zoom: 14, /* define the zoom level */
							zoomControl: true, /* false = no zoom control buttons displayed */
							scrollWheelZoom: true /* false = scrolling zoom on the map is locked */
							});
						L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
						//L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/[x]/{y}.png', { /* set your personal MapBox Access Token */
						maxZoom: 30, /* zoom limit of the map */
						attribution: ' <a href="http://openstreetmap.org/copyright">OpenStreetMap</a>'}).addTo(mymap);
						}
						// AJout du ponit au tableau
						point.index = ArrayPoint.length;
						ArrayPoint.push(point);
						
						///* Mise en mémoire de la position pour le prochaine calcul **)
						LastPoint = point;
					}
				}
			}

			FeneterElevation = (ElevationMax - ElevationMin);
			console.log(ElevationMin + " Min D-");
			console.log(ElevationMax + " Max D+");
			console.log(TotalELevation + "D+");
			console.log(TotalDiminution + "D-");
			console.log(TotalKM  + " km");
			
			var TxtTotalKM = document.getElementById(IDSVG+"TotalKM");
			TxtTotalKM.innerHTML  = (parseInt(TotalKM *10)/10) + ' km';
			var TxtElevationMin = document.getElementById(IDSVG+"ElevationMin");
			TxtElevationMin.innerHTML  = Math.round(ElevationMin,2) + ' m';
			var TxtElevationMax = document.getElementById(IDSVG+"ElevationMax");
			TxtElevationMax.innerHTML  = Math.round(ElevationMax,2) + ' m';
			var TxtTotalElevation = document.getElementById(IDSVG+"ELevationTotal");
			TxtTotalElevation.innerHTML  = Math.round(TotalELevation,2) + ' m';	
			var TxtTotalDiminution = document.getElementById(IDSVG+"DiminutionTotal");
			TxtTotalDiminution.innerHTML  = Math.round(TotalDiminution,2) + ' m';			

		}
	}
	LastPoint = null;
	/*____________________________________________________________________________________________
	*																															*
		CREATION AFFICHAGE SELON LE TABLEAU DE POINT LU DANS LE FICHIER GPX 

	_____________________________________________________________________________________*/	

	/********* LEcture de chaque point sur le fichier et transformation 
	en valeur en Pourcent pour affichage
	 au meme format de chaque fichier GPX *******/
	 
	for (var i = 0; i < ArrayPoint.length; i++)
	{
		var Point = ArrayPoint[i];
		if ( LastPoint != null )
		{
			// Premier point
			if (i ==1)
			{
				AddPoint ( LastPoint, Point, mymap, GraphiqueSVG, true,false );
			}
			// Point finish
			else if (i == ArrayPoint.length-1 )
			{
				AddPoint ( LastPoint, Point, mymap, GraphiqueSVG, false,true );
			}
			else 
			{
				AddPoint ( LastPoint, Point, mymap, GraphiqueSVG, false,false );
			}
		}
		LastPoint = Point;
	}	

	/************* AJOUT LIGNE Vertical Coordonnée Y DENIVELATION **************/

	 intElevation = parseInt(ElevationMin / 100)
	 // Ligne tous les 100 mètres
	ValueElevationArrondi = intElevation * 100;

	while (ValueElevationArrondi < ElevationMax )
	{
		AddLigneElevation(ValueElevationArrondi, GraphiqueSVG );	
		
		ValueElevationArrondi = ValueElevationArrondi +100;
	}

	/************* AJOUT LIGNE Horizontal Coordonnée X KM **************/
	if (TotalKM >50)
	{
	/*** Ajout Thick ligne tous les 10 km ***/
	NbrPart = parseInt(TotalKM/10);
	partKM = TotalKM / (TotalKM/10);
	}
	else if (TotalKM >25)
	{
	/*** Ajout Thick ligne tous les 5 km ***/
	NbrPart = parseInt(TotalKM/5);
	partKM = TotalKM / (TotalKM/5);
	}
	else 
	{
	/*** Ajout Thick ligne tous les km ***/
	NbrPart = parseInt(TotalKM/1);
	partKM = TotalKM / (TotalKM/1);
	}
	for (var i = 0; i < NbrPart +1; i++)
	{
		AddLigneVertical(partKM * i,  GraphiqueSVG );	
	}
}
function TransformDistanceEnPxl(Value)
{
	// Valeur = 1%
	Value1PourCent =	TotalKM / 100;
	// Calcule %  du Nombre de km
	ValuePourCent =	( Value ) / Value1PourCent;
	// Grandeur de la fenetre en poucent avec echelle max
	return	ValuePourCent * (Width / 100);
}

function TransformElevationEnPxl (Value)
{
	
	// Si Plus de 50 mètres de dénivellé
	if (FeneterElevation > 50)
	{
	// Valeur = 1%
	Value1PourCent =	FeneterElevation / 100;
	// Calcule %  de l'élévation
	ValuePourCent =	( Value - ElevationMin) / Value1PourCent;

	}
	else
	{
	// Valeur = 1%
	Value1PourCent =	FeneterElevation / 10;
	// Calcule %  de l'élévation
	ValuePourCent =	( Value - ElevationMin) / Value1PourCent;
	}

	// Grandeur de la fenetre max
	return	Height - (ValuePourCent * (Height / 100  ));
}

var TextSelected; 
var LastPassage = new Object();
// Numéro du passage trouver pour ce point
var IDPassageFind = 0;


/***** FUNCTION AJOUT DE POINT SUR LES DESSINS ****/
function AddPoint(LastPoint, Point ,mymap , GraphiqueSVG, xStart, xFinish)
{
	// Position de la ligne déniveller 
	posX1 = TransformDistanceEnPxl(LastPoint.KM) + DecalageStartWidth;
	posY1 =	TransformElevationEnPxl(LastPoint.elevation) + DecalageStartHeight;
	posX2 =	TransformDistanceEnPxl(Point.KM) + DecalageStartWidth;
	Posy2 =	TransformElevationEnPxl(Point.elevation) + DecalageStartHeight;
	
	
//	console.log(LastPoint.elevation); 
	
	// AJOUT LIGNE ENTRE POINT PRECEDENT ET POINT SUIVANT  SUR LA CARTE
	var polylinePoints = [
        [LastPoint.Lat, LastPoint.Lon],
        [Point.Lat, Point.Lon]
      ];    
      
	// Couleur ligne parcours
	var color; 
	var r = Math.floor(38);
	var g = Math.floor(ValuePourCent*2.5);
	var b = Math.floor(251);
	if (xStart)
	{
		// Ajout Marker à position trouver
		var greenIcon = new L.Icon({
			iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
			shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
			iconSize: [25, 41],
			iconAnchor: [12, 41],
			popupAnchor: [1, -34],
			shadowSize: [41, 41]
		});
		L.marker([Point.Lat, Point.Lon], {icon: greenIcon}).addTo(mymap);
	}
	if (xFinish)
	{
		// Ajout Marker à position trouver
		var greenIcon = new L.Icon({
			iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
			shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
			iconSize: [25, 41],
			iconAnchor: [12, 41],
			popupAnchor: [1, -34],
			shadowSize: [41, 41]
		});
		L.marker([Point.Lat, Point.Lon], {icon: greenIcon}).addTo(mymap);
	}
	color= "rgb("+r+" ,"+g+","+ b+")"; 
	var polyline = L.polyline(polylinePoints, {color: color}).addTo(mymap);

//	polyline.getId ('id', 'LineParcours'+ index ); ne fonctionne pas
	polyline.addEventListener('click dblclick', function(e) {
		document.getElementById("Lat").value = LastPoint.Lat ;
	  	document.getElementById("Len").value = LastPoint.Lon;
		document.getElementById("ele").value = LastPoint.elevation;
		document.getElementById("dist").value = LastPoint.KM;
    });


/*
		/******** AJOUT LIGNE BLANCHE POUR MASQUER LE DEGRADER **
	var maLigneMasque = document.createElementNS("http://www.w3.org/2000/svg",'line');	
	maLigneMasque.setAttribute('x1', posX1+ 'px');
    maLigneMasque.setAttribute('y1', posY1 + 'px');
    maLigneMasque.setAttribute('x2', posX2 +'px');
    maLigneMasque.setAttribute('y2', '0px');
    maLigneMasque.setAttribute('stroke','#ffffff');
    maLigneMasque.setAttribute('stroke-width',2);
    maLigneMasque.setAttribute('stroke-linecap','round');
	GraphiqueSVG.appendChild(maLigneMasque);***/
	
	/****** AJOUT LIGNE DU GRAPHIQUE ELEVATION****/
	var maLigne1 = document.createElementNS("http://www.w3.org/2000/svg",'line');
	
	maLigne1.setAttribute('id', 'LineElevation'+ Point.index );
	maLigne1.setAttribute('x1', posX1+ 'px');
	maLigne1.setAttribute('y1', posY1 + 'px');
	maLigne1.setAttribute('x2', posX2 +'px');
	maLigne1.setAttribute('y2', Posy2 +'px');
	maLigne1.setAttribute('stroke','#2680fb');
	maLigne1.setAttribute('stroke-width',3);
	maLigne1.setAttribute('stroke-linecap','round');
	
	GraphiqueSVG.appendChild(maLigne1);
	/* Evénement ligne elevation */
	document.getElementById('LineElevation'+ Point.index).addEventListener('click', function(e) 
	{
		e.currentTarget.setAttribute('stroke', '#ff00cc');
		e.currentTarget.setAttribute('stroke-width', 10);
		document.getElementById("Lat").value = LastPoint.Lat ;
	  	document.getElementById("Len").value = LastPoint.Lon;
		document.getElementById("ele").value = LastPoint.elevation;
		document.getElementById("dist").value = LastPoint.KM;
	});
	
	
}
 
function convertNumToTime(number) {
	
	var hour =  0;
	var jour = 0;
	var time = '';
	if (number > 1)
	{
		var Minute = Math.floor(number);
		if (Minute >59)
		{
			
			 hour = Math.floor(number/60);
			 Minute  = Minute  - hour*60;
			// SI plus de un jour
			if (hour > 23)
			{
				jour = hour % 24;   
				hour =	hour - (jour *24);
				time = jour +'j ' ;
			}
		}
		time = time + Length2(hour) + ':' + Length2(Minute) ;
	}
	else
	{
		time = '00:' ;
	}
	
	 

	 return time;
 
}
function Length2(value)
{
	var sValue = value.toString();
	if (sValue.length < 2)
	{
		sValue = '0'+ sValue;
	}
	return sValue;
}
function convertNumToDate(number, HeureDepart, JourDepart, MoisDepart) {
	
	var hour =  0;
	var jour = 0;
	var time = '';
	if (number > 1)
	{
		var Minute = Math.floor(number);
		if (Minute >59)
		{
			hour = Math.floor(number/60) ;
			Minute  = Minute  - (hour*60);
			hour = hour + HeureDepart ;
			// SI plus de un jour
			if (hour > 23)
			{
				jour =  Math.floor(hour / 24);   
				hour =	hour - (jour *24);
				time = (jour + JourDepart) +' '+ MoisDepart + ' ' + Length2(hour) + ':' + Length2(Minute)  ;
			}
			else
			{
				time = (JourDepart) +' '+ MoisDepart + ' ' + Length2(hour) + ':' + Length2(Minute)  ;
			}
		}
		else
		{
			hour = HeureDepart;
			
			time = (JourDepart) +' '+ MoisDepart + ' ' + Length2(hour) + ':' + Length2(Minute)  ;
		}
	}
	else
	{
		hour = HeureDepart;
		time = (JourDepart) +' '+ MoisDepart + ' ' + Length2(hour) + ':' + Length2(Minute)  ;
	}
	
	 

	 return time;
 
}
/** FUNCTION DESSINER LA LIGNE DE DISTANCE *************/
function AddLigneVertical( value, GraphiqueSVG )
{
		
	var DistancenPxl = TransformDistanceEnPxl(value) + DecalageStartWidth;
	/*** AFFICHAGE TEXT AU DöBUT DE LA LIGNE *****/
	var HeightLine = Height + DecalageStartHeight;
	var newText = document.createElementNS("http://www.w3.org/2000/svg",'text');
	newText.setAttributeNS(null,"x", (DistancenPxl -10) +'px');     
	newText.setAttributeNS(null,"y", (HeightLine+20) +'px'); 
	newText.setAttributeNS(null,"font-size","12");
	
	var textNode = document.createTextNode(Math.round(value));
	newText.appendChild(textNode);
	GraphiqueSVG.appendChild(newText);


	var maLigne1 = document.createElementNS("http://www.w3.org/2000/svg",'line');
    maLigne1.setAttribute('x1', DistancenPxl + 'px');
    maLigne1.setAttribute('y1', (HeightLine -10) + 'px');
    maLigne1.setAttribute('x2', DistancenPxl + 'px');
    maLigne1.setAttribute('y2',  (HeightLine+10) +'px');
    maLigne1.setAttribute('stroke','#000000');
	maLigne1.setAttribute("style","opacity:0.2");
    maLigne1.setAttribute('stroke-width',1);
    maLigne1.setAttribute('stroke-linecap','round');
	GraphiqueSVG.appendChild(maLigne1);
}
/** FUNCTION DESSINER LA LIGNE   ELEVATION D+ *************/
function AddLigneElevation( value, GraphiqueSVG )
{
		
	var ELevationPxl = TransformElevationEnPxl(value) + DecalageStartHeight;
		/*** AFFICHAGE TEXT AU DöBUT DE LA LIGNE *****/
	var newText = document.createElementNS("http://www.w3.org/2000/svg",'text');
	newText.setAttributeNS(null,"x",'10px');     
	newText.setAttributeNS(null,"y",(ELevationPxl) +'px'); 
	newText.setAttributeNS(null,"font-size","12");
	
	var textNode = document.createTextNode(Math.round(value));
	newText.appendChild(textNode);
	GraphiqueSVG.appendChild(newText);

	var maLigne1 = document.createElementNS("http://www.w3.org/2000/svg",'line');

    maLigne1.setAttribute('x1',  (DecalageStartWidth - 10) +'px');
    maLigne1.setAttribute('y1', ELevationPxl+ 'px');
    maLigne1.setAttribute('x2', (Width + DecalageStartWidth)+'px');
    maLigne1.setAttribute('y2',  ELevationPxl +'px');

    maLigne1.setAttribute('stroke','#000000');
	maLigne1.setAttribute("style","opacity:0.2");
    maLigne1.setAttribute('stroke-width',1);

    maLigne1.setAttribute('stroke-linecap','round');
	GraphiqueSVG.appendChild(maLigne1);
}
/************ FUNCTION DISTANCE QUI CALCUL AL DISTANCE ENTRE DEUX POINT ****/
function distance(lat1, lng1, lat2, lng2)
{
         pi80 = Math.PI / 180;
         lat1 = lat1 * pi80;
         lng1 = lng1 * pi80;
         lat2 =  lat2 * pi80;
         lng2 =  lng2* pi80;
  
         r = 6372.797; // rayon moyen de la Terre en km
         dlat = lat2 - lat1;
         dlng = lng2 - lng1;
         a =  Math.sin(dlat / 2) *  Math.sin(dlat / 2) +  Math.cos(lat1) *  Math.cos(lat2) *  Math.sin(dlng / 2) *  Math.sin(dlng / 2);
         c = 2 *  Math.atan2( Math.sqrt(a),  Math.sqrt(1 - a));
       return  km = r * c;
}

function ReadFileCoordonee()
{
	var ArrayPassage = [];
	var Table = document.getElementById("TablePointPassage");
	const reader = new FileReader(); 

    reader.onload = (event) => { 
     const file = event.target.result; 
     const allLines = file.split(/\r\n|\n/); 
     // Reading line by line 
     allLines.map((line) => { 
	 
  
				Table.insertRow(0);
				// Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
				var cell1 = row.insertCell(0);
				var cell2 = row.insertCell(1);
				var cell3 = row.insertCell(2);
				// Add some text to the new cells:
				cell1.innerHTML = Linesplit[0];
				cell2.innerHTML = Linesplit[1];
				cell3.innerHTML =Linesplit[2];	
				var Passage= new Object();
			var Linesplit =	line.split(";");
					Passage.Nom= Linesplit[0];
					Passage.Lat = Linesplit[1];
					Passage.Lon = Linesplit[2];
					ArrayPassage.push(Passage);
     }); 
    }; 

    reader.onerror = (evt) => { 
     alert(evt.target.error.name); 
    }; 				

}

function copyStylesInline(destinationNode, sourceNode) {
   var containerElements = ["svg","g"];
   for (var cd = 0; cd < destinationNode.childNodes.length; cd++) {
       var child = destinationNode.childNodes[cd];
       if (containerElements.indexOf(child.tagName) != -1) {
            copyStylesInline(child, sourceNode.childNodes[cd]);
            continue;
       }
       var style = sourceNode.childNodes[cd].currentStyle || window.getComputedStyle(sourceNode.childNodes[cd]);
       if (style == "undefined" || style == null) continue;
       for (var st = 0; st < style.length; st++){
            child.style.setProperty(style[st], style.getPropertyValue(style[st]));
       }
   }
}

function triggerDownload (imgURI, fileName) {
  var evt = new MouseEvent("click", {
    view: window,
    bubbles: false,
    cancelable: true
  });
  var a = document.createElement("a");
  a.setAttribute("download", fileName);
  a.setAttribute("href", imgURI);
  a.setAttribute("target", '_blank');
  a.dispatchEvent(evt);
}

function downloadSvg( ) {
	var svg = document.getElementById("image1");
	var fileName = "image1.png";
  var copy = svg.cloneNode(true);
  copyStylesInline(copy, svg);
  var canvas = document.createElement("canvas");
  var bbox = svg.getBBox();
  canvas.width = bbox.width;
  canvas.height = bbox.height;
  var ctx = canvas.getContext("2d");
  ctx.clearRect(0, 0, bbox.width, bbox.height);
  var data = (new XMLSerializer()).serializeToString(copy);
  var DOMURL = window.URL || window.webkitURL || window;
  var img = new Image();
  var svgBlob = new Blob([data], {type: "image/svg+xml;charset=utf-8"});
  var url = DOMURL.createObjectURL(svgBlob);
  img.onload = function () {
    ctx.drawImage(img, 0, 0);
    DOMURL.revokeObjectURL(url);
    if (typeof navigator !== "undefined" && navigator.msSaveOrOpenBlob)
    {
        var blob = canvas.msToBlob();         
        navigator.msSaveOrOpenBlob(blob, fileName);
    } 
    else {
        var imgURI = canvas
            .toDataURL("image/png")
            .replace("image/png", "image/octet-stream");
        triggerDownload(imgURI, fileName);
    }
    document.removeChild(canvas);
  };
  img.src = url;
}

</script> 
<!---  ***************************** Affichage des catégorie  *************************** ------->
 <div  id="TableauResulat">

		<!--- Liste des parcours !---->
		<?php
		// Afficher la liste des Parcours  Dossier dans la course ;
		$pathfolder = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE;
		// CrÃ©ation de la liste de toutes les Dossier = Parcours 
		$files1 = scandir($pathfolder);
		// Liste des ficbier 
		foreach ($files1  as $key => $Parcours) 
		{ 
			if(is_dir($pathfolder .'/'.$Parcours))
			{
				// Affichage dans la liste des dÃ©part dans le menu 
				if (strlen($Parcours) >2 && $Parcours != "info") 
				{	

				?>	
				<script>
					var Parcours= new Object();
					
					Parcours.nom=<?php echo json_encode($Parcours); ?>;

					var ArrayDepart = [];
				</script>
				<?php
					//<!--- Liste des DÃ©part !---->
					// Afficher la liste des Parcours  Dossier dans la course ;
					$pathfolderParcours = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE. '/'.$Parcours;
					// CrÃ©ation de la liste de toutes les Dossier = Depart 
					$filesDepart = scandir($pathfolderParcours);
					$CmptDisc = 1;
					foreach ($filesDepart  as $key => $depart) 
					{ 
						if(is_dir($pathfolderParcours .'/'.$depart) )
						{
							
							if (strlen($depart) >2)
							{
							?>
								<script>
									var ArrayDiscipline = [];
									var ArrayReduction = [];
									var ArrayEtape = [];
									var Depart= new Object();
									Depart.Nom = <?php echo json_encode($depart); ?>;
								
								</script>
								<?php
									// Lecture du fichier info.txt 	
								$pathFileInfo = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/'.$Parcours.'/'.$depart.'/info.txt';
								if (file_exists($pathFileInfo))
								{
									if (($handle = fopen($pathFileInfo, "r")) !== FALSE) 
									{
										$cmpt =0;
								
								
										while (($datatxt = fgetcsv($handle, 1000, ";")) !== FALSE) 
										{
											$cmpt++; ?>
											<script>
												console.log(	<?php echo json_encode($cmpt)?>); 
											</script>
											<?php			
											if( $cmpt==1)
											{?>
											<script>
												
											Depart.HeureStart=<?php echo json_encode($datatxt[0]); ?>;
											Depart.DistanceTotal = <?php echo json_encode($datatxt[3]); ?>;

											</script>
											<?php
											}
											
										}
									}
								}
						
								$pathfolderDepart = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE. '/'.$Parcours.'/'.$depart;
								// CrÃ©ation de la liste de toutes les Dossier = Depart 
								$filesEtape = scandir($pathfolderDepart);

								/***************** Etape ********************/
								$CmptEtape = 1;
								foreach ($filesEtape  as $key => $Etape) 
								{
									$pathFolderEtape = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/'.$Parcours.'/'.$depart.'/'.$Etape;
										

									$pos = strpos($pathFolderEtape, 'Etape');
								
									if (strlen($Etape) >2 && is_dir($pathFolderEtape ) && $pos > -1)
									{
											?> <script>
								console.log(<?php echo json_encode($Etape); ?>);
								</script>
								<?
										// Lecture du fichier info.txt de l'étape 	
										$pathFileInfoEtape = $pathFolderEtape.'/info.txt';
										if (file_exists($pathFileInfoEtape))
										{
											$pathfileImageEtape = $pathFolderEtape.'/images/Etape.jpg';
												 if (file_exists ( $pathfileImageEtape ) == false)
												 {
													
													 $pathfileImageEtape = "";
													 
												 }
												 $pathfileGpxEtape = $pathFolderEtape.'/images/Etape.xml';
												 if (file_exists ( $pathfileGpxEtape ) == false)
												 {
													
													 $pathfileGpxEtape = "";
													 
												 }
												$CmptEtape ++;
										?> <script>
										 var Etape = new Object();

										 </script>
									 <?
											if (($handle = fopen($pathFileInfoEtape, "r")) !== FALSE) 
											{
												$cmpt =0;
												while (($datatxt = fgetcsv($handle, 1000, ";")) !== FALSE) 
												{
													if($datatxt[0]!= "Point" && $datatxt[0]!= "Discipline" && $datatxt[0]!= "Reduction")
													{
														?>
														<script>
															var Etape = new Object();
															Etape.Date=<?php echo json_encode($datatxt[0]); ?>;
															Etape.Lieu = <?php echo json_encode($datatxt[1]); ?>;
															Etape.Distance = <?php echo json_encode($datatxt[2]); ?>;
															Etape.Denivelle = <?php echo json_encode($datatxt[3]); ?>;
															Etape.Heure=<?php echo json_encode($datatxt[5]); ?>;
															Etape.Image = <?php echo json_encode($pathfileImageEtape); ?>;
															Etape.GPX = <?php echo json_encode($pathfileGpxEtape); ?>;
															ArrayEtape.push(Etape);
															console.log(Etape);
													</script><?
													}
													else if( $datatxt[0]== "Reduction")
													{
														?>
														<script>
														var Reduction = new Object();
														Reduction.Nom = <?php echo json_encode($datatxt[1]); ?>;
														Reduction.Value = <?php echo json_encode($datatxt[2]); ?>;
														ArrayReduction.push(Reduction);
														</script><?
													}
													// Lecture Ligne 2 et +
													else if( $datatxt[0]== "Discipline")
													{	
														$pathfileImage = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE. '/'.$Parcours.'/'.$depart.'/'.$Etape.'/images/Disc'.$CmptDisc.'.jpg';
														 if (file_exists ( $pathfileImage ) == false)
														 {
															
															 $pathfileImage = "";
															 
														 }
														 $pathfileGpx = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE. '/'.$Parcours.'/'.$depart.'/'.$Etape.'/images/Disc'.$CmptDisc.'.xml';
														 if (file_exists ( $pathfileGpx ) == false)
														 {
															
															 $pathfileGpx = "";
															 
														 }
														$CmptDisc ++;												 ?>
														<script>
														
															var Discpline = new Object();
															 Discpline.Nom = <?php echo json_encode($datatxt[1]); ?>;
															 Discpline.Distance = <?php echo json_encode($datatxt[2]); ?>;
															 Discpline.Deniv = <?php echo json_encode($datatxt[3]); ?>;
								
											
															Discpline.Image = <?php echo json_encode($pathfileImage); ?>;
															Discpline.GPX = <?php echo json_encode($pathfileGpx); ?>;
															 ArrayDiscipline.push(Discpline);
																	 
														</script>
													
													<?php
													}
												}
											}
										}
									?> <script>
								
						
									 
									 </script>
									<?}
								}
								
								
								
								/******************* CATEGORIE *************************/
								// Lecture du fichier CAT.csv 	
								$pathFileCat = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/'.$Parcours.'/'.$depart.'/cat.csv';?>
								<Script>
									var ArrayCat = [];
								</script><?php
								if (($handle = fopen($pathFileCat, "r")) !== FALSE) 
								{
									while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) 
									{ ?>
										<script>
											var Categorie= new Object();								
											Categorie.num_cat =	<?php echo json_encode($data[0]); ?>;				
											Categorie.nom_cat = <?php echo json_encode($data[1]); ?>;
											Categorie.sexe = <?php echo json_encode($data[4]); ?>;
											Categorie.AnneeStart = <?php echo json_encode(intval($data[5])); ?>;
											Categorie.AnneeEnd = <?php echo json_encode(intval($data[6])); ?>;
											Categorie.xEquipe = <?php echo json_encode($data[10]); ?>;
											
											ArrayCat.push(Categorie);							
										</script>
									<?php
									}
									?>
									<script>
										Depart.ArrayEtape = ArrayEtape;
										Depart.ArrayCat = ArrayCat;
										Depart.ArrayDiscipline = ArrayDiscipline;
										Depart.ArrayReduction = ArrayReduction;
									</script>
									<?php
								}	
								?>
						<script>
						
							ArrayDepart.push(Depart);
						
						</script><?php
						}
						}	
					}?>
					<script>
						Parcours.ArrayDepart =ArrayDepart;
						
					</script><?php
					
					/********************* Tarifs du parcours *************************/
					?>
					<script>
						var ArrayZoneTarifs = [];
					</script>
					<?
					$pathFileTarif = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/'.$Parcours.'/tarif.csv';
					if (file_exists($pathFileTarif))
					{
						if (($handle = fopen($pathFileTarif, "r")) !== FALSE) 
						{
							$cmpt =0;
							
					
							while (($datatxt = fgetcsv($handle, 1000, ";")) !== FALSE) 
							{
								$cmpt++; ?>
								<script>
								var i;
								var find = -1;
								
							
								for (i = 0; i < ArrayZoneTarifs.length; i++) 
								{
									 if (ArrayZoneTarifs[i].Nom == <?php echo json_encode($datatxt[0]); ?> )
									 {
										 find = i;
								
										
									 }
								
								}
								var Tarifs = new Object();
								Tarifs.Nom = <?php echo json_encode($datatxt[2]); ?>;
								Tarifs.Option = <?php echo json_encode($datatxt[3]); ?>;
								Tarifs.OnLine = <?php echo json_encode($datatxt[4]); ?>;
						
								if (find == -1)
								{
									var ZoneTarifs = new Object();
									ZoneTarifs.Nom = <?php echo json_encode($datatxt[0]); ?>;
									ZoneTarifs.DateEnd = <?php echo json_encode(strftime('%A %d %B %Y %H:%M',strtotime($datatxt[1]))); ?>;
									ZoneTarifs.NombreMaxInscription = <?php echo json_encode($datatxt[5]); ?>;
									
									ZoneTarifs.ArrayTarifs = [];
									ZoneTarifs.ArrayTarifs.push(Tarifs);
									ArrayZoneTarifs.push(ZoneTarifs);
								}
								else
								{
									ArrayZoneTarifs[find].ArrayTarifs.push(Tarifs);
								}
								</script>
							<?	
							}?>
								<script>
									Parcours.ArrayZoneTarifs = ArrayZoneTarifs;
									console.log(ArrayZoneTarifs);
								</script>
							<?
						}
					}?>
					<script>
					/********** AJout du parcours au tableau de parcours *********/
					ArrayParcours.push(Parcours);
					console.log(Parcours);
					</script><?
				}
			}
		}
		

		?>
		<script>
 // crée un nouvel élément div
 let b = document.body;
  let newDiv = document.createElement("div");
  
  // ********** POUR CHAQUE PARCOURS ***************/
for (var i = 0; i < ArrayParcours.length; i++) {

	var ParcoursObj = new Object();
	ParcoursObj = ArrayParcours[i];
	let ParcoursPara  = null ;
	if (ArrayParcours.length > 1)
	{
	 ParcoursPara = document.createElement('fieldset');
	}
	else
	{
		 ParcoursPara = document.createElement('div');
	}
			
	ParcoursPara.className='TableauResulat'
		let NomParcoursPara =	document.createElement('div');	
		
		// Affichage du titre du parcours si il y a plusieurs départ
	if (ParcoursObj.nom.length > 0 &&  ArrayParcours.length>1 && ParcoursObj.ArrayDepart.length> 1)
	{
	
		NomParcoursPara.textContent = "Parcours : " +ParcoursObj.nom;
		NomParcoursPara.className += "titleCenter";
	
	}
		ParcoursPara.append(NomParcoursPara);

	console.log(ParcoursObj);
	// ************************Pour chaque départ ***********************
	//
	//
	//********************************************************************
	for (var h = 0; h < ParcoursObj.ArrayDepart.length; h++)
	{
			
			var DepartObj = new Object();
			// Reprise de l'objet départ dans le tableau
			DepartObj = ParcoursObj.ArrayDepart[h];
			
			// Créer un Div par Depart
			let  DepartPara = document.createElement('div');
			console.log(DepartObj);
		
			let NomStartPara =	document.createElement('p');	
			NomStartPara.className += "title";
			
			let TableTitleDepart = document.createElement('table');	
			TableTitleDepart.style.width = "100%";
			TableTitleDepart.style.marginTop = "0px";
			let RowsTitleDepart = document.createElement('tr');
			let ColumnTitleDepart = document.createElement('td');
				
			RowsTitleDepart.append(ColumnTitleDepart);
				
			if (DepartObj.Nom.length > 0)
			{
				ColumnTitleDepart.textContent =  DepartObj.Nom;

				RowsTitleDepart.append(ColumnTitleDepart);
			}
			
			// Si le Depart contient 1 heure de départ // Obsolète maintenant l'heure de départ s'affiche dans l'étape
			if (DepartObj.HeureStart.length > 0)
			{
				ColumnTitleDepart = document.createElement('td');
				
				ColumnTitleDepart.innerHTML ='<i class="fa fa-clock-o" ></i>' +" " +DepartObj.HeureStart ;
				ColumnTitleDepart.style.borderBottom ="0px";
				RowsTitleDepart.append(ColumnTitleDepart);
			}
			else
			{
				// SI le départ contient 1 étape on va reprendre sont heure de départ
				if (DepartObj.ArrayEtape.length == 1 )
				{
					if (DepartObj.ArrayEtape[0].Heure.length > 0)
					{	
						ColumnTitleDepart = document.createElement('td');
						
						ColumnTitleDepart.innerHTML ='<i class="fa fa-clock-o" ></i>' +" " +DepartObj.ArrayEtape[0].Heure ;
						ColumnTitleDepart.style.borderBottom ="0px";
						RowsTitleDepart.append(ColumnTitleDepart);
					}
				}
			}
			
			// Si le Depart contient Distance total // Obsolète maintenant la distance s'affiche dans l'étape
			if (DepartObj.DistanceTotal.length > 0)
			{
				ColumnTitleDepart = document.createElement('td');
				
				ColumnTitleDepart.innerHTML = DepartObj.DistanceTotal ;
				ColumnTitleDepart.style.borderBottom ="0px";
				RowsTitleDepart.append(ColumnTitleDepart);
			}
			else
			{
				if (DepartObj.ArrayEtape.length == 1 )
				{
					if (DepartObj.ArrayEtape[0].Distance.length > 0)
					{	
						ColumnTitleDepart = document.createElement('td');
						
						ColumnTitleDepart.innerHTML = DepartObj.ArrayEtape[0].Distance ;
						ColumnTitleDepart.style.borderBottom ="0px";
						RowsTitleDepart.append(ColumnTitleDepart);
					}
				}
			}
				
				if (DepartObj.ArrayEtape.length == 1 )
				{
					if (DepartObj.ArrayEtape[0].Denivelle.length > 0)
					{	
						ColumnTitleDepart = document.createElement('td');
						
						ColumnTitleDepart.innerHTML = DepartObj.ArrayEtape[0].Denivelle ;
						ColumnTitleDepart.style.borderBottom ="0px";
						RowsTitleDepart.append(ColumnTitleDepart);
					}
				}
				if (DepartObj.ArrayEtape.length == 1 )
				{
				// Ajout ligne download fichier gpx présent 
					if ( DepartObj.ArrayEtape[0].GPX.length > 0)
						{
				
							ColTitleEtape =	document.createElement('td');
							ColTitleEtape.innerHTML ='<a href="'+DepartObj.ArrayEtape[0].GPX+'" download="'+DepartObj.Nom+'.gpx"  ><i class="fa fa-download"  > .gpx</i></a>';

							ColTitleEtape.style.borderBottom ="0px";
							RowsTitleDepart.append(ColTitleEtape);
						}

				}
				if(DepartObj.ArrayCat.length==1)
				{
					// Sexe
					ColumnTitleDepart = document.createElement('td');
					if (DepartObj.ArrayCat[0].sexe =="H")
					{
						ColumnTitleDepart.style.fontSize ="25px";
						ColumnTitleDepart.innerHTML = '<i class="fa fa-male" ></i>';
					}
					else if (DepartObj.ArrayCat[0].sexe =="D")
					{
						ColumnTitleDepart.style.fontSize ="25px";
						ColumnTitleDepart.innerHTML = '<i class="fa fa-female" ></i>' ;
					}
					else
					{
						ColumnTitleDepart.style.fontSize ="25px";
						ColumnTitleDepart.innerHTML ='<i class="fa fa-female" >' + '<i class="fa fa-male" ></i>' ;
					}
		
					ColumnTitleDepart.style.borderBottom ="0px";
					RowsTitleDepart.append(ColumnTitleDepart);
					
					// AnneeStart
					ColumnTitleDepart = document.createElement('td');
					
					ColumnTitleDepart.innerHTML = DepartObj.ArrayCat[0].AnneeStart+ " - " + DepartObj.ArrayCat[0].AnneeEnd ;
					ColumnTitleDepart.style.borderBottom ="0px";
					RowsTitleDepart.append(ColumnTitleDepart);
					
				}
					TableTitleDepart.append(RowsTitleDepart);
				NomStartPara.append(TableTitleDepart);
				DepartPara.append(NomStartPara);
			
		
	

			for (var j = 0; j < DepartObj.ArrayEtape.length; j++)
			{
				var	EtapeObj =  new Object();
				EtapeObj = DepartObj.ArrayEtape[j];
			
					let Etapepara = document.createElement('fieldset');
					
					if (DepartObj.ArrayEtape.length > 1)
					{
						let TableTitleEtape = document.createElement('table');			
						TableTitleEtape.style.width = "100%";
						TableTitleEtape.style.borderStyle = "none";
						TableTitleEtape.style.borderSpacing  = "0px";
						TableTitleEtape.style.marginTop  = "15px";
						TableTitleEtape.style.marginBottom  = "15px";
						TableTitleEtape.style.padding  = "10px";
						let RowsTitleEtape =	document.createElement('tr');
						TableTitleEtape.style.background  = "#58b8e7";
						RowsTitleEtape.style.margin  = "10px";
					
						let ColTitleEtape =	document.createElement('td');
						ColTitleEtape.innerHTML ="Etape " +(j +1);
						ColTitleEtape.style.borderBottom ="0px";
						RowsTitleEtape.append(ColTitleEtape);
						if (EtapeObj.Date.length > 0)
						{
							ColTitleEtape =	document.createElement('td');
							ColTitleEtape.innerHTML ='<i class="fa fa-calendar-o" ></i>' +" "+ EtapeObj.Date;
									ColTitleEtape.style.borderBottom ="0px";
							RowsTitleEtape.append(ColTitleEtape);
						}
	
						 if (EtapeObj.Lieu.length > 0)
						{
							ColTitleEtape =	document.createElement('td');
							ColTitleEtape.innerHTML ='<i class="fa fa-map-marker" ></i>' +" "+EtapeObj.Lieu;
									ColTitleEtape.style.borderBottom ="0px";
							RowsTitleEtape.append(ColTitleEtape);
						}
						if (EtapeObj.Heure.length > 0)
						{

							ColTitleEtape =	document.createElement('td');
							ColTitleEtape.innerHTML ='<i class="fa fa-clock-o" ></i>' +" " +EtapeObj.Heure ;
							ColTitleEtape.style.borderBottom ="0px";
							RowsTitleEtape.append(ColTitleEtape);
						}
						// Ajout ligne download fichier gpx présent 
						if ( EtapeObj.GPX.length > 0)
						{
							ColTitleEtape =	document.createElement('td');
							ColTitleEtape.innerHTML ='<a href="'+EtapeObj.GPX+'" download="'+EtapeObj.Nom+'.gpx"  ><i class="fa fa-download"  > .gpx</i></a>';
							ColTitleEtape.style.borderBottom ="0px";
							RowsTitleEtape.append(ColTitleEtape);
						}


						TableTitleEtape.append(RowsTitleEtape);
						DepartPara.append(TableTitleEtape);	
						
						if (EtapeObj.Distance.length > 0 ||   EtapeObj.Image.length > 0||   EtapeObj.GPX.length > 0)
						{
						<!-- AFFICHAGE INFORMATION PARCOURS ETAPE *************!-->
							let TableEtape = document.createElement('table');			
							TableEtape.width = "100%";
							let RowsTableEtape =	document.createElement('tr');
							let TableDistance = document.createElement('table');
							let ColInfoEtape =	document.createElement('td');
							if (EtapeObj.Distance.length > 0)
							{
								
								
								ColInfoEtape.style.width = "20%";
								
								ColInfoEtape.style.verticalAlign ="Top";
								
								TableDistance.style.borderSpacing  = "10px";
								TableDistance.style.width = "100%";					
								let RowsDistance =	document.createElement('tr');
								RowsDistance.style.background  = "#58b8e7"
								
								let ColDistance =	document.createElement('td');
								ColDistance.innerHTML = EtapeObj.Distance  ;
								ColDistance.style.padding ="10px";
								
								RowsDistance.append(ColDistance);
								TableDistance.append(RowsDistance);
							}
							if (EtapeObj.Denivelle.length > 0)
							{
								RowsDistance =	document.createElement('tr');
								RowsDistance.style.background  = "#58b8e7"
								
								ColDistance =	document.createElement('td');
								RowsDistance.style.width = "100%";	
								ColDistance.style.width = "100%";	
								ColDistance.innerHTML =  EtapeObj.Denivelle ;
								ColDistance.style.padding ="10px";
							
								RowsDistance.append(ColDistance);
								TableDistance.append(RowsDistance);
								ColInfoEtape.append(TableDistance);
								RowsTableEtape.append(ColInfoEtape);
							
							}
							if ( EtapeObj.Image.length > 0)
							{
								console.log(EtapeObj.Image);
								let ColimgEtapePara =	document.createElement('td');
								ColimgEtapePara.width = "80%";
								let ImageEtape = document.createElement('img');
								ImageEtape.src =  EtapeObj.Image;
								ImageEtape.className += "imgCenter";
								ImageEtape.style.width = "80%"
								ImageEtape.style.textAlign  ="center";
								ColimgEtapePara.append(ImageEtape);
								RowsTableEtape.append(ColimgEtapePara);
							}
							if ( EtapeObj.GPX.length > 0)
							{
	
								let ColimgEtapePara =	document.createElement('div');
								

								ColimgEtapePara.width = "80%";
							/*	let ImageEtape = document.createElement('img');
								ImageEtape.src =  EtapeObj.Image;
								ImageEtape.className += "imgCenter";
								ImageEtape.style.width = "80%"
								ImageEtape.style.textAlign  ="center";
								ColimgEtapePara.append(ImageEtape);*/
								RowsTableEtape.append(ColimgEtapePara);
								mapSvg("Etape " +(j +1)+DepartObj.Nom, EtapeObj.GPX, ColimgEtapePara);
						
							}								
					
				
		
					TableEtape.append(RowsTableEtape);			
					DepartPara.append(TableEtape);
					}
				
				}
				else // Affichage imges si il y a une seul étape
				{
					
						let TableEtape = document.createElement('table');			
						TableEtape.width = "100%";
						DepartPara.append(TableEtape);
						
						
				
						if ( EtapeObj.Image.length > 0)
						{
						
							let RowsTableEtape =	document.createElement('tr');
							console.log(EtapeObj.Image);
							let ColimgEtapePara =	document.createElement('td');
							ColimgEtapePara.width = "80%";
							let ImageEtape = document.createElement('img');
							ImageEtape.src =  EtapeObj.Image;
							ImageEtape.className += "imgCenter";
							ImageEtape.style.width = "80%"
							ImageEtape.style.textAlign  ="center";
							ColimgEtapePara.append(ImageEtape);
							RowsTableEtape.append(ColimgEtapePara);
							TableEtape.append(RowsTableEtape);			
						
							
						}
						if ( EtapeObj.GPX.length > 0)
						{

							let RowsTableEtape1 =	document.createElement('tr');
							let ColimgEtapePara1 =	document.createElement('td');
							let DivimgEtapePara =	document.createElement('div');
							

							ColimgEtapePara1.width = "80%";
							ColimgEtapePara1.append(DivimgEtapePara);
							RowsTableEtape1.append(ColimgEtapePara1);
							TableEtape.append(RowsTableEtape1);
							mapSvg("Etape " +(j +1)+DepartObj.Nom, EtapeObj.GPX, DivimgEtapePara);

					
						}							
				}
			
							
		}
			
		
		//********************* Discpline *****************/
		if (DepartObj.ArrayDiscipline.length > 1)
		{
			for (var d = 0; d < DepartObj.ArrayDiscipline.length; d++)
			{
							var	DisciplineObj =  new Object();
				DisciplineObj = DepartObj.ArrayDiscipline[d];
				// Si plus de 1 discipline afficher celle-ci en en tête
				if (DisciplineObj.Nom.length > 0 &&  DepartObj.ArrayDiscipline.length > 1)
				{
					let NomPara =	document.createElement('div');
					
					NomPara.textContent =  DisciplineObj.Nom;
					NomPara.className += "title";
					DepartPara.append(NomPara);
				}

				
						<!-- AFFICHAGE INFORMATION Discipline  *************!-->
							let TableDisc = document.createElement('table');			
							TableDisc.width = "100%";
							
					/*		let TableInfoDisc = document.createElement('table');
								TableInfoDisc.style.borderSpacing  = "10px";
								TableInfoDisc.style.width = "100%";	
							let ColInfoDisc =	document.createElement('td');
							ColInfoDisc.style.width = "20%";
							if (DisciplineObj.Distance.length > 0)
							{
								ColInfoDisc.style.verticalAlign ="Top";
								let RowsDiscDistance =	document.createElement('tr');
								RowsDiscDistance.style.background  = "#58b8e7"
								
								let ColInfoDistance =	document.createElement('td');
								ColInfoDistance.innerHTML = DisciplineObj.Distance  ;
								ColInfoDistance.style.padding ="10px";
								
								RowsDiscDistance.append(ColInfoDistance);
								TableInfoDisc.append(RowsDiscDistance);
							}
							if (DisciplineObj.Deniv.length > 0)
							{
								RowsDiscDistance =	document.createElement('tr');
								RowsDiscDistance.style.background  = "#58b8e7"
								
								ColInfoDistance =	document.createElement('td');
								RowsDiscDistance.style.width = "100%";	
								ColInfoDistance.style.width = "100%";	
								ColInfoDistance.innerHTML =  DisciplineObj.Deniv ;
								ColInfoDistance.style.padding ="10px";
								RowsDiscDistance.append(ColInfoDistance);
								
								TableInfoDisc.append(RowsDiscDistance);
				
							
							}
											ColInfoDisc.append(TableInfoDisc);
								RowsTableDisc.append(ColInfoDisc);*/
							if ( DisciplineObj.Image.length > 0)
							{
								let RowsTableDisc =	document.createElement('tr');
								let ColimgDiscPara =	document.createElement('td');
								ColimgDiscPara.width = "80%";
								let ImageDisc = document.createElement('img');
								ImageDisc.src =  DisciplineObj.Image;
								ImageDisc.className += "imgCenter";
								ImageDisc.style.width = "80%"
								ImageDisc.style.textAlign  ="center";
								ColimgDiscPara.append(ImageDisc);
								RowsTableDisc.append(ColimgDiscPara);
											TableDisc.append(RowsTableDisc);	
							}
							if ( DisciplineObj.GPX.length > 0)
							{
								let RowsTableDisc1 =	document.createElement('tr');
								let ColimgDiscPara1 =	document.createElement('td');
								ColimgDiscPara1.width = "80%";
								let DivDisc = document.createElement('div');
								DivDisc.style.width = "80%"
								DivDisc.style.textAlign  ="center";
								mapSvg("Disc" +(d +1)+DepartObj.Nom, EtapeObj.GPX, DivDisc);
								ColimgDiscPara1.append(DivDisc);
								RowsTableDisc1.append(ColimgDiscPara1);
								TableDisc.append(RowsTableDisc1);	
							}								
					
				
		
				
					DepartPara.append(TableDisc);
					

			}
		}
		
		ParcoursPara.append(DepartPara);
		/*************** Catégorie ***************************/
		if (DepartObj.ArrayCat.length > 1) 	
		{
					//***************** Titre du tableau de catégorie  ****************/
			let ZoneTaifStartPara1 =	document.createElement('p');	
		
			ZoneTaifStartPara1.textContent = "Catégories : ";
			ParcoursPara.append(ZoneTaifStartPara1);
			
			let TableCat =	document.createElement('table');
			TableCat.id = "TableauCat";
			TableCat.width = "100%";

			let RowsTableCat =	document.createElement('tr');
			let HeaderTableCat =	document.createElement('th');
			
			HeaderTableCat.textContent = "N°";	
			RowsTableCat.append(HeaderTableCat);
			 HeaderTableCat =	document.createElement('th');
			HeaderTableCat.textContent = "Nom Catégorie";	
	
			RowsTableCat.append(HeaderTableCat);
			 HeaderTableCat =	document.createElement('th');
			HeaderTableCat.textContent = "Sexe";	
			RowsTableCat.append(HeaderTableCat);
	
			 HeaderTableCat =	document.createElement('th');
			HeaderTableCat.textContent = "Année de naissance";	
			RowsTableCat.append(HeaderTableCat);
			 HeaderTableCat =	document.createElement('th');
			HeaderTableCat.textContent = "";	
			RowsTableCat.append(HeaderTableCat);
			TableCat.append(RowsTableCat);
		for (var d = 0; d < DepartObj.ArrayCat.length; d++)
		{
			var CatObj = DepartObj.ArrayCat[d];
			let RowsTableCat =	document.createElement('tr');
		
			 HeaderTableCat =	document.createElement('td');
			HeaderTableCat.textContent = CatObj.num_cat ;	
			RowsTableCat.append(HeaderTableCat);
			 HeaderTableCat =	document.createElement('td');
			HeaderTableCat.textContent = CatObj.nom_cat ;	
			RowsTableCat.append(HeaderTableCat);
			 HeaderTableCat =	document.createElement('td');
			HeaderTableCat.textContent = CatObj.sexe ;		
			RowsTableCat.append(HeaderTableCat);
			 HeaderTableCat =	document.createElement('td');
			HeaderTableCat.textContent = CatObj.AnneeStart ;	
			RowsTableCat.append(HeaderTableCat);
			 HeaderTableCat =	document.createElement('td');
			HeaderTableCat.textContent =CatObj.AnneeEnd ;	
			RowsTableCat.append(HeaderTableCat);
			TableCat.append(RowsTableCat);
		}
	
		ParcoursPara.append(TableCat);
		}
		
		let newTexte = document.createTextNode('Texte écrit en JavaScript');
		

	}
	
	// ************* ARRAY TARIFS ************************
	//
	//
	//******************************************************/
	
	
	if (ParcoursObj.ArrayZoneTarifs != null && ParcoursObj.ArrayZoneTarifs.length > 0 )
	{
		//***************** Titre de la zone de tarif ****************/
			let ZoneTaifStartPara =	document.createElement('p');	
			ZoneTaifStartPara.className += "title";
			ZoneTaifStartPara.textContent = "Tarifs du parcours :  " + ParcoursObj.nom;
			ParcoursPara.append(ZoneTaifStartPara);
			
			var	ZoneTarifsObj =  new Object();
			ZoneTarifsObj = ParcoursObj.ArrayZoneTarifs[0];
			let TableZoneTarif = document.createElement('table');			
			TableZoneTarif.id = "TableauCat";
			TableZoneTarif.width = "100%";

			let RowsTableTarif =	document.createElement('tr');
			let HeaderTableTarif =	document.createElement('th');
		
			if (ZoneTarifsObj.Nom != null && ZoneTarifsObj.Nom.length > 0)
			{
				HeaderTableTarif.textContent = "Type de paiement";
				RowsTableTarif.append(HeaderTableTarif);
			}
			if (ZoneTarifsObj.DateEnd != null && ZoneTarifsObj.DateEnd.length > 0)
			{
				HeaderTableTarif =	document.createElement('th');
				HeaderTableTarif.textContent = "Limite zone";	
				RowsTableTarif.append(HeaderTableTarif);
			}
			// Affichage des options de paiement dans l en tete
			if (ZoneTarifsObj.ArrayTarifs.length > 1 && ZoneTarifsObj.ArrayTarifs.length < 6 )
			{
				for (var f = 0; f < ZoneTarifsObj.ArrayTarifs.length; f++)
				{
					
					var	TarifsObj =  new Object();
					TarifsObj = ZoneTarifsObj.ArrayTarifs[f];
					
					if (TarifsObj != undefined && TarifsObj.Option != null && TarifsObj.Option.length > 0)
					{
						HeaderTableTarif =	document.createElement('th');
						HeaderTableTarif.textContent = TarifsObj.Nom ;
						RowsTableTarif.append(HeaderTableTarif);
					
					}
					
					
				}
			}
				
		//*********** CONTENU DU TABLEAU TARIFS****************************
					
		for (var p= 0; p < ParcoursObj.ArrayZoneTarifs.length; p++)
		{
				ZoneTarifsObj = ParcoursObj.ArrayZoneTarifs[p];
				TableZoneTarif.append(RowsTableTarif);
				RowsTableTarif =	document.createElement('tr');
				if ( ZoneTarifsObj.Nom != null && ZoneTarifsObj.Nom.length > 0)
				{
					HeaderTableTarif =	document.createElement('td');
					HeaderTableTarif.textContent = ZoneTarifsObj.Nom;	
					RowsTableTarif.append(HeaderTableTarif);
				}
				
				if ( ZoneTarifsObj.DateEnd != null &&  ZoneTarifsObj.DateEnd.length > 0)
				{
					HeaderTableTarif =	document.createElement('td');
	
					if ( !isNaN(ZoneTarifsObj.NombreMaxInscription) &&  ZoneTarifsObj.NombreMaxInscription > 0 )
					{
						HeaderTableTarif.textContent ="< "+ ZoneTarifsObj.NombreMaxInscription+ " athlètes";							
					}
					else
					{
						HeaderTableTarif.textContent = ZoneTarifsObj.DateEnd;
					}						
					RowsTableTarif.append(HeaderTableTarif);
				}
			// Affichage des options de paiement dans l en tete

			if (ZoneTarifsObj.ArrayTarifs.length > 0 && ZoneTarifsObj.ArrayTarifs.length < 6 )
			{
				for (var e = 0; e < ZoneTarifsObj.ArrayTarifs.length; e++)
				{
					var	TarifsObj =  new Object();
					TarifsObj = ZoneTarifsObj.ArrayTarifs[e];
					
					if ( TarifsObj != null && TarifsObj.Option.length > 0)
					{
						HeaderTableTarif =	document.createElement('td');
						HeaderTableTarif.textContent = TarifsObj.Option + " CHF";
						RowsTableTarif.append(HeaderTableTarif);
					
					
					}
					
				}
			}
			TableZoneTarif.append(RowsTableTarif);
			ParcoursPara.append(TableZoneTarif);
		}
	}

	
	newDiv.append(ParcoursPara);
}
	newDiv.id = "Information";

  b.append(newDiv);

/************************** Apres crétion du DOm obligatoire pour fichier gpx ****************/
for (var i = 0; i < ArrayParcours.length; i++) 
{
	for (var h = 0; h < ArrayParcours[i].ArrayDepart.length; h++)
	{
		if ( ArrayParcours[i].ArrayDepart[h].ArrayEtape!= null)
		{
			for (var j = 0; j < ArrayParcours[i].ArrayDepart[h].ArrayEtape.length; j++)
			{
				if ( ArrayParcours[i].ArrayDepart[h].ArrayEtape[j].GPX.length > 0)
				{
					AddSvg("Etape " +(j +1)+ArrayParcours[i].ArrayDepart[h].Nom, ArrayParcours[i].ArrayDepart[h].ArrayEtape[j].GPX);
				}
			}
			for (var z = 0; z < ArrayParcours[i].ArrayDepart[h].ArrayDiscipline.length; z++)
			{
				if ( ArrayParcours[i].ArrayDepart[h].ArrayDiscipline[z].GPX.length > 0)
				{
					AddSvg("Disc" +(z +1)+ArrayParcours[i].ArrayDepart[h].Nom, ArrayParcours[i].ArrayDepart[h].ArrayDiscipline[z].GPX);
				}
			}
		}
	}
}
</script>
</div>
</div>

 <?php include("sponsors.php"); ?> 
</div>

</body>
</html>

<script>

</script>