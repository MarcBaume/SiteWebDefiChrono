	
	function CssRace(idCanvas, NomCourse,DateCourse,Lieu,PathDir)
	{
		console.log("CssRace");
	 	divRace =	document.getElementById(idCanvas);
		divRace.style.width ="80%";
        divRace.style.margin ="auto";
		divRace.style.height ="210px";
		divRace.style.borderRadius="25px" ;
		divRace.style.backgroundColor  = "#406CA4";
        titleRace = document.createElement("a");
        titleRace.style.backgroundColor  = "#f0f";
        titleRace.style.margin = "10px";
        titleRace.innerHTML = NomCourse;
        divRace.append(titleRace);

        		var couverture = document.createElement("img");
		couverture.src = PathDir + "/logo.jpg"
		couverture.style.borderRadius="25px" ;
        	couverture.style.width ="190px";
divRace.append(couverture);

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
