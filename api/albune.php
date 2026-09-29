<?php

require_once '../conexion.php';

header('Content-Type: application/json; charset=utf-8');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {

    http_response_code(400);

    echo json_encode([
        'error' => 'Debes indicar un ID válido'
    ]);

    exit;
}

$id = (int) $_GET['id'];

$stmt = $pdo->prepare("
    SELECT id, titulo, artista, genero, anio, precio
    FROM albunes
    WHERE id = :id
");

$stmt->execute([
    ':id' => $id
]);

$album = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$album) {

    http_response_code(404);

    echo json_encode([
        'error' => 'Álbum no encontrado'
    ]);

    exit;
}

echo json_encode(
    $album,
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
);
