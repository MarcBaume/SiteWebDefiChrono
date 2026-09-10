<?php

function jsonResponse(
    bool $success,
    mixed $data = null,
    string $error = '',
    int $status = 200
): never {

    http_response_code($status);

    header('Content-Type: application/json; charset=utf-8');

    $response = [
        'success' => $success
    ];

    if ($success) {
        $response['data'] = $data;
    } else {
        $response['error'] = $error;
    }

    echo json_encode(
        $response,
        JSON_UNESCAPED_UNICODE
    );

    exit;
}?>