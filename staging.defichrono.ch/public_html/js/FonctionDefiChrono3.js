

function readJSON(file) {
		console.log("ReadV2");
	console.log(file);
    var request = new XMLHttpRequest();
	var x = Math.random();
    request.open('GET', file+"?something="+x, false);
		console.log("ReadOpen");
    request.send();
		console.log("ReadSend");
    if (request.status == 200)
    {
        return JSON.parse(request.responseText);
    }

};

function readJSONV2(file) {

    var request = new XMLHttpRequest();
	var x = Math.random();
    request.open('GET', file+"?something="+x, false);
	
    if (request.status == 200)
    {
        return JSON.parse(request.responseText);
    }

};

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
