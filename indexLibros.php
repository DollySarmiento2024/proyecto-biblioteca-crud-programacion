<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listado de Libros</title>
    <img src="./Imagen/libros.jpg" alt="biblioteca" style="width: 100%; max-height: 300px;">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h2>Listado de Biblioteca</h2>

    <a href="form.php"><button>GESTOR DE LIBROS Y REVISTAS</button></a>
    <h2>Listado de Libros</h2>

    <?php

    require_once("./class/Manager.php");
    $manager = new Manager();

    //LISTAR LIBROS
    if (count($manager->leerLibros()) == 0) {
        echo "<p>No hay Libros registrados.</p>";
    } else {
        echo "<ul>";
        foreach ($manager->leerLibros() as $index => $libro) {
            echo "<li>";
            echo "<p><span>Titulo:</span> " . $libro->getTitulo() . ", <span>Autor:</span> " . $libro->getAutor() . ", <span>Año:</span> " . $libro->getAnyo() . ", <span>Paginas:</span> " . $libro->getPaginas() . "</p>";

            echo "<form method='POST' class='eliminar-form'>
                    <input type='hidden' name='index' value='" . $index . "'>
                    <input class='button' type='submit' name='eliminar' value='Eliminar'>
                </form>";
            echo "</li>";
        }
        echo "</ul>";

        //ELIMINAR LIBRO
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $index = (int)($_POST['index'] ?? -1);
            if ($index >= 0) {
                $manager->eliminarLibro($index);
                echo "<p>Libro eliminado correctamente.</p>";
            }
        }
    }

    ?>
</body>

</html>