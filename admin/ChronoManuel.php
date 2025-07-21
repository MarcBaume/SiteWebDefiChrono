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
function TableauDetection(val)
{
    var Table = document.getElementById("mytable");
              Table.innerHTML = "";

              let RowsTableCat =	document.createElement('tr');
                let HeaderTableCat =	document.createElement('th');
                
                HeaderTableCat.textContent = "N°" ;	
                RowsTableCat.append(HeaderTableCat);
                HeaderTableCat =	document.createElement('th');
                HeaderTableCat.textContent = "Temps";	
                 RowsTableCat.append(HeaderTableCat);

                 HeaderTableCat =	document.createElement('th');
                HeaderTableCat.textContent = "Départ";	
                 RowsTableCat.append(HeaderTableCat);
                 Table.append(RowsTableCat);
                var test1  =0;// parseInt(val.length)
  

                while (test1 < val.length-1) {

              let RowsTableCat =	document.createElement('tr');
                let HeaderTableCat =	document.createElement('td');
                HeaderTableCat.style = "font-size:40px;Margin:5px;";
                HeaderTableCat.textContent = val[test1].Dossard ;	
                RowsTableCat.append(HeaderTableCat);
                HeaderTableCat =	document.createElement('td');
                HeaderTableCat.style = "font-size:24px";
                HeaderTableCat.textContent = val[test1].DateModification;	
                RowsTableCat.append(HeaderTableCat);
                HeaderTableCat =	document.createElement('td');
                HeaderTableCat.style = "font-size:24px";
                HeaderTableCat.textContent = val[test1].Depart;	
                RowsTableCat.append(HeaderTableCat);
                 Table.append(RowsTableCat);
                 test1++;
            }
            document.getElementById("Dossard").value= "";
            document.getElementById("Dossard").select();
}


	</script>
 </head>
 <body>
<form id="FormulaireDossard" method="get" action="CibleChronoManuel.php" >
<table style="width:100%">
<tr>
  <td style="width:50%;">
  <h3  class="title1"> Chrono Manuel <input type="text" margin="5px"style="height:40px; font-size:20px"   name="Depart_Form" id="Depart_Form" value=<? echo $_COOKIE['Depart']?>  ></input></h3>
</td>
<td style="width:50%;">
<p id="Clock" style="font-size:70px; text-align: center;" ></p>
<td>
</tr>
  <tr>
  <td colspan="2">
      <input type="number" name="Dossard" id="Dossard"  min="1" max="9999" style="margin:10px;Padding:30px;width:80%;font-size:100px;text-align: center;" autocomplete="off"   autofocus="true" />
      <input type="hidden" name="Temps"  id="Temps" />
</td>
    </tr>
    <tr>
    <td>
      <input type="button" style="height:70px; font-size:25px; margin:20px; " onClick="onReset(this)"    value="Reset"></input>    
      </td>
  <td>
      <input type="button" style="font-size:40px;margin:20px;padding:40px;width:50%;" id="ButtonValid"   onClick="onChange(this)" value="Valider"></input>
      </td>

    </tr>
</table>

</form>
<div  id="TableauResulat">

<table id="mytable" style="width :100%">
</table>
</div>
</body>
</html>
<script>
  // Get the input field
var input = document.getElementById("Dossard");

// Execute a function when the user presses a key on the keyboard
input.addEventListener("keypress", function(event) {
  // If the user presses the "Enter" key on the keyboard
  if (event.key === "Enter") {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("ButtonValid").click();
  }
});
</script>
