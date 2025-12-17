<?php// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
	// Selecting Database
	mysqli_select_db($con ,'dxvv_jurachrono' );
$login = $_POST["login"];
// Verifier si login pas existant
	$sql = 'SELECT * FROM Login WHERE Login=\''.$login.'\'';
	$result = mysqli_query($con,$sql);

    // On affiche chaque entrée une à une
	if ( !$result || mysqli_num_rows($result) > 0) 
	{
        print- 1;
	//Cette adresse e-mail est déjà utilisé par un compte
	}
	
	print 1;