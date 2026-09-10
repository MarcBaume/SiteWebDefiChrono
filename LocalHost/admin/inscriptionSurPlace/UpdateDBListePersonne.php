<?php
$NomNewDatabase = "MembresNews";
$NomOldDatabase = "Membres";
// ********************************************************************3
//          Dans la base donnée Membres on va ajouter les coureurs 1 x
// ********************************************************************
$sql = 'SELECT * FROM "'.$NomOldDatabase.'"';
$result = mysqli_query($con,$sql);
if ( $result )
{
    // Mise de chaque donnée dans tableau 
    while($CoureurInscription = mysqli_fetch_assoc($result)) 
    {
        $sql = 'SELECT * FROM "'.$NomNewDatabase.'" WHERE Nom = "'.$CoureurInscription['nom'].'" and Prenom = "'.$CoureurInscription['prenom']."' and DateNaissance ='".$CoureurInscription['DateNaissance'].'"';
        $resultMembres = mysqli_query($con,$sql);
        if ( $resultMembres )
        {
            // Insert base de donnée
            if( mysqli_num_rows($resultMembres) == 0) 
            {

            }
            else // Update si necessasaire
            {
                mysqli_fetch_assoc($result)
            }
        }
    }
}

$sql = 'SELECT * FROM ListePersonnes';
$result = mysqli_query($con,$sql);
$array = array();
if ( $result )
{
    // Mise de chaque donnée dans tableau 
    while($donnees = mysqli_fetch_assoc($result)) 
    {
        array_push($array, $donnees );
    }
}
// ********************************************************************3
//          Dans la base donnée inscription
// ********************************************************************
$sql = 'SELECT * FROM inscriptions';
$result = mysqli_query($con,$sql);
$array = array();



if ( $result )
{
    string NomDatabaseFind = "Membres"
    // Mise de chaque donnée dans tableau 
    while($CoureurInscription = mysqli_fetch_assoc($result)) 
    {
        $sql = 'SELECT * FROM "'.NomDatabaseFind.'" WHERE Nom = "'.$CoureurInscription['nom'].'" and Prenom = "'.$CoureurInscription['prenom']."' and DateNaissance ='".$CoureurInscription['DateNaissance'].'"';
        $resultMembres = mysqli_query($con,$sql);
        if ( $resultMembres )
        {
            // Mise de chaque donnée dans tableau 
            if( mysqli_num_rows($resultMembres) > 1) 
            {
                echo "Update coureur";
                
                if (strlen("") < 1)
                $sql = 'UPDATE "'.NomDatabaseFind.'" SET adresse =\''.$_REQUEST['adresse'].'\'   WHERE ID=\''.$_REQUEST['IDCoureur'].'\''; 
                $ResultAddInsc = mysqli_query($con,$sql);	
                if ( $ResultAddInsc != 1)
                {
                    print(-14);
                }

            }
        }
    }
}