<?php
declare(strict_types=1);
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();
echo '<pre>';
echo 'Session ID avant départ : ' . session_id() . PHP_EOL;
echo 'Clés de session : ' . implode(', ', array_keys($_SESSION)) . PHP_EOL;
echo '</pre>';
$destination = $_GET['destination'] ?? 'home';


if (($_GET['destination'] ?? '') === 'formulaire' && 
isset($_GET['IdRace'])) {
    $_SESSION['destination_apres_login'] = [
        'type' => 'formulaire',
        'IdRace' => (int) $_GET['IdRace']
    ];
} else {
    $_SESSION['destination_apres_login'] = [
        'type' => 'member'
    ];
}

$origine = $_GET['origine'] ?? 'member';

if (!in_array($origine, ['member', 'formulaire'], true)) {
    $origine = 'member';
}

$_SESSION['origine_connexion'] = $origine;

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

$clientId = $_ENV['KEYCLOAK_CLIENT_ID'] ?? '';
$clientSecret = $_ENV['KEYCLOAK_CLIENT_SECRET'] ?? '';


if ($clientId === '' || $clientSecret === '') {
    http_response_code(500);
    exit('Configuration OIDC manquante.');
}

$oidc = new Jumbojett\OpenIDConnectClient(
    'https://auth.defichrono.ch/realms/loginDefiChrono',
    $clientId,
    $clientSecret
);

$oidc->setRedirectURL(
    'https://productionv2.defichrono.ch/auth/oidc-callback.php'
);

$oidc->addScope(['openid', 'profile', 'email']);
$oidc->setCodeChallengeMethod('S256');
$oidc->authenticate();