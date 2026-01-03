


<?php
/*____________________________________________________________________

		Connection a la base  de donnée CodeReduction

______________________________________________________________________*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

header('Content-Type: application/json');

    $login = $_REQUEST['Login'];

	include("MysqlConnect.php");
    
	// Modifier les Informations en ajoutant Le Order ID dans la Colonne de la table Login Password En changement
	$sql = 'SELECT * FROM  Login  WHERE Login=\''.$login.'\''; 

    $result =  mysqli_query($con,$sql);

    $rowcount=mysqli_num_rows($result);

    if ($rowcount <1)
    {
        print(-1); //Login n'existe pas
	}  
    else
    {

        $message = 
        '<html>
        <head>
        <title>Réinitialisation du mot de passe</title>
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
      
        <h2 style="background-color: #3D6CA4;padding : 10px ;color :#fff"  > Réinitialisation du mot de passe </h2>
    
        <p>Bonjour '.$login.'</p>
        <p>
            Utilise ce lien pour réinitialiser ton mot de passe </br></br>
        </p>
        <p>
        <a href="https://defichrono.ch/InitialisationPassword.php?Login='. $login.'&ID='.$OrderID.'">Clique ici  </a>
        </p>  
        <p> Défi Chrono te souhaite d\'excellentes courses</p> </br></br>


        <img style="width:200px;"src="https://defichrono.ch/images/LogoDefiChrono2023.png"></img>
        </html>';
        
     

            
   
        $to = $login ;
        $subject = "Réinitialisation de mot de passe";

        $mail->Host = "mail.infomaniak.ch";
        
        $mail->Username = "webmaster@defichrono.ch";
     
        $mail->Password = "mot de passe";
     
        $mail->From = "webmaster@defichrono.ch";

        $mail->FromName = "Défi chrono";

        $mail->Subject =  $subject ;
       
        $mail->AltBody = $message;
     
        $mail->AddReplyTo("");

        $mail->AddAttachment(");
       
        $mail->AddAddress($login);

        $mail->IsHTML(true);

        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Le message à bien été envoyé";
        } 
    }
?>







        if (  mail($to,$subject,$message, $headers))

        {
            print( 1); // New password 
        }
        else
        {
            print(2);
        } 
	 
    }




?>



	
