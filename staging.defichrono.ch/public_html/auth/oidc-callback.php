<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();
echo '<pre>';
echo 'Session ID : ' . session_id() . PHP_EOL;
echo 'Session active : ' . (session_status() === PHP_SESSION_ACTIVE ? 'oui' : 'non') . PHP_EOL;
echo 'Cookie reçu : ' . (isset($_COOKIE[session_name()]) ? 'oui' : 'non') . PHP_EOL;
echo 'Clés de session : ' . implode(', ', array_keys($_SESSION)) . PHP_EOL;
echo '</pre>';

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

$clientId = $_ENV['KEYCLOAK_CLIENT_ID'] ?? '';
$clientSecret = $_ENV['KEYCLOAK_CLIENT_SECRET'] ?? '';

if ($clientId === '' || $clientSecret === '') {
    http_response_code(500);
    exit('Configuration OIDC manquante.');
}

if (!isset($_GET['code'], $_GET['state'])) {
    http_response_code(400);
    exit('Réponse d’authentification invalide.');
}

try {
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
error_log('OIDC login session : ' . session_id());
    if (!$oidc->authenticate()) {
        throw new RuntimeException('Authentification incomplète.');
    }

    $sub = $oidc->getVerifiedClaims('sub');

    if (!is_string($sub) || $sub === '') {
        throw new RuntimeException('Identifiant Keycloak absent.');
    }

    session_regenerate_id(true);

    $_SESSION['oidc_pending'] = [
        'sub' => $sub,
        'email' => $oidc->getVerifiedClaims('email'),
        'preferred_username' => $oidc->getVerifiedClaims('preferred_username'),
        'id_token' => $oidc->getIdToken()
    ];

    header('Location: /auth/auth.php');
exit;


} catch (Throwable $e) {
    error_log('Erreur OIDC : ' . $e->getMessage());
    http_response_code(401);
    exit('Impossible de terminer la connexion. Veuillez réessayer.');
}
