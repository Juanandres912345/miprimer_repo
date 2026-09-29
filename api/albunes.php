<?php

require_once '../conexion.php';

header('Content-Type: application/json; charset=utf-8');

try {

    $stmt = $pdo->query("
        SELECT id, titulo, artista, genero, anio, precio
        FROM albunes
        ORDER BY id DESC
    ");

    $albunes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(
        $albunes,
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    );

} catch (PDOException $e) {

    http_response_code(500);

    echo json_encode([
        'error' => 'Error al obtener los álbumes'
    ]);
}
