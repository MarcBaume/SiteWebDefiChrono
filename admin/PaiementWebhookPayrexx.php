
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

if($json = json_decode(file_get_contents("php://input"), true))
{
    $data = $json;
}

print_r($data);

echo "Resultat";

$referenceId = $data["transaction"]["invoice"]["number"];
$status =  $data["transaction"]["status"];
$email =  $data["transaction"]["contact"]["email"];
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
    $message = '<html>
    <head>
    <title>Confirmation inscription(s)</title>
    <style>
table, td, th {
  border: 1px solid;
  padding : 5px;
}

table {
  border-collapse: collapse;
}
        
    </style>
    </head>
  
    <h2 style="background-color: #3D6CA4;padding : 10px ;color :#fff"  > Confirmation inscription(s) </h2></br></br>


    <table style="border:1px"> 
    <tr>
        <th width="20%"> Course</th>
        <th width="15%"> Nom</th>
        <th width="15%"> Prénom</th>
        <th width="15%"> Parcours </th>
        <th width="15%">  Catégorie</th>
        <th width="15%">  Type</th>
        <th width="15%">  Prix</th>
    </tr>';


    if ($result && mysqli_num_rows($result) > 0) 
    {
        $sql = 'UPDATE inscription SET Payer = \''.$status.'\'  WHERE OrderPayement=\''.$referenceId.'\''; 

      
        if (!mysqli_query($con,$sql))
        {
             $message =  $message . "Error update : inscription adresse " .$referenceId ." " . mysql_error();
             $headers = 'From: Defi chrono <info@defichrono.ch>'."\r\n";
             $headers = "Content-Type: text/html; charset=utf-8\r\n";
             
             if ( mail( 'info@defichrono.ch' , 'Erreur update status inscription webhook'.$referenceId,$message ,$headers))
             {
               echo  'Envoie ok';
             }
        }  
        else
        {
            $sql = 'SELECT * FROM inscription   WHERE OrderPayement=\''.$referenceId.'\''; 
            $result = mysqli_query($con,$sql);
            if ($result && mysqli_num_rows($result) > 0) 
            {
                while($donnees = mysqli_fetch_assoc($result)) 
                {
                  
                    $message =  $message . "
                        <tr>
                            <td>".  $donnees['course'] ."</td>
                            <td>".  $donnees['Nom']."</td>
                            <td>".  $donnees['Prenom']."</td>
                            <td>". $donnees['parcours']."</td>
                            <td>". $donnees['NomCategorie'] ."</td>
                            <td>". $donnees['NbrEtape']."</td>
                            <td>". $donnees['Prix'] ."</td>
                        </tr>";
                        echo $message;
                }
             }
             else
             {
                echo "Error list";
             }

        }
    }
    $headers = array(
        'From' => 'Défi chrono<webmaster@defichrono.ch>',
        'Reply-To' => 'Défi chrono<webmaster@defichrono.ch>',
        'Content-Type' => 'text/html; charset=utf-8'
    );
    
    $message =  $message . "</table><p> Défi Chrono vous souhaite une bonne course </p> </br></br>
<p>
    <img style='width:200px;'src='https://defichrono.ch/images/LogoDefiChrono2023.png'></img>
    </p></br></br>
    <i>
    * Le paiement sera remboursé seulement sur présentation d'un certificat médical à transmettre par e-mail à info@juradefichrono.ch </br>
    </i>";
    // Envoie de email seulement si l'inscription est payé
    if ($status == "Payé")
    {
        if ( mail( $email , 'Confirmation inscription(s) Défi chrono',$message ,$headers))
        {
        echo  'Envoie ok';
        }
    }
}


?>
