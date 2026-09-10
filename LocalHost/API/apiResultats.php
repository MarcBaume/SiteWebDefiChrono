<?php
// -------------------------------------------------------------------------
// 1. CONFIGURATION DES EN-TÊTES (CORS & JSON)
// -------------------------------------------------------------------------
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Gestion de la requête de pré-vérification (Preflight) des navigateurs/clients
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// -------------------------------------------------------------------------
// 2. DONNÉES DE SIMULATION (Base de données temporaire)
// -------------------------------------------------------------------------
$produits = [
    ["id" => 1, "nom" => "Ordinateur fixe", "prix" => 899.00],
    ["id" => 2, "nom" => "Souris s", "prix" => 25.50],
    ["id" => 3, "nom" => "Clavier", "prix" => 79.99]
];

// Récupération de la méthode HTTP
$method = $_SERVER['REQUEST_METHOD'];

// -------------------------------------------------------------------------
// 3. ROUTAGE ET TRAITEMENT DE LA REQUÊTE
// -------------------------------------------------------------------------
switch ($method) {

    // Récupérer les produits
    case 'GET':
        http_response_code(200);
        echo json_encode($produits);
        break;

    // Ajouter un produit
    case 'POST':
        // Lecture du flux JSON envoyé par l'application C#
        $json_recu = file_get_contents("php://input");
        $donnees = json_decode($json_recu, true);

        // Validation stricte des données reçues
        if (!empty($donnees['nom']) && isset($donnees['prix']) && is_numeric($donnees['prix'])) {
            
        $host    = 'localhost';
        $db      = 'test';
        $user    = 'root';
        $pass    = '';
        $charset = 'utf8mb4';

        // Configuration du DSN (Data Source Name)
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        // Options de configuration PDO pour la sécurité et la gestion des erreurs
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Active les exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Tableaux associatifs par défaut
            PDO::ATTR_EMULATE_PREPARES   => false,                  // Utilise les vraies requêtes préparées
        ];

        try {
            // 1. Connexion à la base de données
            $pdo = new PDO($dsn, $user, $pass, $options);

            // Données fictives à insérer
            $nom   = 'Dupont';
            $email = 'jean.dupont@example.com';

            // 2. Préparation de la requête SQL avec des marqueurs nommés (:nom, :email)
            $sql  = "INSERT INTO api (nom, prix,count) VALUES (:nom, :prix, :count)";
            $stmt = $pdo->prepare($sql);

            // 3. Exécution de la requête en passant les données associées
            $stmt->execute([
                ':nom'   => $donnees['nom'],
                ':prix' => $donnees['prix'],
                ':count' => count($produits) + 1
            ]);

            // Récupération de l'identifiant généré (si la colonne est en AUTO_INCREMENT)
            $dernierId = $pdo->lastInsertId();

            echo "Données insérées avec succès ! ID généré : " . $dernierId;

        } catch (PDOException $e) {
            // Gestion des erreurs de connexion ou de requête
            echo "Erreur d'insertion : " . $e->getMessage();
        }
            $nouveauProduit = [
                "id" => count($produits) + 1,
                "nom" => htmlspecialchars($donnees['nom']), // Sécurisation basique
                "prix" => (float)$donnees['prix']
            ];

            http_response_code(201); // 201 Created
            echo json_encode([
                "status" => "success",
                "message" => "Produit ajouté avec succès.",
                "item" => $nouveauProduit
            ]);
        } else {
            http_response_code(400); // 400 Bad Request
            echo json_encode([
                "status" => "error",
                "message" => "Données invalides ou incomplètes. Les champs 'nom' et 'prix' sont obligatoires."
            ]);
        }
        break;

    // Méthode non gérée dans cet exemple
    default:
        http_response_code(405); // 405 Method Not Allowed
        echo json_encode([
            "status" => "error",
            "message" => "Méthode HTTP " . $method . " non autorisée."
        ]);
        break;
}
?>