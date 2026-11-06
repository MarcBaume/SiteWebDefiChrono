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

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

$clientId = $_ENV['KEYCLOAK_CLIENT_ID'] ?? '';
$clientSecret = $_ENV['KEYCLOAK_CLIENT_SECRET'] ?? '';

$destination = $_GET['destination'] ?? 'membre';

if (!isset($destinations[$destination])) {
    $destination = 'membre';
}

$_SESSION['destination_apres_login'] = $destinations[$destination];
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
    'https://staging.defichrono.ch/auth/oidc-callback.php'
);

$oidc->addScope(['openid', 'profile', 'email']);
$oidc->setCodeChallengeMethod('S256');
$oidc->authenticate();