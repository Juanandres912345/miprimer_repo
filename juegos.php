<?php
require_once '../conexion.php';
header('Content-Type: application/json');

$stmt = $pdo->query("SELECT * FROM albunes");
$peliculas = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($albunes, JSON_PRETTY_PRINT);
?>