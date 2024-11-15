
<?php
/*
   



basicAuth : encoder le merchand id et le mot de passe en base code 64

Exemple : 
   1110018304:1HDt1m7dI8M1xZ9n

https://www.base64encode.org/

https://api-reference.datatrans.ch/

https://docs.datatrans.ch/docs/api-endpoints


https://docs.datatrans.ch/docs/redirect-lightbox

Exemple CURL

curl 'https://api.sandbox.datatrans.com/v1/transactions' \
--header 'Authorization: Basic {basicAuth}' \
--header 'Content-Type: application/json' \
--data-raw '{
	"currency": "CHF",
	"refno": "Test-1234",
	"amount": 1000,
	"paymentMethods": ["VIS","ECA","PAP,"TWI"],
	"autoSettle": true,
	"option": {
		"createAlias": true
	},
	"redirect": {
		"successUrl": "{successUrl}",
		"cancelUrl": "{cancelUrl}",
		"errorUrl": "{errorUrl}"
	},
	"theme": {
		"name": "DT2015",
		"configuration": {
			"brandColor": "#FFFFFF",
			"logoBorderColor": "#A1A1A1",
			"brandButton": "#A1A1A1",
			"payButtonTextColor": "#FFFFFF",
			"logoSrc": "{svg}",
			"logoType": "circle",
			"initialView": "list",
		}
	}
}
*/?>
<script>

// Recherche coureur sélectionné dans la lsite des coureurs inscrits
 function UpdateIDTransaction()
 {


	FormValue = document.getElementById("FormIdTransaction");
	FormValue.action="AddTransactionIDToCoureur.php";

	$('FormulaireCoureur').request({
			onComplete: function(transport){

				 val =transport.responseText.evalJSON();
				 console.log("Find Coureur ID");
				 console.log(val);

			}
		});
}
<?php
echo 'v1.0.0.0';
$ch = curl_init("https://api.sandbox.datatrans.com/v1/transactions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Authorization: Basic MTExMDAxODMwNDoxSER0MW03ZEk4TTF4Wjlu','Content-Type: application/json')); 
curl_setopt($ch, CURLOPT_POSTFIELDS, '{
	"currency": "CHF",
	"refno": "Test-1234",
	"amount": 100,
	"paymentMethods": ["VIS","ECA","PAP","TWI"],
	"autoSettle": true,
        "theme": {
		"name": "DT2015",
		"configuration": {
			"brandColor": "#FFFFFF",
			"logoBorderColor": "#A1A1A1",
			"brandButton": "#A1A1A1",
			"payButtonTextColor": "#FFFFFF",
			"logoType": "circle",
			"initialView": "list"
		}
	}
}');       
$StrAccept =   "https://juradefichrono.ch/admin/PaiementAccepted.php?Login=". $_SESSION["Login"]."&ID=".$OrderID
$StrRefused =  "https://juradefichrono.ch/admin/PaiementDecliened.php?Login=". $_SESSION["Login"]."&ID=".$OrderID 

$data =curl_exec($ch);
if(curl_error($ch)) {
        echo 'Error';

}
else
{
      
     echo 'ok'; 
	 $obj = json_decode($data);
	$Test =  $obj->{'transactionId'};
	// Sauvegarder le transaction Id dans la base de donnée mysql


?>
	<a href=<?php echo "https://pay.sandbox.datatrans.com/v1/start/".  $Test?>>Click me</a>
	<script src="https://pay.sandbox.datatrans.com/upp/payment/js/datatrans-2.0.0.js">
	<?
}
curl_close($ch);



?>
