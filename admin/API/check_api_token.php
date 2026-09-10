<?php
require_once __DIR__ . '/../../MysqlConnect2025.php';
require_once __DIR__ . '/response.php';

$headers = getallheaders();

$authorization = $headers['Authorization'] ?? '';

if (!preg_match(
    '/Bearer\s+(.+)/i',
    $authorization,
    $matches
)) {

    jsonResponse(
        false,
        null,
        'Token API manquant',
        401
    );
}

$token = trim($matches[1]);

$tokenHash = hash('sha256', $token);

$stmt = $pdo->prepare("
    SELECT id, name
    FROM api_tokens
    WHERE token = :token_hash
    AND active = 1
    LIMIT 1
");

$stmt->execute([
    'token_hash' => $tokenHash
]);

$apiToken = $stmt->fetch();

if (!$apiToken) {

    jsonResponse(
        false,
        null,
        'Token API invalide',
        401
    );
}