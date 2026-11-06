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

// Retour à l'accueil
header('Location: /');
exit;
?>