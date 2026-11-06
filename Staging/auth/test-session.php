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

if (!isset($_SESSION['oidc_pending'])) {
    echo 'Session présente, mais aucune authentification Keycloak en attente.';
    exit;
}

echo 'Session PHP conservée.<br>';
echo 'Identifiant Keycloak : présent<br>';
echo 'Email : ' .
    (isset($_SESSION['oidc_pending']['email']) ? 'présent' : 'absent') .
    '<br>';
echo 'Nom utilisateur : ' .
    (isset($_SESSION['oidc_pending']['preferred_username']) ? 'présent' : 'absent');
