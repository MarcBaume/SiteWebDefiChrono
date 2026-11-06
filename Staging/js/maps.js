
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
	var TextSelected; 
	var LastPassage = new Object();
	// Numéro du passage trouver pour ce point
	var IDPassageFind = 0;
	var uiCountKM = 0;
	const data = [];

		// Ajout emplacement svg lors de la création du dom
	function funAddSvg(IDSVG, FileName, ColimgEtapePara)
	{
		console.log("funAddSvg");

		indexPassage = 1;
		TableTotal = document.createElement('Table');
		TableTotal.style.width ="80%";
		TableTotal.setAttribute("id", IDSVG+"ImageMap");

		tr1 = document.createElement('Tr');
		td1 = document.createElement('Td');
		
		
		divMap = document.createElement('div');
		divMap.style.height ="300px";
		divMap.setAttribute("id", IDSVG+"my_osm_widget_map");

		// Ajout élément graphique
		td1.append(divMap);
		tr1.append(td1);
		TableTotal.append(tr1);
		
		tr2 = document.createElement('Tr');
		td2 = document.createElement('Td');
		
		// Grphique de denivellé
		
		divGraph = document.createElement('div');
		divGraph.style.height ="300px";
		divGraph.setAttribute("id", IDSVG+"conteneurSVG");
		divGraph.style.height = (Height + (DecalageStartHeight*2))+'px';
		divGraph.style.background = "lightblue";


		// Ajout élément graphique
		td2.append(divGraph);
		tr2.append(td2);
		TableTotal.append(tr2);
		ColimgEtapePara.append(TableTotal);

		
		console.log("Create element")
		/*** ZONE DE DESSIN **/
		var GraphiqueSVG = document.createElementNS("http://www.w3.org/2000/svg",'svg');

		svgWidth =Width + (DecalageStartWidth*2) ;
				svgHeight = Height + (DecalageStartHeight*2);
				GraphiqueSVG.setAttribute("viewBox", "0 0 "+ svgWidth+" "+svgHeight); 
		GraphiqueSVG.id = IDSVG+'image1';
		GraphiqueSVG.name = IDSVG+'image1';
		divGraph.appendChild(GraphiqueSVG);


	}
	// Après que le dom est crée on place l'élement carte  
	function funCreateDrawerMap(IDSVG, FileName)
	{
		
		//READ FCIHIER GPX 	
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
		let latMin = 10000;
		let latMax = -10000;
		let lonMin = 10000;
		let lonMax = -10000;
		
		var ArrayPoint = [];
		var NombreKMH = 9.2;
		var HeureDepart = 5;
		var JourDepart = 4;
		var MoisDepart = 'Juillet';


		for (var i = 0; i < Customers.children.length; i++)
		{
		var Trk = Customers.children[i];
		// Balise TRK 
			if (Trk.tagName == "trk" )
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


							}
							// AJout du ponit au tableau
							point.index = ArrayPoint.length;

							// Pour définir le centre de la carte 
							if (point.Lat < latMin)
							{
								console.log(point.Lat + " "+latMin);
								latMin = point.Lat;
								
							}
							if (point.Lat > latMax)
							{
								latMax = point.Lat;
							}

							if (point.Lon < lonMin)
							{
								lonMin = point.Lon;
							}
							if (point.Lon > lonMax)
							{
								lonMax = point.Lon;
							}

							ArrayPoint.push(point);
							
							///* Mise en mémoire de la position pour le prochaine calcul **)
							LastPoint = point;
						}
					}
				}

				FeneterElevation = (ElevationMax - ElevationMin);		
			}
		}
		LastPoint = null;
		/*____________________________________________________________________________________________
		*																															*
			CREATION AFFICHAGE SELON LE TABLEAU DE POINT LU DANS LE FICHIER GPX 
		_____________________________________________________________________________________*/	
		let MedLat = ((Number(latMax)- Number(latMin )) / 2)  ;
		let MedLon = ((Number(lonMax) - Number(lonMin)) / 2);

		MedLat = Number(MedLat)+ Number(latMin);
		MedLon = Number(MedLon)+ Number(lonMin);
		console.log(IDSVG+'my_osm_widget_map');
		//**** CREATION DÙNE CARTE ****/
		idMap = document.getElementById(IDSVG+'my_osm_widget_map');
		idMap.textContent = '';
		var mymap = L.map(IDSVG+'my_osm_widget_map', { /* use the same name as your <div id=""> */
		center: [MedLat, MedLon], 
		zoom: 15, /* define the zoom level */
		zoomControl: true, /* false = no zoom control buttons displayed */
		scrollWheelZoom: false /* false = scrolling zoom on the map is locked */
		});

		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 30, /* zoom limit of the map */
		attribution: ' <a href="http://openstreetmap.org/copyright">OpenStreetMap</a>'}).addTo(mymap);


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
					AddPoint ( LastPoint, Point, mymap, IDSVG+'image1', true,false );
				}
				// Point finish
				else if (i == ArrayPoint.length-1 )
				{
					AddPoint ( LastPoint, Point, mymap, IDSVG+'image1', false,true );
				}
				else 
				{
					AddPoint ( LastPoint, Point, mymap, IDSVG+'image1', false,false );
				}
			}
			LastPoint = Point;
		}	

		/*********** AJOUT LIGNE Vertical Coordonnée Y DENIVELATION *************/

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

	//UNCTION AJOUT DE POINT SUR LES DESSINS ****/
	function AddPoint(LastPoint, Point ,mymap , GraphiqueSVG, xStart, xFinish)
	{
			// Position de la ligne déniveller 
		posX1 = TransformDistanceEnPxl(LastPoint.KM) + DecalageStartWidth;
		posY1 =	TransformElevationEnPxl(LastPoint.elevation) + DecalageStartHeight;
		posX2 =	TransformDistanceEnPxl(Point.KM) + DecalageStartWidth;
		Posy2 =	TransformElevationEnPxl(Point.elevation) + DecalageStartHeight;
		// Position de la ligne déniveller 
		var obj1 = new Object()
		obj1.x = TransformDistanceEnPxl(LastPoint.KM) + DecalageStartWidth;
		obj1.y = TransformElevationEnPxl(LastPoint.elevation) + DecalageStartHeight;
		data.push(obj1)
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
		// Si on affiche un km
		if (Math.floor(LastPoint.KM)!= uiCountKM)
		{
			uiCountKM = Math.floor(LastPoint.KM);
			// Ajout Marker à position trouver
			L.circleMarker([Point.Lat, Point.Lon], {
			color: 'white',
			opacity: 1,
			weight: 3,
			fillColor: "#1388da",
			fill: true,
			fillOpacity: 1,
			radius: 8
		}).addTo(mymap);
		
		var myIcon = L.divIcon(
			{
				className: 'my-div-icon',
				html: uiCountKM,
				iconAnchor: [2, 5]
			}
		);
		L.marker([Point.Lat -0.0005, Point.Lon-0.0005],
		{
			icon: myIcon
		}).addTo(mymap);


		color= "rgb(200,200,200)"; 
		var polyline = L.polyline(polylinePoints, {color: color}).addTo(mymap);

			polyline.addEventListener('click dblclick', function(e) {
			document.getElementById("Lat").value = LastPoint.Lat ;
			document.getElementById("Len").value = LastPoint.Lon;
			document.getElementById("ele").value = LastPoint.elevation;
			document.getElementById("dist").value = LastPoint.KM;
		});

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
		
		const svg = d3.select("#"+GraphiqueSVG);
		const margin = 40;
		const width = +svg.attr("width") - margin * 2;
		const height = +svg.attr("height") - margin * 2;
		console.log(width);
		const g = svg.append("g")
					.attr("transform", `translate(${margin},${margin})`);

		// 2. Échelles (pour convertir les données en pixels)
		const xScale = d3.scaleLinear()
			.domain([0, 250])
			.range([0, width]);

		const yScale = d3.scaleLinear()
			.domain([0, 100])
			.range([height, 0]);

		// 3. Générateur de ligne avec LISSAGE (curveMonotoneX)
		const line = d3.line()
			.x(d => xScale(d.x))
			.y(d => yScale(d.y))
			.curve(d3.curveMonotoneX); // <--- L'astuce est ici

		// 4. Tracer la ligne
		g.append("path")
			.datum(data)
			.attr("class", "line")
			.attr("d", line);

		// 5. Optionnel : Ajouter les points réels pour voir la précision
		g.selectAll(".dot")
			.data(data)
			.enter().append("circle")
			.attr("class", "dot")
			.attr("cx", d => xScale(d.x))
			.attr("cy", d => yScale(d.y))
			.attr("r", 4);
			
		//GraphiqueSVG.appendChild(maLigne1);
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
		var a = document.createElement("a");
		a.setAttribute("download", fileName);
		a.setAttribute("href", imgURI);
		a.setAttribute("target", '_blank');
		a.dispatchEvent(evt);
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
}
