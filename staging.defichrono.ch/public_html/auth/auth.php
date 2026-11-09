<?php
declare(strict_types=1);

// Configuration de la session
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();

// Chargement de Composer et de la configuration
require_once dirname(__DIR__, 2) . '/vendor/autoload.php';
// chargement variables de configuration
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->safeLoad();
require_once dirname(__DIR__, 2) . '/public_html/includes/MysqlConnect.php';
// Vérification de la session Keycloak
if (
    empty($_SESSION['oidc_pending']['sub']) ||
    empty($_SESSION['oidc_pending']['preferred_username'])
) {
    header('Location: /auth/oidc-login.php');
    exit;
}

$pending = $_SESSION['oidc_pending'];

$sub = $pending['sub'];
$login = $pending['preferred_username'];
$email = $pending['email'] ?? '';

try {
    // Recherche d'un compte déjà lié à Keycloak
    $stmt = $pdo->prepare(
        'SELECT ID, Login, Niveau
         FROM LoginV2
         WHERE KeycloakSub = :sub
         LIMIT 1'
    );

    $stmt->execute(['sub' => $sub]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Création du compte lors de la première connexion
    if (!$user) {
        //  $check = $pdo->prepare(
        //     'SELECT ID FROM Login WHERE Login = :login LIMIT 1'
        // );
        // $check->execute(['login' => $login]);

        // if ($check->fetch()) {
        //     http_response_code(409);
        //     exit('Ce nom d’utilisateur existe déjà. Contactez l’administrateur.');
        // }

        $stmt = $pdo->prepare(
            'INSERT INTO LoginV2
            (Login, Password, Niveau, Status, Adresse,
             NomEntreprise, KeycloakSub, Email)
            VALUES
            (:login, :password, :niveau, :status, :adresse,
             :entreprise, :sub, :email)'
        );

        $stmt->execute([
            'login' => $login,
            'password' => '',
            'niveau' => 3,
            'status' => '',
            'adresse' => '',
            'entreprise' => '',
            'sub' => $sub,
            'email' => $email
        ]);

        $user = [
            'ID' => (int) $pdo->lastInsertId(),
            'Login' => $login,
            'Niveau' => 3
        ];
    }

    // Création de la session utilisateur définitive
    session_regenerate_id(true);

    $_SESSION['user'] = [
        'id' => (int) $user['ID'],
        'login' => $user['Login'],
        'niveau' => (int) $user['Niveau'],
        'keycloak_sub' => $sub
    ];

    unset($_SESSION['oidc_pending']);
    $destination = $_SESSION['destination_apres_login'] ?? '/';

    unset($_SESSION['destination_apres_login']);


    if (($destination['type'] ?? '') === 'formulaire') 
    {
        header('Location:/pages/formulaire.php?IdRace=' . urlencode((string) 
        $destination['IdRace']));
    }
    else
    {
    header('Location: ' . $destination);
    }

    exit;

} catch (Throwable $e) {
    error_log('Erreur authentification DefiChrono : ' . $e->getMessage());

    http_response_code(500);
    exit('Une erreur est survenue lors de la création de votre compte.');
}
