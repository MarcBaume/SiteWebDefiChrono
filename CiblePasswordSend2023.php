


<?php
/*____________________________________________________________________

		Connection a la base  de donnée CodeReduction

______________________________________________________________________*/



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

        $message = '<html>
        <head>
        <title></title>
        </head>
        <body>
        Bonjour '.$login.'</br></br>
        Veuillez suivre ce lien pour réinitialiser votre mot de passe </br></br>
        <a style="color:blue" href="https://juradefichrono.ch/InitialisationPassword.php?Login='. $login.'&ID='.$OrderID.'">lien pour réinitialiser votre mot de passe</a>"
        </body>
        </html>';

        $headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";

         mail($_REQUEST['Login'], 'mot de passe oublié',$message ,$headers);

         print( 1); // New password 
	 
    }




?>



	
