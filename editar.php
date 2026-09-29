<?php

require_once 'conexion.php';

$error = '';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php?mensaje=ID no válido');
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
    header('Location: index.php?mensaje=Álbum no encontrado');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = trim($_POST['titulo'] ?? '');
    $artista = trim($_POST['artista'] ?? '');
    $genero = trim($_POST['genero'] ?? '');
    $anio = (int) ($_POST['anio'] ?? 0);
    $precio = (float) ($_POST['precio'] ?? 0);

    if (
        $titulo === '' ||
        $artista === '' ||
        $genero === '' ||
        $anio === 0
    ) {

        $error = 'Todos los campos son obligatorios.';

    } elseif ($anio < 1900 || $anio > date('Y')) {

        $error = 'El año debe estar entre 1900 y ' . date('Y') . '.';

    } elseif ($precio < 0) {

        $error = 'El precio no puede ser negativo.';

    } else {

        try {


            $sql = "
                UPDATE albunes
                SET
                    titulo = :titulo,
                    artista = :artista,
                    genero = :genero,
                    anio = :anio,
                    precio = :precio
                WHERE id = :id
            ";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':titulo' => $titulo,
                ':artista' => $artista,
                ':genero' => $genero,
                ':anio' => $anio,
                ':precio' => $precio,
                ':id' => $id
            ]);


            
            header(
                'Location: index.php?mensaje=Álbum actualizado correctamente'
            );

            exit;

        } catch (PDOException $e) {

            $error = 'Error al actualizar el álbum: ' . $e->getMessage();

        }
    }



    $album['titulo'] = $titulo;
    $album['artista'] = $artista;
    $album['genero'] = $genero;
    $album['anio'] = $anio;
    $album['precio'] = $precio;
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

    <title>Editar álbum</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="contenedor">

    <h1> Editar álbum</h1>

    <a href="index.php" class="volver">
        ← Volver al listado
    </a>


    <?php if ($error !== ''): ?>

        <div class="mensaje-error">
            <?= htmlspecialchars($error) ?>
        </div>

    <?php endif; ?>


    <form
        action="editar.php?id=<?= $id ?>"
        method="POST"
    >

        <label for="titulo">
            Título:
        </label>

        <input
            type="text"
            id="titulo"
            name="titulo"
            value="<?= htmlspecialchars($album['titulo']) ?>"
            required
        >


        <label for="artista">
            Artista:
        </label>

        <input
            type="text"
            id="artista"
            name="artista"
            value="<?= htmlspecialchars($album['artista']) ?>"
            required
        >


        <label for="genero">
            Género:
        </label>

        <input
            type="text"
            id="genero"
            name="genero"
            value="<?= htmlspecialchars($album['genero']) ?>"
            required
        >


        <label for="anio">
            Año:
        </label>

        <input
            type="number"
            id="anio"
            name="anio"
            min="1900"
            max="<?= date('Y') ?>"
            value="<?= htmlspecialchars($album['anio']) ?>"
            required
        >


        <label for="precio">
            Precio (€):
        </label>

        <input
            type="number"
            id="precio"
            name="precio"
            min="0"
            step="0.01"
            value="<?= htmlspecialchars($album['precio']) ?>"
            required
        >


        <button type="submit">
            💾 Guardar cambios
        </button>

    </form>

</div>

</body>

</html>

