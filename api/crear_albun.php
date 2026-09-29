<?php

require_once '../conexion.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    http_response_code(405);

    echo json_encode([
        'error' => 'Método no permitido. Utiliza POST.'
    ]);

    exit;
}

$datos = json_decode(
    file_get_contents('php://input'),
    true
);

if (!$datos) {

    http_response_code(400);

    echo json_encode([
        'error' => 'No se han recibido datos JSON válidos'
    ]);

    exit;
}

$titulo = trim($datos['titulo'] ?? '');
$artista = trim($datos['artista'] ?? '');
$genero = trim($datos['genero'] ?? '');
$anio = (int) ($datos['anio'] ?? 0);
$precio = (float) ($datos['precio'] ?? 0);

if (
    empty($titulo) ||
    empty($artista) ||
    empty($genero) ||
    empty($anio)
) {

    http_response_code(400);

    echo json_encode([
        'error' => 'Todos los campos son obligatorios'
    ]);

    exit;
}

if ($anio < 1900 || $anio > date('Y')) {

    http_response_code(400);

    echo json_encode([
        'error' => 'El año no es válido'
    ]);

    exit;
}

if ($precio < 0) {

    http_response_code(400);

    echo json_encode([
        'error' => 'El precio no puede ser negativo'
    ]);

    exit;
}

try {

   
    $sql = "
        INSERT INTO albunes
        (titulo, artista, genero, anio, precio)
        VALUES
        (:titulo, :artista, :genero, :anio, :precio)
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([

        ':titulo' => $titulo,
        ':artista' => $artista,
        ':genero' => $genero,
        ':anio' => $anio,
        ':precio' => $precio

    ]);

    $id = $pdo->lastInsertId();

    http_response_code(201);

    echo json_encode([

        'mensaje' => 'Álbum creado correctamente',

        'album' => [
            'id' => (int) $id,
            'titulo' => $titulo,
            'artista' => $artista,
            'genero' => $genero,
            'anio' => $anio,
            'precio' => $precio
        ]

    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);


} catch (PDOException $e) {

    http_response_code(500);

    echo json_encode([
        'error' => 'Error al crear el álbum'
    ]);

}

?>
