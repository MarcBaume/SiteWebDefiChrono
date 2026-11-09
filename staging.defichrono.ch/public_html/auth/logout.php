<?php
declare(strict_types=1);

session_start();

// Suppression de toutes les données de session PHP
$_SESSION = [];

// Suppression du cookie de session
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

// Destruction de la session
session_destroy();
// URL de déconnexion Keycloak
$logoutUrl = 'https://auth.defichrono.ch/realms/loginDefiChrono/protocol/openid-connect/logout';

$params = [
    'client_id' => 'defichrono-php',
    'post_logout_redirect_uri' => 'https://staging.defichrono.ch/'
];

if (is_string($idToken) && $idToken !== '') {
    $params['id_token_hint'] = $idToken;
}

header('Location: ' . $logoutUrl . '?' . http_build_query($params));
exit;
?>