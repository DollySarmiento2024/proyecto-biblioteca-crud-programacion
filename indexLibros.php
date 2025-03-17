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

    $libros = $manager->leerLibros();
    $total_libros = count($libros);
    $libros_por_pag = 3;
    $total_paginas = ceil(count($libros) / $libros_por_pag);

    // Obtener el número de página actual
    $paginas = isset($_GET['paginas']) ? (int)$_GET['paginas'] : 1;
    //limitamos el número máximo de páginas
    if($paginas > $total_paginas)
    {
        $paginas = $total_paginas;
    }

    //Calcular el índice inicial y final para la pagínación
    $indice_inicio = ($paginas - 1) * $libros_por_pag;
    $mostrar_libro = array_slice($libros, $indice_inicio, $libros_por_pag);

    //LISTAR LIBROS
    if ($total_libros == 0) {
        echo "<p>No hay Libros registrados.</p>";
    } else {
        echo "<ul>";
        foreach ($mostrar_libro as $index => $libro) {
            echo "<li>";
            echo "<p><span>Titulo:</span> " . $libro->getTitulo() . ", <span>Autor:</span> " . $libro->getAutor() . ", <span>Año:</span> " . $libro->getAnyo() . ", <span>Paginas:</span> " . $libro->getPaginas() . "</p>";

            echo "<form method='POST' class='eliminar-form'>
                    <input type='hidden' name='index' value='" . ($indice_inicio + $index) . "'>
                    <input class='button' type='submit' name='eliminar' value='Eliminar'>
                </form>";
            echo "</li>";
        }
        echo "</ul>";

        /* paginación */
        echo "<div class='paginacion'>";

        if ($paginas > 1) {
            echo "<a href='?paginas=1'> << </a>";  // Corrección: eliminé espacios extra
            echo "<a href='?paginas=" . ($paginas - 1) . "'> < </a>";
        }

        echo "<span>Página " . $paginas . " de "  . $total_paginas . "</span>";

        if ($paginas < $total_paginas) {
            echo "<a href='?paginas=" . ($paginas + 1) . "'> > </a>";
            echo "<a href='?paginas=" . $total_paginas . "'> >> </a>";
        }
        echo "</div>";

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