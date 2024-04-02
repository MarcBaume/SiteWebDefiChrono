

<?php

    // On se connecte à MySQL
 $con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  else
  {
	mysqli_select_db($con ,'dxvv_jurachrono' );
	// Create table de donnée du nom de parcours
	mysqli_select_db($con,$row['Database']);

	// Modificaiton Nom
	$sql = 'UPDATE inscription SET Nom = \''.$_POST["nom"].'\'  WHERE ID=\''.$_POST["ID"].'\''; 
	if (!mysqli_query($con,$sql))
	{
		echo "Error update : inscription Nom" . mysql_error();
	}  

	// Modificaiton Prénom
	$sql = 'UPDATE inscription SET Prenom = \''.$_POST["prenom"].'\' WHERE ID=\''.$_POST["ID"].'\''; 
	if (!mysqli_query($con,$sql))
	{
	  echo "Error update : inscription Prénom " . mysql_error();
	}  
	// Modification Adresse
	$sql = 'UPDATE inscription SET adresse = \''.$_POST["adresse"].'\' WHERE ID=\''.$_POST["ID"].'\''; 
	if (!mysqli_query($con,$sql))
	{
	  echo "Error update : inscription adresse " . mysql_error();
	}  
	  
	// MOdification NPA
	$sql = 'UPDATE inscription SET npa = \''.$_POST["npa"].'\'  WHERE ID=\''.$_POST["ID"].'\''; 
	if (!mysqli_query($con,$sql))
	{
	  echo "Error update : inscription NPA " . mysql_error();
	}  
	  
	// Modification localite
	$sql = 'UPDATE inscription SET localite = \''.$_POST["localite"].'\'  WHERE ID=\''.$_POST["ID"].'\''; 
	if (!mysqli_query($con,$sql))
	{
		echo "Error update : inscription localité " . mysql_error();
	}  
		// MODIFICATION dATE nAISSANCE
	  $sql = 'UPDATE inscription SET  DateNaissance = \''.$_POST["date"].'\' WHERE ID=\''.$_POST["ID"].'\''; 
	  if (!mysqli_query($con,$sql))
	  {
	  echo "Error update : inscription dATE NAISSANCE " . mysql_error();
	  }  
		// MODIFICATION sEXE
	  $sql = 'UPDATE inscription SET Sexe = \''.$_POST["sexe"].'\'  WHERE ID=\''.$_POST["ID"].'\''; 
			if (!mysqli_query($con,$sql))
	  {
	  echo "Error update : inscription sEXE " . mysql_error();
	  }  
		// MODIFICATION cLUB
	  $sql = 'UPDATE inscription SET  club = \''.$_POST["club"].'\' WHERE ID=\''.$_POST["ID"].'\''; 
	  if (!mysqli_query($con,$sql))
	  {
		echo "Error update : inscription cLUB " . mysql_error();
	  } 
		// MODIFICATION Num Catégorie
	   $sql = 'UPDATE inscription SET NumCategorie = \''.$_POST["NumCategorie"].'\'  WHERE ID=\''.$_POST["ID"].'\''; 
	  if (!mysqli_query($con,$sql))
	  {
	  echo "Error update : inscription Num Catégorie " . mysql_error();
	  } 
	  
	  // MODIFICATION Nom Catégorie
	   $sql = 'UPDATE inscription SET NomCategorie = \''.$_POST["NomCategorie"].'\'  WHERE ID=\''.$_POST["ID"].'\''; 
	  if (!mysqli_query($con,$sql))
	  {
	  echo "Error update : inscription Nom Catégorie " . mysql_error();
	  } 
	  // MODIFICATION MAIL
	   $sql = 'UPDATE inscription SET mail = \''.$_POST["mail"].'\' WHERE ID=\''.$_POST["ID"].'\''; 
	  if (!mysqli_query($con,$sql))
	  {
		echo "Error update : inscription mAIL " . mysql_error();
	  } 
		  // MODIFICATION Nom Depart
	   $sql = 'UPDATE inscription SET NomDepart = \''.$_POST["NomDepart"].'\' WHERE ID=\''.$_POST["ID"].'\''; 
	  if (!mysqli_query($con,$sql))
	  {
		echo "Error update : inscription NomDepart " . mysql_error();
	  } 
	 // MODIFICATION Parcours
	   $sql = 'UPDATE inscription SET Parcours = \''.$_POST["parcours"].'\' WHERE ID=\''.$_POST["ID"].'\''; 
		if (!mysqli_query($con,$sql))
	  {
		echo "Error update : inscription Parcours" . mysql_error();
	  }
	  
	  // MODIFICATION type équipe
	   $sql = 'UPDATE inscription SET TypeEquipe = \''.$_POST["TypeEquipe"].'\' WHERE ID=\''.$_POST["ID"].'\''; 
		if (!mysqli_query($con,$sql))
	  {
		echo "Error update : inscription TypeEquipe" . mysql_error();
	  }
	  
	   // MODIFICATION Prix Souvenir
	   $sql = 'UPDATE inscription SET PrixSouvenir = \''.$_POST["PrixSouvenir"].'\' WHERE ID=\''.$_POST["ID"].'\''; 
		if (!mysqli_query($con,$sql))
	  {
		echo "Error update : inscription PrixSouvenir" . mysql_error();
	  }
	  
	   // MODIFICATION Type équipe
	   $sql = 'UPDATE inscription SET NomEquipe = \''.$_POST["NomEquipe"].'\' WHERE ID=\''.$_POST["ID"].'\''; 
		if (!mysqli_query($con,$sql))
	  {
		echo "Error update : inscription NomEquipe" . mysql_error();
	  }
	  	 // MODIFICATION NomDisc1
	   $sql = 'UPDATE inscription SET NomDisc1 = \''.$_POST["NomDisc1"].'\' WHERE ID=\''.$_POST["ID"].'\''; 
		if (!mysqli_query($con,$sql))
	  {
		echo "Error update : inscription NomDisc1" . mysql_error();
	  }
	  	 // MODIFICATION PrenomDisc1
	   $sql = 'UPDATE inscription SET PrenomDisc1 = \''.$_POST["PrenomDisc1"].'\' WHERE ID=\''.$_POST["ID"].'\''; 
		if (!mysqli_query($con,$sql))
	  {
		echo "Error update : inscription PrenomDisc1" . mysql_error();
	  }
	  	 // MODIFICATION NomDisc2
	   $sql = 'UPDATE inscription SET NomDisc2 = \''.$_POST["NomDisc2"].'\' WHERE ID=\''.$_POST["ID"].'\''; 
		if (!mysqli_query($con,$sql))
	  {
		echo "Error update : inscription NomDisc2" . mysql_error();
	  }
	  
	   	 // MODIFICATION PrenomDisc2
	   $sql = 'UPDATE inscription SET PrenomDisc2 = \''.$_POST["PrenomDisc2"].'\' WHERE ID=\''.$_POST["ID"].'\''; 
		if (!mysqli_query($con,$sql))
	  {
		echo "Error update : inscription PrenomDisc2" . mysql_error();
	  }
	    	 // MODIFICATION NomDisc3
	   $sql = 'UPDATE inscription SET NomDisc3 = \''.$_POST["NomDisc3"].'\' WHERE ID=\''.$_POST["ID"].'\''; 
		if (!mysqli_query($con,$sql))
	  {
		echo "Error update : inscription NomDisc3" . mysql_error();
	  }
	  
	   	 // MODIFICATION PrenomDisc3
	   $sql = 'UPDATE inscription SET PrenomDisc3 = \''.$_POST["PrenomDisc3"].'\' WHERE ID=\''.$_POST["ID"].'\''; 
		if (!mysqli_query($con,$sql))
	  {
		echo "Error update : inscription PrenomDisc3" . mysql_error();
	  }
	  
	    	 // MODIFICATION NomDisc4
	   $sql = 'UPDATE inscription SET NomDisc4 = \''.$_POST["NomDisc4"].'\' WHERE ID=\''.$_POST["ID"].'\''; 
		if (!mysqli_query($con,$sql))
	  {
		echo "Error update : inscription NomDisc4" . mysql_error();
	  }
	  
	   	 // MODIFICATION PrenomDisc4
	   $sql = 'UPDATE inscription SET PrenomDisc4 = \''.$_POST["PrenomDisc4"].'\' WHERE ID=\''.$_POST["ID"].'\''; 
		if (!mysqli_query($con,$sql))
	  {
		echo "Error update : inscription PrenomDisc4" . mysql_error();
	  }
	  
	    	 // MODIFICATION NomDisc5
	   $sql = 'UPDATE inscription SET NomDisc5 = \''.$_POST["NomDisc5"].'\' WHERE ID=\''.$_POST["ID"].'\''; 
		if (!mysqli_query($con,$sql))
	  {
		echo "Error update : inscription NomDisc5" . mysql_error();
	  }
	  
	   	 // MODIFICATION PrenomDisc5
	   $sql = 'UPDATE inscription SET PrenomDisc5 = \''.$_POST["PrenomDisc5"].'\' WHERE ID=\''.$_POST["ID"].'\''; 
		if (!mysqli_query($con,$sql))
	  {
		echo "Error update : inscription PrenomDisc2" . mysql_error();
	  }
	  
	    	 // MODIFICATION NomDisc6
	   $sql = 'UPDATE inscription SET NomDisc6 = \''.$_POST["NomDisc6"].'\' WHERE ID=\''.$_POST["ID"].'\''; 
		if (!mysqli_query($con,$sql))
	  {
		echo "Error update : inscription NomDisc6" . mysql_error();
	  }
	  
	   	 // MODIFICATION PrenomDisc6
	   $sql = 'UPDATE inscription SET PrenomDisc6 = \''.$_POST["PrenomDisc6"].'\' WHERE ID=\''.$_POST["ID"].'\''; 
		if (!mysqli_query($con,$sql))
	  {
		echo "Error update : inscription PrenomDisc6" . mysql_error();
	  }
	   // MODIFICATION Paiement
	   $sql = 'UPDATE inscription SET Payer = \''.$_POST["Payer"].'\' WHERE ID=\''.$_POST["ID"].'\''; 
		if (!mysqli_query($con,$sql))
	  {
		echo "Error update : inscription Payer" . mysql_error();
	  }
		mysqli_close($con);
  }
?>
<body onload="document.formulaire.submit();">
	 <form  method="post" action ="listeInscriptionOrganisateur.php" name="formulaire" >
	 <input type="hidden" name="login" id="login" tabindex="10"  size="60"  value= '<?php echo $_POST['login'] ?>' />
	<input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $_POST["DateCourse"] ?>' />
			<input type="hidden" name="etape" id="etape" value= '<?php echo $_POST["etape"] ?>' />
			<input type="hidden" name="NomCourse" id="NomCourse" tabindex="10"  size="60"  value= '<?php echo $_POST["NomCourse"] ?>' />
	 </form>
</body>