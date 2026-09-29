<?php

require_once 'conexion.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = trim($_POST['titulo'] ?? '');
    $artista = trim($_POST['artista'] ?? '');
    $genero = trim($_POST['genero'] ?? '');
    $anio = (int) ($_POST['anio'] ?? 0);
    $precio = (float) ($_POST['precio'] ?? 0);


    if (
        empty($titulo) ||
        empty($artista) ||
        empty($genero) ||
        empty($anio)
    ) {

        $error = "Todos los campos son obligatorios.";

    } elseif ($anio < 1900 || $anio > date('Y')) {

        $error = "El año debe estar entre 1900 y " . date('Y');

    } elseif ($precio < 0) {

        $error = "El precio no puede ser negativo.";

    } else {

        try {

            $sql = "INSERT INTO albunes
                    (titulo, artista, genero, anio, precio)
                    VALUES
                    (:titulo, :artista, :genero, :anio, :precio)";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':titulo' => $titulo,
                ':artista' => $artista,
                ':genero' => $genero,
                ':anio' => $anio,
                ':precio' => $precio
            ]);

            header(
                'Location: index.php?mensaje=Álbum creado correctamente'
            );

            exit;

        } catch (PDOException $e) {

            $error = "Error al crear el álbum: " . $e->getMessage();

        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Crear álbum</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="formulario">

    <h1>🎵 Crear nuevo álbum</h1>


    <a href="index.php" class="volver">
        ← Volver al listado
    </a>


    <?php if ($error): ?>

        <div class="mensaje-error">
            <?= htmlspecialchars($error) ?>
        </div>

    <?php endif; ?>


    <form action="crear.php" method="POST">


        <label for="titulo">
            Título
        </label>

        <input
            type="text"
            id="titulo"
            name="titulo"
            placeholder="Ej: Abbey Road"
            value="<?= htmlspecialchars($_POST['titulo'] ?? '') ?>"
            required
        >


        <label for="artista">
            Artista
        </label>

        <input
            type="text"
            id="artista"
            name="artista"
            placeholder="Ej: The Beatles"
            value="<?= htmlspecialchars($_POST['artista'] ?? '') ?>"
            required
        >

        <label for="genero">
            Género
        </label>

        <input
            type="text"
            id="genero"
            name="genero"
            placeholder="Ej: Rock"
            value="<?= htmlspecialchars($_POST['genero'] ?? '') ?>"
            required
        >


        <label for="anio">
            Año
        </label>

        <input
            type="number"
            id="anio"
            name="anio"
            min="1900"
            max="<?= date('Y') ?>"
            placeholder="Ej: 1969"
            value="<?= htmlspecialchars($_POST['anio'] ?? '') ?>"
            required
        >

        <label for="precio">
            Precio (€)
        </label>

        <input
            type="number"
            id="precio"
            name="precio"
            min="0"
            step="0.01"
            placeholder="Ej: 19.99"
            value="<?= htmlspecialchars($_POST['precio'] ?? '') ?>"
            required
        >

        <button type="submit">
            + Crear álbum
        </button>

    </form>

</div>

</body>

</html>