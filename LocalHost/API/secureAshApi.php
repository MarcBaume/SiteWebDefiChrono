<!-- Génére automatiquement un token que tu vas copier dans ta base de donnée mysql 
 Ce fichier est UTILISER SEULEMENT EN LOCAL
 Le token est générer par l'application c#  --> 
 <?php
 // Inclure un fichier de configuration
require_once '../config.php'; 
$hash = hash('sha256', TOKEN_API);
echo $hash;
?>