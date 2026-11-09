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
        'https://staging.defichrono.ch/auth/oidc-callback.php'
    );

    $oidc->addScope(['openid', 'profile', 'email']);
    $oidc->setCodeChallengeMethod('S256');

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
