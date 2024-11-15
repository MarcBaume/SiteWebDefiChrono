
<?php
//Exemple  Code Recu 
$ExempleJson ='{
    "transaction": {
        "id": 1,
        "uuid": null,
        "amount": 10000,
        "referenceId": null,
        "time": "2024-11-15 14:29:34",
        "status": "confirmed",
        "lang": "fr",
        "psp": "",
        "pspId": 1,
        "mode": "TEST",
        "refundable": false,
        "partiallyRefundable": false,
        "metadata": {},
        "invoice": {
            "number": "123456",
            "products": [
                {
                    "name": 123456,
                    "price": 100,
                    "quantity": 1,
                    "sku": null,
                    "vatRate": null
                }
            ],
            "discount": {
                "code": null,
                "amount": 0,
                "percentage": null
            },
            "shippingAmount": null,
            "currency": "CHF",
            "test": 1,
            "referenceId": null,
            "paymentRequestId": null,
            "paymentLink": null,
            "googleAnalyticProducts": [
                {
                    "item_id": null,
                    "item_name": 123456,
                    "price": 1,
                    "quantity": 1
                }
            ],
            "originalAmount": 10000,
            "refundedAmount": 0,
            "custom_fields": [
                {
                    "type": "text",
                    "name": "Hobby",
                    "value": "Fussball"
                }
            ]
        },
        "contact": {
            "id": null,
            "uuid": null,
            "title": "2",
            "firstname": "Baume",
            "lastname": "Marc",
            "company": "",
            "street": "Industrie 21",
            "zip": "2345",
            "place": "Les Breuleux",
            "country": "Suisse",
            "countryISO": "CH",
            "phone": "+41 789074059",
            "email": "marcbaume12@gmail.com",
            "date_of_birth": "10.02.1990",
            "delivery_title": "",
            "delivery_firstname": "",
            "delivery_lastname": "",
            "delivery_company": "",
            "delivery_street": "",
            "delivery_zip": "",
            "delivery_place": "",
            "delivery_country": "",
            "delivery_countryISO": ""
        },
        "subscription": null,
        "pageUuid": null,
        "payrexxFee": 0,
        "payment": {
            "brand": null,
            "wallet": null,
            "purchaseOnInvoiceInformation": null
        },
        "payoutUuid": null,
        "instance": {
            "name": "defichrono",
            "uuid": "eaef2121"
        }
    }
}';



header('Content-Type: application/json');

$request = file_get_contents('php://input');

$req_dump = print_r( $request, true );

$fp = file_put_contents( 'request.log', $req_dump );

// Updated Answer

if($json = json_decode(file_get_contents("php://input"), true)){

$data = $json;

}

print_r($data);

echo "Resultat";

$referenceId = $data["transaction"]["invoice"]["number"];
$status =  $data["transaction"]["status"];
if ($status == "confirmed")
{
	$status = "Payé";
}
echo $referenceId ;
echo $status ;

// https://defichrono.ch/admin/PaiementWebhook.php?transactionId=241115121940923842&status=test
		$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
		mysqli_select_db($con ,'dxvv_jurachrono' );
if (strlen($referenceId)> 0)
{
	$sql = 'SELECT * FROM inscription  WHERE  OrderPayement=\''.$referenceId.'\'';
	$result = mysqli_query($con,$sql);
	echo  mysqli_num_rows($result);

	// On affiche chaque entrée une à une
		if ($result && mysqli_num_rows($result) > 0) 
		{
			$sql = 'UPDATE inscription SET Payer = \''.$status.'\'  WHERE OrderPayement=\''.$referenceId.'\''; 
		
			if (!mysqli_query($con,$sql))
		{
		echo "Error update : inscription adresse " . mysql_error();
		}  
	}
}
		?>
