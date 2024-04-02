<?php
/*
Neoterranos & LkY
Page deconnexion.php

Permet de se déconnecter du site.

Quelques indications : (Utiliser l'outil de recherche et rechercher les mentions données)

Liste des fonctions :
--------------------------
Aucune fonction
--------------------------


Liste des informations/erreurs :
--------------------------
Déconnexion
--------------------------
*/

session_start();

//vider_cookie();
session_destroy();

header('Location: index.php'); 
?>