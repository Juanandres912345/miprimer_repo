<?php

require_once 'conexion.php';

$stmt = $pdo->query(
    "SELECT * FROM albunes ORDER BY id DESC"
);

$albunes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catálogo de álbumes</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="contenedor">

    <div class="cabecera">

        <div>
            <h1>🎵 Catálogo de álbumes</h1>
            <p>Lista de todos los álbumes</p>
        </div>

        <!-- Este botón lleva al formulario de creación -->
        <a href="crear.php" class="boton-crear">
            + Crear nuevo álbum
        </a>

    </div>


    <?php if (isset($_GET['mensaje'])): ?>

        <div class="mensaje-exito">
            <?= htmlspecialchars($_GET['mensaje']) ?>
        </div>

    <?php endif; ?>


    <?php if (empty($albunes)): ?>

        <div class="sin-albumes">

            <h2>No hay álbumes</h2>

            <p>
                Todavía no hay ningún álbum en la base de datos.
            </p>

            <a href="crear.php" class="boton-crear">
                + Crear el primer álbum
            </a>

        </div>

    <?php else: ?>

        <div class="tabla-contenedor">

            <table>

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Artista</th>
                        <th>Género</th>
                        <th>Año</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>

                </thead>

                <tbody>

                <?php foreach ($albunes as $album): ?>

                    <tr>

                        <td>
                            <?= htmlspecialchars($album['id']) ?>
                        </td>

                        <td>
                            <strong>
                                <?= htmlspecialchars($album['titulo']) ?>
                            </strong>
                        </td>

                        <td>
                            <?= htmlspecialchars($album['artista']) ?>
                        </td>

                        <td>
                            <span class="genero">
                                <?= htmlspecialchars($album['genero']) ?>
                            </span>
                        </td>

                        <td>
                            <?= htmlspecialchars($album['anio']) ?>
                        </td>

                        <td>
                            <?= number_format(
                                $album['precio'],
                                2,
                                ',',
                                '.'
                            ) ?>
                            €
                        </td>

                        <td>

                            <div class="acciones">

                                <a
                                    href="editar.php?id=<?= $album['id'] ?>"
                                    class="btn-editar"
                                >
                                    Editar
                                </a>

                                <a
                                    href="eliminar.php?id=<?= $album['id'] ?>"
                                    class="btn-eliminar"
                                    onclick="return confirm('¿Seguro que quieres eliminar este álbum?')"
                                >
                                    Eliminar
                                </a>

                            </div>

                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

        <p class="total">
            Total de álbumes:
            <strong><?= count($albunes) ?></strong>
        </p>

    <?php endif; ?>

</div>

</body>

</html>