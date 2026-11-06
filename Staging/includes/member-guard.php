<?php
declare(strict_types=1);

// Démarrage de la session
if (session_status() !== PHP_SESSION_ACTIVE) {
        session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Lax'
]);
    session_start();

}

// Vérification de la connexion
if (!isset($_SESSION['user']['login'])) {
    header('Location: /');
    exit;
}

// Vérification du niveau membre
if ((int) $_SESSION['user']['niveau'] !== 3) {
    http_response_code(403);
    exit('Accès refusé : vous ne disposez pas des droits nécessaires.');
}
