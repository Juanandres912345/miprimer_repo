<?php

require_once 'conexion.php';


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {

    header('Location: index.php?mensaje=ID no válido');

    exit;
}


$id = (int) $_GET['id'];


$stmt = $pdo->prepare(
    "DELETE FROM albunes WHERE id = :id"
);


$stmt->execute([
    ':id' => $id
]);


header(
    'Location: index.php?mensaje=Álbum eliminado correctamente'
);

exit;

?>