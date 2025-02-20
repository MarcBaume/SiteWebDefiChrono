


<?php
/*____________________________________________________________________

		Connection a la base  de donnée CodeReduction

______________________________________________________________________*/


header('Content-Type: application/json');

    $login = $_REQUEST['Login'];

	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	// Selecting Database
	mysqli_select_db($con ,'dxvv_jurachrono' );
	
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
         Utilise ce lien pour réinitialiser ton mot de passe </br></br></p>
  <p>
    <a href="https://defichrono.ch/InitialisationPassword.php?Login='. $login.'&ID='.$OrderID.'">Clique ici  </a>
    </p>  
    <p> Défi Chrono te souhaite d\'excellentes courses</p> </br></br>


        <img style="width:200px;"src="https://defichrono.ch/images/LogoDefiChrono2023.png"></img>
        </html>';
        
     
        $from = "webmaster@defichrono.ch";
        $headers = array(
            'From' => 'Défi chrono<info@defichrono.ch>',
            'Reply-To' => 'Défi chrono<info@defichrono.ch>',
            'Content-Type' => 'text/html; charset=utf-8'
        );

        $to = $login ;
        $subject = "Réinitialisation de mot de passe";

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



	
