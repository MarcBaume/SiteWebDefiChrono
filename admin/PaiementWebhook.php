<!DOCTYPE html>
<html>
<head>
<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="../styleV2.css" type="text/css"/>
	 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
	 </script>
	 <script type="text/javascript" src="https://media.payrexx.com/modal/v1/modal.min.js"></script>
 <script src="../js/prototype.js" >
</script></head>
<body>
<?php
/*

{
  "transactionId" : "{transactionId}",
  "merchantId": "1100012345",
  "type" : "payment",
  "status" : "authorized",
  "currency" : "CHF",
  "refno" : "Test-1234",
  "paymentMethod" : "ECA",
  "detail" : {
    "authorize" : {
      "amount" : 1000,
      "acquirerAuthorizationCode" : "113009"
    }
  },
  "card" : {
    "alias" : "{cardAlias}",
    "masked" : "520000xxxxxx0007",
    "expiryMonth" : "12",
    "expiryYear" : "29",
    "info" : {
      "brand" : "MCI CREDIT",
      "type" : "credit",
      "usage" : "consumer",
      "country" : "MY",
      "issuer" : "DATATRANS"
    },
    "3D" : {
      "authenticationResponse" : "Y"
    }
  },
  "history" : [ {
    "action" : "init",
    "amount" : 1000,
    "source" : "api",
    "date" : "20XX-09-14T09:25:27Z",
    "success" : true,
    "ip" : "85.0.141.184"
  }, {
    "action" : "authorize",
    "amount" : 1000,
    "source" : "redirect",
    "date" : "20XX-09-14T09:25:26Z",
    "success" : true,
    "ip" : "85.0.141.184"
  } ]
}

*/
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
$transactionId =  $data["transactionId"];
$status = $data["status"];

echo $referenceId ;
echo $status ;

// https://defichrono.ch/admin/PaiementWebhook.php?transactionId=241115121940923842&status=test
		$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
		mysqli_select_db($con ,'dxvv_jurachrono' );
echo $_POST["transactionId"];
echo $_POST["status"];
$sql = 'SELECT * FROM inscription  WHERE  OrderPayement=\''.$transactionId.'\'';
$result = mysqli_query($con,$sql);
echo  mysqli_num_rows($result);

// On affiche chaque entrée une à une
	if ($result && mysqli_num_rows($result) > 0) 
	{
		$sql = 'UPDATE inscription SET Payer = \''.$status.'\'  WHERE OrderPayement=\''.$transactionId .'\''; 
	
		if (!mysqli_query($con,$sql))
	{
	  echo "Error update : inscription adresse " . mysql_error();
	}  
}
		?>
